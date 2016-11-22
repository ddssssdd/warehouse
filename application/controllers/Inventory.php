<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends Front_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("inventory_model","Model");
    }
    public function Items()
    {
        $data = $this->Model->Items();
        return $this->success_json($data);
    }
    
    public function Add()
    {
        $data = $this->Model->AddItem(
            $this->input->post_get("storeId"),
            $this->input->post_get("productId"),
            $this->input->post_get("vendorId"),
            $this->input->post_get("quantity"),
            $this->input->post_get("inprice"),
            $this->input->post_get("indate"),
            $this->input->post_get("userId")
            );
        return $this->success_json($data);
    }
  
}