<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Front_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("user_model","Model");
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
            return $this->failure_json("input user name.");
        }
        $found = $this->Model->Exists($name);
        return $this->success_json($found);
    }
    public function Add()
    {
        $name= $this->input->post_get("name");
        if (!$this->Model->Exists($name)){
            $data = $this->Model->AddItem($name,
            $this->input->post_get("cellphone"),
            $this->input->post_get("email"),
            $this->input->post_get("password"));
            return $this->success_json($data);
        }else{
            return $this->failure_json("User name exists");
        }
    }
     public function Edit()
    {
        $id = $this->input->post_get("id");
        if (!$id){
            return $this->failure_json("Please input the user Id");
        }
        $data = $this->Model->EditItem($id,            
            $this->input->post_get("cellphone"),
            $this->input->post_get("email"),
            $this->input->post_get("password")
        );
        return $this->success_json($data);

    }
    
}