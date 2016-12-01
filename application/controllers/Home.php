<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends Front_Controller
{
	function __construct()
	{
		parent::__construct();

	}	
	public function index()
	{
		$data = $this->user;
		$this->view('index',$data);		
	}
	public function login()
	{
		if(isset($_POST['username'])) {
			$username = isset($_POST['username']) ? trim($_POST['username']) : exit(json_encode(array('status'=>false,'message'=>' 用户名不能为空')));
			if($username=="")exit(json_encode(array('status'=>false,'message'=>' 用户名不能为空')));
						//查询帐号，默认组1为超级管理员
			$this->load->model("user_model");

			$r = $this->user_model->find($username,$_POST["password"]);
			
			if(!$r) exit(json_encode(array('status'=>false,'tips'=>' 用户名或密码不正确')));			

			//$ip = $this->input->ip_address();
			
			$this->session->set_userdata('userId',$r->Id);
			$this->session->set_userdata('name',$r->Name);
			$this->session->set_userdata('email',$r->Email);

			redirect(base_url('store/index'));

		}else {
			$this->view_empty("login",array());
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('home/login'));
	}

	public function test(){
		$this->output
    		->set_content_type('application/json')
    		->set_output(json_encode(array('foo' => 'bar','rows' => 'hellohome.')));
	}

	public function standard()
	{
		$this->load->view("share/header");
		$this->load->view("home/standard");
		$this->load->view("share/footer");
	}
	public function java()
	{
		$t = $this->input->get_post("tablename");
		$sql ="SELECT CASE DATA_TYPE WHEN 'int' THEN 'int' WHEN 'varchar' THEN 'String' WHEN 'decimal' THEN 'Double' ELSE DATA_TYPE END AS TYPE_NAME ,COLUMN_NAME 
			FROM information_schema.COLUMNS WHERE table_name = ? AND table_schema = 'warehouse'";
		$this->load->database();
		$query = $this->db->query($sql,array($t));
		$result = "public class ".$t." extends Entity{";
		$result = $result."public ".$t."(){ }";
		$getset ="";
		foreach($query->result() as $item){
			$type = $item->TYPE_NAME;
			$name = $item ->COLUMN_NAME;
			$result =$result." public ".$item->TYPE_NAME." ".$item->COLUMN_NAME.";  ";
			$get = "public ".$type." get".$name."(){ return ".$name.";} ";
			$set = "public void set".$name."(".$type." value){ ".$name." = value; } ";
			$getset = $getset.$get.$set;
			//$result=$item->TYPE_NAME;
		}
		$getset="";//for now, don't need get set.
		$result= $result.$getset."}";
		
		$this->json($result);
	}
}