<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Outstock_model extends MY_Model
{	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function Items()
	{
		$query = $this->db->get("Outstocks");
		return $query->result();
	}

	public function AddItem($storeId,$productId,$clientId,$quantity,$outprice,$outdate,$userId)
	{
		
		$item = array("StoreId" => $storeId,
			"ProductId" =>$productId,
			"ClientId" =>$clientId, 
			"Quantity" => $quantity, 
			"OutPrice" => $outprice,
			"OutDate" => $outdate,
			"UserId" => $userId);
		$this->db->insert("Outstocks",$item);
		return $this->Items();
	}
	
}