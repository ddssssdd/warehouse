<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends Front_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("product_model","Model");
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
        $name= $this->input->post_get("name");
        if (!$this->Model->Exists($name)){
            $data = $this->Model->AddItem($name,
            $this->input->post_get("specification"),
            $this->input->post_get("unit"),
            $this->input->post_get("width"),
            $this->input->post_get("height"),
            $this->input->post_get("length"),
            $this->input->post_get("brand"),
            $this->input->post_get("barcode")
            );
            return $this->success_json($data);
        }else{
            return $this->failure_json($this->Model->Name." name exists");
        }
    }
     public function Edit()
    {
        $id = $this->input->post_get("id");
        if (!$id){
            return $this->failure_json("Please input the ".$this->Model->Name." Id");
        }
        $data = $this->Model->EditItem($id,            
             $this->input->post_get("specification"),
            $this->input->post_get("unit"),
            $this->input->post_get("width"),
            $this->input->post_get("height"),
            $this->input->post_get("length"),
            $this->input->post_get("brand"),
            $this->input->post_get("barcode")
        );
        return $this->success_json($data);

    }
}