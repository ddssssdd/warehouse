<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends MY_Model{

	
	public function __construt()
	{
		parent::__construt();	
		
	}
	function find($username,$password)
	{
		$query = $this->db->get_where("Users",array("Name"=>$username,"Password"=>$password));
		return $query->row_array();
	}
	public function Items()
	{
		$query = $this->db->get("Users");
		return $query->result();

	}

	public function Exists($name){
		$this->db->where("Name",$name);
		$query = $this->db->get("Users");
		return $query->num_rows()>0;
	}
	public function AddItem($name,$password,$email,$cellphone)
	{
		if ($this->Exists($name)){
			return array("result"=>false,"message"=>"User ".$name." exists");
		}
		$item = array("Name" => $name,
			"CellPhone" =>$cellphone, 
			"Email" =>$email, 
			"Password" => $password
			);
		$this->db->insert("Users",$item);
		return $this->Items();
	}
	public function EditItem($id,$password,$email,$cellphone){
		$item = array(
			"CellPhone" =>$cellphone, 
			"Email" =>$email, 
			"Password" => $password);
		$this->db->update("Users",$item,array("Id"=>$id));
		$query = $this->db->get_where("Users",array("Id"=>$id));
        return $query->row();
	}

}