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
		$query = $this->db->query("select * from Messages where ToUserId=0 and Version>?",array($version));
		if ($query->row()){
			$data = $query->row();
			$this->success_json($data);
		}else{
			$this->failure_json("No latest version found.");
		}

	}
}