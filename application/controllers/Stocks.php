<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stocks extends Front_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Stocks_model","Model");
    }

    public function in()
    {
        $id = $this->input->get_post("id");
        $data["id"]= isset($id)?$id:0;
        $data["user"] = $this->user;
        $this->load->view("share/header");
		$this->load->view("stocks/in",$data);
		$this->load->view("share/footer");
    }
    public function out()
    {
        $id = $this->input->get_post("id");
        $data["id"]= isset($id)?$id:0;
        $data["user"] = $this->user;
        $this->load->view("share/header");
        $this->load->view("stocks/out",$data);
        $this->load->view("share/footer");
    }

    //json items;
    public function save_in()
    {
        //$data = $_REQUEST;
        $data = $this->input->post(NULL,TRUE);
        foreach($data["details"] as &$item){
            
        }
        $result = $this->Model->SaveStockIn($data,$this->user["userId"]);
        $this->success_json($result);
    }
    public function save_out()
    {
        //$data = $_REQUEST;
        $data = $this->input->post(NULL,TRUE);
        foreach($data["details"] as &$item){
            
        }
        $result = $this->Model->SaveStockOut($data,$this->user["userId"]);
        $this->success_json($result);
    }
    public function ItemsIn()
    {
        $data = $this->Model->ItemsIn();
        return $this->success_json($data);
    }
    public function ItemsOut()
    {
        $data = $this->Model->ItemsOut();
        return $this->success_json($data);
    }
    
    public function products()
    {
       $store_id = $this->input->post_get("store_id");
       $data = $this->Model->products($store_id);
       return $this->success_json($data);
    }

    public function details()
    {
       $store_id = $this->input->post_get("store_id");
       $product_id = $this->input->post_get("product_id");
       $inventory_id = $this->input->post_get("inventory_id");
       $data = $this->Model->details($inventory_id,$store_id,$product_id);
       return $this->success_json($data);
    }
    public function stock_in(){
        $id = $this->input->get_post("id");
        $result = $this->Model->find_in($id);
        return $this->success_json($result);
    }
    public function stock_out(){
        $id = $this->input->get_post("id");
        $result = $this->Model->find_out($id);
        return $this->success_json($result);
    }
    
}