<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact_model extends MY_Model
{
    public function __construct()
	{
		parent::__construct();
	}
	
	public function Items()
	{
		$query = $this->db->get("Contacts");
		return $query->result();

	}

	public function AddContact($name,$phone,$email,$cellphone,$address,$qq,$weixin,$memo)
	{
		$contact = array("Name" => $name,"Phone" =>$phone, "Email" =>$email, 
                        "Address" => $phone, "Cellphone" => $cellphone,
                        "qq" =>$qq, "weixin"=>$weixin,"Memo"=>$memo);
		$this->db->insert("Contacts",$contact);
		return $this->Items();
	}
	public function EditContact($id,$name,$phone,$email,$cellphone,$address,$qq,$weixin,$memo){
		$contact = array("Name" => $name,"Phone" =>$phone, "Email" =>$email, 
                        "Address" => $phone, "Cellphone" => $cellphone,
                        "qq" =>$qq, "weixin"=>$weixin,"Memo"=>$memo);
		$this->db->update("Contacts",$contact,array("Id"=>$id));
        $query = $this->db->get_where("Contacts",array("Id"=>$id));
        return $query->row();
	}
}