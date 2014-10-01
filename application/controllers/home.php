<?php defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller {
	
	private $keyword;
	
	function __construct()
	{
		parent::__construct();
	}
	
	public final function render($method, $data = array())
	{
		$this->load->view('/common/head', $data);
		$this->load->view('site/'.$method, $data);
		$this->load->view('/common/footer');
	}
	
	public function index()
	{
		
		$this->render($this->router->method);
	}
	
	
}