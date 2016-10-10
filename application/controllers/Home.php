<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends Front_Controller
{
	function __construct()
	{
		parent::__construct();

	}	
	public function index()
	{
		$this->view('index',array());		
	}
}