<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Vendor_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		
	}
	
	public function Items()
	{
		$query = $this->db->query("select v.*,c.Name as ContactName,c.Cellphone as ContactCellphone from Vendors v
									left join Contacts c on c.Id = v.ContactId");
		return $query->result();

	}

	public function Exists($name){
		$this->db->where("Name",$name);
		$query = $this->db->get("Vendors");
		return $query->num_rows()>0;
	}
	public function AddVendor($name,$phone,$email,$address,$fax,$contactName,$contactCellphone)
	{
		if ($this->Exists($name)){
			return array("result"=>false,"message"=>"Vendor ".$name." exists");
		}
		$contactId = 0;
		if ($contactName){//base on contact name and cellphone to search
			$query_contact = $this->db->query("select Id from Contacts where Name = ? and Cellphone =?",
					array($contactName,$contactCellphone));
			if ($query_contact->num_rows()>0){
				$contactId = $query_contact->row()->Id;
			}else{ //if there is not this person, then insert one
				$contact = array("Name" =>$contactName,
				"Phone" =>$phone,
				"Address" => $address,
				"Email" =>$email,
				"Cellphone" => $contactCellphone);
				$this->db->insert("Contacts",$contact);
				$contactId = $this->db->insert_id();	
			}
		}
		$vendor = array("Name" => $name,
			"Phone" =>$phone, 
			"Email" =>$email, 
			"Address" => $address, 
			"Fax" => $fax,
			"ContactId" => $contactId);
		$this->db->insert("Vendors",$vendor);
		$vendorId = $this->db->insert_id();
		if ($vendorId>0 && $contactId>0){
			$this->db->insert("VendorContacts",array("VendorId"=>$vendorId,"ContactId"=>$contactId));
		}
		return $this->Items();
	}
	public function EditVendor($id,$name,$phone,$email,$address,$fax){
		$vendor = array(
			"Name" => $name,
			"Phone" =>$phone, 
			"Email" =>$email, 
			"Address" => $phone,
		 	"Fax" => $fax);
		$this->db->update("Vendors",$vendor,array("Id"=>$id));
		//$query = $this->db->get_where("Vendors",array("Id"=>$id));
        //return $query->row();
		return $this->Items();
	}
	public function RemoveItem($id)
	{
		$this->db->query("delete from VendorContacts where VendorId=".$id);
		$this->db->query("delete from Vendors where Id=".$id);
		return;
	}
}