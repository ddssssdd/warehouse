<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Outstock extends Front_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("outstock_model","Model");
    }
    public function Items()
    {
        $data = $this->Model->Items();
        return $this->success_json($data);
    }
    
    public function Out()
    {
        $data = $this->Model->AddItem(
            $this->input->post_get("storeId"),
            $this->input->post_get("productId"),
            $this->input->post_get("clientId"),
            $this->input->post_get("quantity"),
            $this->input->post_get("outprice"),
            $this->input->post_get("outdate"),
            $this->input->post_get("userId")
            );
        return $this->success_json($data);
    }
  
}