<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends Front_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("contact_model","Model");
    }
    public function Items()
    {
        $data = $this->Model->Items();
        return $this->success_json($data);
    }
    
    public function Add()
    {
        $data = $this->Model->AddContact(
            $this->input->post_get("name"),
            $this->input->post_get("phone"),
            $this->input->post_get("email"),
            $this->input->post_get("cellphone"),
            $this->input->post_get("address"),
            $this->input->post_get("qq"),
            $this->input->post_get("weixin"),
            $this->input->post_get("memo")
            );
        return $this->success_json($data);
    }
    public function Edit()
    {
        $id = $this->input->post_get("id");
        if (!$id){
            return $this->failure_json("Please input the contact Id");
        }
        $data = $this->Model->EditContact($id,
            $this->input->post_get("name"),
            $this->input->post_get("phone"),
            $this->input->post_get("email"),
            $this->input->post_get("cellphone"),
            $this->input->post_get("address"),
            $this->input->post_get("qq"),
            $this->input->post_get("weixin"),
            $this->input->post_get("memo")
        );
        return $this->success_json($data);

    }
}