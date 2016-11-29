<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Store_model extends MY_Model
{
	private $tableName;
	public $Name;
	public function __construct()
	{
		parent::__construct();
		$this->tableName = "Stores";
		$this->Name = "Store";
	}
	
	public function Items()
	{
		$query = $this->db->get($this->tableName);
		return $query->result();

	}

	public function Exists($name){
		$this->db->where("Name",$name);
		$query = $this->db->get($this->tableName);
		return $query->num_rows()>0;
	}
	public function AddItem($name,$phone,$manager,$address,$fax)
	{
		if ($this->Exists($name)){
			return array("result"=>false,"message"=>$this->Name." ".$name." exists");
		}
		$item = array("Name" => $name,
			"Phone" =>$phone, 
			"Manager" =>$manager, 
			"Address" => $phone, 
			"Fax" => $fax);
		$this->db->insert($this->tableName,$item);
		return $this->Items();
	}
	public function EditItem($id,$name,$phone,$manager,$address,$fax){
		$item = array(
			"Name" => $name,
			"Phone" =>$phone, 
			"Manager" =>$manager, 
			"Address" => $phone, 
			"Fax" => $fax);
		$this->db->update($this->tableName,$item,array("Id"=>$id));
		return $this->Items();
	}
	public function RemoveItem($id)
	{
		$this->db->query("delete from Stores where Id=".$id);
		return;
	}
}