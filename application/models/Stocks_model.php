<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Stocks_model extends MY_Model
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
        $this->db->trans_begin();

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
            $detail_id = $this->db->insert_id();
            $this->UpdateInventory($detail_id,$detail,$UserId,TRUE);
        }

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();
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
        
    }
    public function UpdateInventory($detail_id,$data,$userId,$isStockIn)
    {
        $Index =1;
        $MaxPrice = $data["Price"]*1;
        $MinPrice = $data["Price"]*1;
        $Id = 0;
        $Quantity = $data["Quantity"];        
        $Old = 0;
        $maxField = "";
        $minField = "";
        $query = $this->db->query("select * from Inventories where ProductId=? and StoreId=?",array($data["ProductId"],$data["StoreId"]));
        $row = $query->row();
        if (isset($row)){
            $Index = $row->Index+1;
            $Id = $row->Id;
            $Old = $row->Quantity;
            if ($isStockIn){
                $Quantity = $Quantity + $Old;                
                if ($MaxPrice>$row->MaxPrice){
                   $MaxPrice = $row->MaxPrice;
                }
                if ($MinPrice <$row->MinPrice){
                    $MinPrice = $row->MinPrice;
                }
                $maxField = "MaxPrice";
                $minField = "MinPrice";
            }else{
                $Quantity = $Old - $Quantity;
                if ($MaxPrice>$row->MaxOutPrice){
                   $MaxPrice = $row->MaxOutPrice;
                }
                if ($MinPrice <$row->MinOutPrice){
                    $MinPrice = $row->MinOutPrice;
                }
                $maxField = "MaxOutPrice";
                $minField = "MinOutPrice";
            }
            
                        
        }else{
            if (!$isStockIn){ //if this is stocks out
                $Quantity = 0 - $Quantity;
                $maxField = "MaxOutPrice";
                $minField = "MinOutPrice";
            }else{
                $maxField = "MaxPrice";
                $minField = "MinPrice";
            }
        }
        $inventory = array("StoreId" => $data["StoreId"],
            "ProductId" => $data["ProductId"],
            "Quantity" => $Quantity,
             $maxField => $MaxPrice,
             $minField => $MinPrice,
            "Index" => $Index,
            "UserId" =>$userId,
            "LastUpdate" => date("Y-m-d H:i:s")
            );

        if ($Id>0){
            $this->db->update("Inventories",$inventory,array("Id"=>$Id));
        }else{
            $this->db->insert("Inventories",$inventory);
            $Id = $this->db->insert_id();
        }
        $detail = array("InventoryId" => $Id,
            "UpdateDate"=>date("Y-m-d H:i:s"),
            "UpdateSequ"=>$Index,
            "BeforeUpdate" =>$Old,
            "AfterUpdate" => $Quantity);

        $this->db->update($isStockIn?"StockInDetails":"StockOutDetails",$detail,array("Id" => $detail_id));


    }
    //stocks out
    public function SaveStockOut($data,$UserId){
        $this->db->trans_begin();

        $item = array("InvoiceNo" => $data["InvoiceNo"],
                        "ClientId" => $data["ClientId"],
                        "TotalPrice" => $data["TotalPrice"],
                        "TotalNo" => $data["TotalNo"],
                        "UserId" =>$UserId,
                        "Memo" => $data["Memo"],                        
                        "EnteredDate" =>$data["EnteredDate"]?$data["EnteredDate"]:date("Y-m-d H:i:s"));
        $this->db->insert("StockOuts",$item);
        $Id = $this->db->insert_id();
        foreach($data["details"] as $item){
            $detail = array("StockOutId" => $Id,
                "StoreId" => $item["StoreId"],
                "ProductId" =>$item["ProductId"],                
                "Quantity" => $item["Quantity"], 
                "Price" => $item["Price"],
                "Memo" =>$item["Memo"]
            );
            $this->db->insert("StockOutDetails",$detail);
            $detail_id = $this->db->insert_id();
            $this->UpdateInventory($detail_id,$detail,$UserId,FALSE);
        }

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();
            $this->db->where("Id",$Id);
            $query = $this->db->get("StockOuts");
            $data = $query->row();
            $this->db->where("StockOutId",$Id);
            $query_detail = $this->db->get("StockOutDetails");            
            $data ->details =  $query_detail->result_array();
            return $data;
        }
        
    }

	public function products($store_id)
	{
		$sql = "SELECT i.ProductId,i.MinPrice,i.MaxPrice,i.MinOutPrice,i.MaxOutPrice,i.Quantity, p.* FROM Inventories i
                LEFT JOIN Products p ON i.ProductId = p.Id
                WHERE i.StoreId=?";
		$query = $this->db->query($sql,array($store_id));
		return $query->result();
	}

}