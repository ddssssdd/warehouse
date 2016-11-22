<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Client_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		
	}
	
	public function Items()
	{
		$query = $this->db->get("Clients");
		return $query->result();

	}

	public function Exists($name){
		$this->db->where("Name",$name);
		$query = $this->db->get("Clients");
		return $query->num_rows()>0;
	}
	public function AddClient($name,$phone,$email,$address,$fax)
	{
		if ($this->Exists($name)){
			return array("result"=>false,"message"=>"Client ".$name." exists");
		}
		$client = array("Name" => $name,
			"Phone" =>$phone, 
			"Email" =>$email, 
			"Address" => $phone, 
			"Fax" => $fax);
		$this->db->insert("Clients",$client);
		return $this->Items();
	}
	public function EditClient($id,$phone,$email,$address,$fax){
		$client = array(
			"Phone" =>$phone, 
			"Email" =>$email, 
			"Address" => $phone, 
			"Fax" => $fax);
		$this->db->update("Clients",$client,array("Id"=>$id));
		$query = $this->db->get_where("Clients",array("Id"=>$id));
        return $query->row();
	}

}