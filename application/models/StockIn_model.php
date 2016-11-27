<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class StockIn_model extends MY_Model
{	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function Items()
	{
		$query = $this->db->get("StockIns");
		return $query->result();
	}
    public function SaveStockIn($data,$UserId){
        $item = array("InvoiceNo" => $data["InvoiceNo"],
                        "VendorId" => $data["VendorId"],
                        "TotalPrice" => $data["TotalPrice"],
                        "TotalNo" => $data["TotalNo"],
                        "UserId" =>$UserId,
                        "Memo" => $data["Memo"],
                        "StoreId" =>$data["StoreId"],
                        "EnteredDate" =>$data["EnteredDate"]?$data["EnteredDate"]:date("Y-m-d H:i:s"));
        $this->db->insert("StockIns",$item);
        $Id = $this->db->insert_id();
        foreach($data["details"] as $item){
            $detail = array("StockInId" => $Id,
                "StoreId" => $item["StoreId"],
			    "ProductId" =>$item["ProductId"],
			    "Specification" =>$item["Specification"], 
			    "Quantity" => $item["Quantity"], 
			    "Price" => $item["Price"],
                "Memo" =>$item["Memo"]
            );
            $this->db->insert("StockInDetails",$detail);
        }
        $this->db->where("Id",$Id);
        $query = $this->db->get("StockIns");
        $data = $query->row();
        $this->db->where("StockInId",$Id);
        $query_detail = $this->db->get("StockInDetails");
        //return array("result"=>$data,"details"=> $query_detail->result_array());
        //$result = array_merge($data,$query_detail->result_array());
        $data ->details =  $query_detail->result_array();
        return $data;
    }
    public function NewStockIn($InvoiceNo,$VendorId,$TotalPrice,$TotalNo,$UserId,$Memo,$EnteredDate,$StoreId)
    {
        //check business rules
        $item = array("InvoiceNo" => $InvoiceNo,
                        "VendorId" => $VendorId,
                        "TotalPrice" => $TotalPrice,
                        "TotalNo" => $TotalNo,
                        "UserId" =>$UserId,
                        "Memo" => $Memo,
                        "StoreId" =>$StoreId,
                        "EnteredDate" =>$EnteredDate?$EnteredDate:date("Y-m-d H:i:s"));
        $this->db->insert("StockIns",$item);
        $result = $this->db->insert_id();
        $this->db->where("Id",$result);
        $query = $this->db->get("StockIns");
        return $query->row();
    }

	public function AddDetail($Id,$StoreId,$ProductId,$Specification,$Quantity,$Price)
	{
		//business check;
		$item = array("StockInId" => $Id,
            "StoreId" => $StoreId,
			"ProductId" =>$ProductId,
			"Specification" =>$Specification, 
			"Quantity" => $Quantity, 
			"Price" => $Price
            );
		$this->db->insert("StockInDetails",$item);
		return $this->Items();
	}
	public function StoreInventory($storeId)
	{
		$this->db->where("StoreId",$storeId);
		$query = $this->db->get("Inventories");		
		return $query->result();
	}

}