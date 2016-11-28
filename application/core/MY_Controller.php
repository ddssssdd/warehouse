<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller
{

	protected $page_data = array(
		'module_name' => '' , 
		'controller_name' => '',
		'method_name' => '',
	);
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('global','url','string','text','language','auto_codeIgniter_helper'));

		$this->page_data['folder_name']=trim(substr($this->router->directory, 0, -1)) ;
		$this->page_data['controller_name']= trim($this->router->class);
		$this->page_data['method_name']= trim($this->router->method);
		$this->page_data['controller_info']= $this->config->item($this->page_data['controller_name'],'module');


		$this->page_data['title'] = 'title';
		$this->page_data['keyword'] = 'keywords';
		$this->page_data['description'] = 'description';
		
		//$this->session->set_userdata(array("userId"=>1,"name"=>"steven","email"=>"a@a.com"));
	}
	protected function showmessage($msg, $url_forward = '', $ms = 500, $dialog = '', $returnjs = '') {

		if($url_forward=='')$url_forward=$_SERVER['HTTP_REFERER'];
		$datainfo = array("msg"=>$msg,"url_forward"=>$url_forward,"ms"=>$ms,"returnjs"=>$returnjs,"dialog"=>$dialog);
		exit($msg);
	}

	
	protected function success_json($data){
		return $this->json(array("status" => true,"result"=>$data));
	}
	protected function failure_json($message){
		return $this->json(array("status"=>false,"message"=>$message));
	}
	protected function json($data)
	{
		$this->output->set_content_type('application/json')->set_output(json_encode($data));		
	}
}
class Front_Controller extends MY_Controller
{
	public $user;
	function __construct(){
		parent::__construct();
		$this->user = array("userId"=>$this->session->userId,"name" =>$this->session->name,"email"=>$this->session->email);
	}
	
}