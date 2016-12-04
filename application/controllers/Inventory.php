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
    
    public function stocksin()
    {
        $data["user"] = $this->user;
        
        $this->load->view("share/header");
        $this->load->view("inventory/in",$data);
        $this->load->view("share/footer");
    }
    public function stocksout()
    {
        $data["user"] = $this->user;
        
        $this->load->view("share/header");
        $this->load->view("inventory/out",$data);
        $this->load->view("share/footer");
    }
  
}