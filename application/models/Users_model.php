<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users_model extends MY_Model{

	public function __construt()
	{
		parent::__construt();	
		
	}
	function find($username,$password)
	{
		$query = $this->db->get_where("Users",array("Name"=>$username,"Password"=>$password));
		return $query->row_array();
	}

}