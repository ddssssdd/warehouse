<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Message extends Front_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}	
	public function version()
	{
		$version = $this->input->get_post("version");
		$query = $this->db->query("select * from Messages where ToUserId=0 and Type='Install' and Version>?",array($version));
		if ($query->row()){
			$data = $query->row();
			$this->success_json($data);
		}else{
			$this->failure_json("No latest version found.");
		}
	}
	public function fetch(){
		$user_id = $this->input->get_post("user_id");
		if (isset($user_id)){
			$query =$this->db->query("select * from Messages where ToUserId=? and Type='Message' and HasRead=0 order by Id",array($user_id));
			$data = $query->result();
			$this->db->query("Update Messages set HasRead=1, GetDate=Now() where ToUserId=? and Type='Message' and HasRead=0",array($user_id));
			return $this->success_json($data);
		}else{
			$this->failure_json("Can not find user");
		}
		
	}
}