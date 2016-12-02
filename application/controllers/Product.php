<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends Front_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("product_model","Model");
    }
    public function index(){
        $data["user"] = $this->user;
        $this->load->view("share/header");
		$this->load->view("product/index",$data);
		$this->load->view("share/footer");
    }
    public function editor(){
        $product_id = $this->input->post_get("id");
        $data["user"] = $this->user;
        $data["id"] = $product_id?$product_id:0;
        $this->load->view("share/header");
        $this->load->view("product/editor",$data);
        $this->load->view("share/footer");   
    }
    /*json*/
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
            $this->input->post_get("Specification"),
            $this->input->post_get("Unit"),
            $this->input->post_get("Price"),
            $this->input->post_get("Width"),
            $this->input->post_get("Height"),
            $this->input->post_get("Length"),
            $this->input->post_get("Brand"),            
            $this->input->post_get("Barcode")
            );
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
            $this->input->post_get("Specification"),
            $this->input->post_get("Unit"),
            $this->input->post_get("Price"),
            $this->input->post_get("Width"),
            $this->input->post_get("Height"),
            $this->input->post_get("Length"),
            $this->input->post_get("Brand"),            
            $this->input->post_get("Barcode")
        );
        return $this->success_json($data);

    }
    public function Find()
    {
        $id = $this->input->post_get("id");
        if (!$id){
            return $this->success_json(array("Id"=>0,"Name"=>"trythis"));
        }else{
            $data =  $this->Model->Find($id);
            return $this->success_json($data);
        }
    }
}