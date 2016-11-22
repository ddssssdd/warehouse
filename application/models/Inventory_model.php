<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Inventory_model extends MY_Model
{	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function Items()
	{
		$query = $this->db->get("Inventories");
		return $query->result();
	}

	public function AddItem($storeId,$productId,$vendorId,$quantity,$inprice,$indate,$userId)
	{
		
		$item = array("StoreId" => $storeId,
			"ProductId" =>$productId,
			"VendorId" =>$vendorId, 
			"Quantity" => $quantity, 
			"InPrice" => $inprice,
			"InDate" => $indate,
			"UserId" => $userId);
		$this->db->insert("Inventories",$item);
		return $this->Items();
	}
	public function StoreInventory($storeId)
	{
		$this->db->where("StoreId",$storeId);
		$query = $this->db->get("Inventories");		
		return $query->result();
	}

}