<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store extends Front_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("store_model","Model");
    }

    public function index()
    {
        $store_id = $this->input->post_get("store_id");
        $data["user"] = $this->user;
        $data["store_id"] = isset($store_id)?$store_id:0;
        $this->load->view("share/header");
		$this->load->view("store/index",$data);
		$this->load->view("share/footer");
    }
    public function manage()
    {
        $data["user"] = $this->user;
        $this->load->view("share/header");
		$this->load->view("store/manage",$data);
		$this->load->view("share/footer");
    }
    public function detail()
    {
        $data["user"] = $this->user;
        $data["inventory_id"] = $this->input->post_get("inventory_id");   
        $data["product_id"] = $this->input->post_get("product_id");  
        $data["store_id"] = $this->input->post_get("store_id");        
        $this->load->view("share/header");
        $this->load->view("store/detail",$data);
        $this->load->view("share/footer");
    }
    
    public function Items()
    {
        $data = $this->Model->Items();
        return $this->success_json($data);
    }
    public function Exists()
    {
        $name = $this->input->post_get("name");
        if (!$name){
            return $this->failure_json("input ".$this->Model->Name." name.");
        }
        $found = $this->Model->Exists($name);
        return $this->success_json($found);
    }
    public function Add()
    {
        $name= $this->input->post_get("Name");
        if (!$this->Model->Exists($name)){
            $data = $this->Model->AddItem($name,
            $this->input->post_get("Phone"),
            $this->input->post_get("Manager"),
            $this->input->post_get("Address"),
            $this->input->post_get("Fax"));
            return $this->success_json($data);
        }else{
            return $this->failure_json($this->Model->Name." name exists");
        }
    }
     public function Edit()
    {
        $id = $this->input->post_get("Id");
        if (!$id){
            return $this->failure_json("Please input the ".$this->Model->Name." Id");
        }
        $data = $this->Model->EditItem($id, 
            $this->input->post_get("Name"),           
            $this->input->post_get("Phone"),
            $this->input->post_get("Manager"),            
            $this->input->post_get("Address"),
            $this->input->post_get("Fax")
        );
        return $this->success_json($data);

    }
    public function Remove()
    {
        $id = $this->input->post_get("Id");
        if (!$id){
            return $this->failure_json("Please input the ".$this->Model->Name." Id");
        }
        $this->Model->RemoveItem($id);
        $this->success_json($id);
    }
}