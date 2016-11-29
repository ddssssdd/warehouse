<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends Front_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("client_model","Model");
    }
    public function index(){
        $data["user"] = $this->user;
        $this->load->view("share/header");
		$this->load->view("client/index",$data);
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
            return $this->failure_json("input client name.");
        }
        $found = $this->Model->Exists($name);
        return $this->success_json($found);
    }
    public function Add()
    {
        $name= $this->input->post_get("Name");
        if (!$this->Model->Exists($name)){
            $data = $this->Model->AddClient($name,
            $this->input->post_get("Phone"),
            $this->input->post_get("Email"),
            $this->input->post_get("Address"),
            $this->input->post_get("Fax"),
            $this->input->post_get("ContactName"),
            $this->input->post_get("ContactCellphone")
            );
            return $this->success_json($data);
        }else{
            return $this->failure_json("Client name exists");
        }
    }
    public function Edit()
    {
        $id = $this->input->post_get("Id");
        if (!$id){
            return $this->failure_json("Please input the client Id");
        }
        $data = $this->Model->EditClient($id,            
            $this->input->post_get("Name"),
            $this->input->post_get("Phone"),
            $this->input->post_get("Email"),            
            $this->input->post_get("Address"),
            $this->input->post_get("Fax")
        );
        return $this->success_json($data);

    }
    public function Remove()
    {
        $id = $this->input->post_get("id");
        if (!$id){
            return $this->failure_json("Please input the client Id");
        }
        $this->Model->RemoveItem($id);
        $this->success_json($id);
    }
}