<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stocks extends Front_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("StockIn_model","Model");
    }

    public function in()
    {
        $data["user"] = $this->user;
        $this->load->view("share/header");
		$this->load->view("stocks/in",$data);
		$this->load->view("share/footer");
    }

    //json items;
    public function save()
    {
        //$data = $_REQUEST;
        $data = $this->input->post(NULL,TRUE);
        foreach($data["details"] as &$item){
            
        }
        $result = $this->Model->SaveStockIn($data,$this->user["userId"]);
        $this->success_json($result);
    }
    public function Items()
    {
        $data = $this->Model->Items();
        return $this->success_json($data);
    }
    
    public function NewStock()
    {
       $data = $this->Model->NewStockIn(
            $this->input->post_get("InvoiceNo"),
            $this->input->post_get("VendorId"),
            $this->input->post_get("TotalPrice"),
            $this->input->post_get("TotalNo"),
            $this->user["userId"],
            $this->input->post_get("Memo"),
            $this->input->post_get("EnteredDate"),
            $this->input->post_get("StoreId")
            );
        return $this->success_json($data);
    }
  
}