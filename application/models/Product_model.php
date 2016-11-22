<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product_model extends MY_Model
{
	private $tableName;
	public $Name;
	public function __construct()
	{
		parent::__construct();
		$this->tableName = "Products";
		$this->Name = "Product";
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
	public function AddItem($name,$specification,$unit,$width,$height,$length,$brand,$barcode)
	{
		if ($this->Exists($name)){
			return array("result"=>false,"message"=>$this->Name." ".$name." exists");
		}
		$item = array("Name" => $name,
			"specification" => $specification,
			"Unit" => $unit,
			"Width" => $width,
			"Height" => $height,
			"Length" => $length,
			"Brand"  => $brand,
			"Barcode" =>$barcode
			);
		$this->db->insert($this->tableName,$item);
		return $this->Items();
	}
	public function EditItem($id,$specification,$unit,$width,$height,$length,$brand,$barcode){
		$item = array(
			"specification" => $specification,
			"Unit" => $unit,
			"Width" => $width,
			"Height" => $height,
			"Length" => $length,
			"Brand"  => $brand,
			"Barcode" =>$barcode);
		$this->db->update($this->tableName,$item,array("Id"=>$id));
		$query = $this->db->get_where($this->tableName,array("Id"=>$id));
        return $query->row();
	}

}