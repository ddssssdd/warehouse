<?php
class Vendor_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function Items()
	{
		$query = $this->db->get("Vendors");
		return $query->result();

	}

	public function Exists($name){
		$this->db->where("Name",$name);
		$query = $this->db->get("Vendors");
		return $query->num_rows()>0;
	}
	public function AddVendor($name,$phone,$email,$address,$fax)
	{
		if ($this->Exists($name)){
			return array("result"=>false,"message"=>"Vendor ".$name." exists");
		}
		$vendor = array("Name" => $name,"Phone" =>$phone, "Email" =>$email, "Address" => $phone, "Fax" => $fax);
		$this->db->insert("Vendors",$vendor);
		return $this->Items();
	}

}