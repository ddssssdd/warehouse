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
}