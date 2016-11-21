<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends Front_Controller
{
	function __construct()
	{
		parent::__construct();

	}	
	public function index()
	{
		$this->view('index',array());		
	}
	public function login()
	{
		if(isset($_POST['username'])) {
			$username = isset($_POST['username']) ? trim($_POST['username']) : exit(json_encode(array('status'=>false,'message'=>' 用户名不能为空')));
			if($username=="")exit(json_encode(array('status'=>false,'message'=>' 用户名不能为空')));
						//查询帐号，默认组1为超级管理员
			$this->load->model("users_model");

			$r = $this->users_model->find($username,$_POST["password"]);
			
			if(!$r) exit(json_encode(array('status'=>false,'tips'=>' 用户名或密码不正确')));			

			//$ip = $this->input->ip_address();
			
			$this->session->set_userdata('user_id',$r['Id']);
			$this->session->set_userdata('name',$r['Name']);
			$this->session->set_userdata('email',$r["Email"]);

			redirect(base_url('home/index'));

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
		$this->load->model("vendor_model");
		$data = $this->vendor_model->AddVendor("vendor2","139532","email","address","fax");
		//$data = $this->vendor_model->Exists("test1");
		//$data = $this->vendor_model->Items();
		$this->output
    		->set_content_type('application/json')
    		->set_output(json_encode(array('foo' => 'bar','rows' => $data)));
	}
}