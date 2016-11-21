<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends Front_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("vendor_model","Model");
    }
    public function Items()
    {
        $data = $this->Model->Items();
        return $this->json($data);
    }
    public function Exists()
    {
        $name = $this->input->post_get("name");
        if (!$name){
            return $this->failure_json("input vendor name.");
        }
        $found = $this->Model->Exists($name);
        return $this->success_json($found);
    }
    public function Add()
    {
        $name= $this->input->post_get("name");
        if (!$this->Model->Exists($name)){
            $data = $this->Model->AddVendor($name,
            $this->input->post_get("phone"),
            $this->input->post_get("email"),
            $this->input->post_get("address"),
            $this->input->post_get("fax"));
            return $this->success_json($data);
        }else{
            return $this->failure_json("Vendor name exists");
        }
    }
}