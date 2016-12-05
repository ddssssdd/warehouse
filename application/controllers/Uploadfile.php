<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Uploadfile extends Front_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}	
	public function index()
	{
		$this->load->view("share/header");
		$this->load->view("home/standard");
		$this->load->view("share/footer");
	}

	
	public function post()
	{

		$config['upload_path']      = './uploads/';
        $config['allowed_types']    = 'gif|jpg|png|mp3|pdf|doc|docx|apk';
        $config['max_size']     = 1000000;
        //$config['max_width']        = 1024;
        //$config['max_height']       = 768;
        $config['file_name']  = time(); //文件名不使用原始名
        $this->load->library('upload', $config);
		$files = $_FILES;
        if ( ! $this->upload->do_upload('uploadFile'))
        {
        	
            $error = array('error' => $this->upload->display_errors(),"files" => $files);

            //$this->load->view('upload_form', $error);
            $this->json($error);
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());

        	$result = $this->save($this->upload->data());
        	if ($data["file_ext"] == '.apk'){
        		$version = $this->input->post_get("version");
        		$version =isset($version)?$version:1;
        		$item = array("ToUserId" => 0, "Title" =>"Update apk","Link"=>$result->Link,"Type"=>"Install","Version" =>$version);
        		$this->db->insert("Messages",$item);
        	}
            $this->json(array("result" =>$result,"files" =>$files));
        }
	}
	private function save($data){
		$userId = 1;
		$item = array("UserId" =>$userId,
			"FileName" => $data["file_name"],
			"FileType" => $data["file_type"],
			"FilePath" => $data["file_path"],
			"FullPath" => $data["full_path"],
			"RawName" => $data["raw_name"],
			"FileExt" => $data["file_ext"],
			"FileSize" => $data["file_size"],
			"IsImage" => $data["is_image"],
			"ImageWidth" => $data["image_width"],
			"ImageHeight" => $data["image_height"],
			);
		$this->db->insert("Uploads",$item);
		$id =  $this->db->insert_id();
		return $this->find($id);
	}
	private function find($id){
		$query = $this->db->query("select * from Uploads where id=?",array($id));
		if ($query->row()){
			$result = $query->row();	
			$result->Link = base_url("uploads/".$result->FileName);
			return $result;
			//return $result->link;
		}
		return null;
		
	}
	public function download(){
		$id = $this->input->get_post("id");
		$data = $this->find($id);
		$this->json($data);
	}
}