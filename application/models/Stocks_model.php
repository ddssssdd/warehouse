<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Stocks_model extends MY_Model
{	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function ItemsIn()
	{
        $sql = "select m.*,v.Name as VendorName,s.Name as StoreName from StockIns m
                left join Vendors v on m.VendorId = v.Id
                left join Stores s on m.StoreId = s.Id order by m.EnteredDate desc";
		$query = $this->db->query($sql);
		return $query->result();
	}
    public function ItemsOut()
    {
        $sql = "select m.*,c.Name as ClientName from StockOuts m
                left join Clients c on m.ClientId = c.Id  order by m.EnteredDate desc";
        $query = $this->db->query($sql);
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
        $Id =isset($data["Id"])?$data["Id"]:0;
        $is_reset = FALSE;
        if ($Id==0){
            $this->db->insert("StockIns",$item);    
            $Id = $this->db->insert_id();
        }else{
            $this->db->update("StockIns",$item,array("Id" => $Id));
            $is_reset = TRUE;
        }
        
        
        foreach($data["details"] as $item){
            $detail = array("StockInId" => $Id,
                "StoreId" => $item["StoreId"],
			    "ProductId" =>$item["ProductId"],
			    "Specification" =>$item["Specification"], 
			    "Quantity" => $item["Quantity"], 
			    "Price" => $item["Price"],
                "Memo" =>$item["Memo"]
            );
            if ($is_reset){
                $changed = isset($item["changed"])?$item["changed"]:0;
                if ($changed){
                    $old_detail_id = $item["Id"];
                    $detail["ChangedId"] = $old_detail_id;
                    $this->db->insert("StockInDetails",$detail);
                    $detail_id = $this->db->insert_id();
                    $this->UpdateInventory($detail_id,$detail,$UserId,TRUE);  
                    $this->db->update("StockInDetails",array("ChangedId" =>$detail_id),array("Id"=>$old_detail_id));  
                }
            }else{
                $this->db->insert("StockInDetails",$detail);
                $detail_id = $this->db->insert_id();
                $this->UpdateInventory($detail_id,$detail,$UserId,TRUE);    
            }
            
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
                if ($MaxPrice<$row->MaxPrice){
                   $MaxPrice = $row->MaxPrice;
                }
                if ($MinPrice >$row->MinPrice){
                    $MinPrice = $row->MinPrice;
                }
                $maxField = "MaxPrice";
                $minField = "MinPrice";
            }else{
                $Quantity = $Old - $Quantity;
                if ($row->MaxOutPrice &&  $MaxPrice<$row->MaxOutPrice){
                   $MaxPrice = $row->MaxOutPrice;
                }
                if ($row->MinOutPrice &&  $MinPrice > $row->MinOutPrice){
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
        $Id =isset($data["Id"])?$data["Id"]:0;
        $is_reset = FALSE;
        if ($Id==0){
            $this->db->insert("StockOuts",$item);
            $Id = $this->db->insert_id();    
        }else{
            $this->db->update("StockOuts",$item,array("Id" => $Id));
            $is_reset = TRUE;
        }
        
        foreach($data["details"] as $item){
            $detail = array("StockOutId" => $Id,
                "StoreId" => $item["StoreId"],
                "ProductId" =>$item["ProductId"],                
                "Quantity" => $item["Quantity"], 
                "Price" => $item["Price"],
                "Memo" =>$item["Memo"]
            );
            if ($is_reset){
                $changed = isset($item["changed"])?$item["changed"]:0;
                if ($changed){
                    $old_detail_id = $item["Id"];
                    $detail["ChangedId"] = $old_detail_id;
                    $this->db->insert("StockOutDetails",$detail);
                    $detail_id = $this->db->insert_id();
                    $this->UpdateInventory($detail_id,$detail,$UserId,FALSE);  
                    $this->db->update("StockOutDetails",array("ChangedId" =>$detail_id),array("Id"=>$old_detail_id));  
                }
            }else{
                $this->db->insert("StockOutDetails",$detail);
                $detail_id = $this->db->insert_id();
                $this->UpdateInventory($detail_id,$detail,$UserId,FALSE);
            }
            
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
		$sql = "SELECT i.Id AS InventoryId,i.ProductId,i.MinPrice,i.MaxPrice,i.MinOutPrice,i.MaxOutPrice,i.Quantity, p.* FROM Inventories i
                LEFT JOIN Products p ON i.ProductId = p.Id
                WHERE i.StoreId=?";
		$query = $this->db->query($sql,array($store_id));
		return $query->result();
	}

    public function details($inventory_id,$store_id,$product_id)
    {
        $sql = "SELECT d.StockInId AS Id,d.ProductId,d.StoreId,d.Specification,d.Quantity,d.Price,d.Memo,d.UpdateSequ,d.BeforeUpdate,d.AfterUpdate,'In' AS Method,d.UpdateDate,v.Name, p.Name as ProductName, s.Name as StoreName
FROM StockInDetails d
left join StockIns i on d.StockInId = i.Id
left join Vendors v on i.VendorId = v.Id
left join Products p on d.ProductId = p.Id
left join Stores s on d.StoreId = s.Id
WHERE InventoryId=?
UNION 
SELECT d.StockOutId AS Id,d.ProductId,d.StoreId,'' AS Specification,d.Quantity,d.Price,d.Memo,d.UpdateSequ,d.BeforeUpdate,d.AfterUpdate,'Out' AS Method,d.UpdateDate,
c.Name, p.Name as ProductName, s.Name as StoreName
FROM StockOutDetails d
left join StockOuts o on d.StockOutId = o.Id
left join Clients c on o.ClientId = c.Id
left join Products p on d.ProductId = p.Id
left join Stores s on d.StoreId = s.Id
WHERE InventoryId=?
ORDER BY UpdateSequ";
        $query = $this->db->query($sql,array($inventory_id,$inventory_id));
        return $query->result();   
    }

    public function find_in($id){
        $query_main = $this->db->query("select * from StockIns where Id=?",array($id));
        $query_details = $this->db->query("select * from StockInDetails where StockInId=?",array($id));
        $row = $query_main->row();
        $row->details = $query_details->result();
        return $row;
    }
    public function find_out($id){
        $query_main = $this->db->query("select * from StockOuts where Id=?",array($id));
        $query_details = $this->db->query("select d.*,p.Name as ProductName, p.Specification 
            from StockOutDetails d
            left join Products p on d.ProductId = p.Id
            where d.StockOutId=?",array($id));
        $row = $query_main->row();
        $row->details = $query_details->result();
        return $row;
    }

}