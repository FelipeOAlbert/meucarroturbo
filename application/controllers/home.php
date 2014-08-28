<?php defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller {
	
	private $keyword, $data;
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('seller_model', 'seller');
		
		$this->data = array();
	}
	
	public final function render($method, $data = array())
	{
		$this->load->view('site/common/head', $data);
		$this->load->view('site/'.$method, $data);
		$this->load->view('site/common/footer');
	}
	
	public function index()
	{
		$this->load->view('site/home');
		
		//die('Home');
		
		//$data['title']			= EMPRESA;
		//$empresa				= $this->business->getAll();
		//$data['description']	= strip_tags(character_limiter($empresa['description'], 160));
		//$data['keywords']		= $this->keyword;
		//$data['banners']		= $this->banner->getAll(array('status_id' => 1), false, true);
		//$data['rows']			= $this->service->list_site(array('status_id' => 1, 'list' => 1));
		
		//$this->render($this->router->method, $data);
	}
	
	function login_fb()
	{
		
		// verifica se email do usuario está cadastrado na base
		$user	= $this->seller->getAll(array('email' => $this->input->post('email', false)));
		
		if($user){
			
			// se ja estiver na base, verifica se tem o fb_id, caso sim faz o login
			
		}else{
			
			// faz o cadastro....
			if(!$this->seller->save_fb())
				return json_encode(array('status' => 'error', 'message' => 'Erro ao cadastrar usuário'));
			
			// faz o login
			$this->security_model->fb_login();
			
		}
		
		printr($user);
		
		die('ki');
		
	}
	
	
	public function business()
	{
		$data['row']			= $this->business->getAll();
		$data['title']			= EMPRESA.' - Empresa';
		$data['description']	= strip_tags(character_limiter($data['row']['description'], 160));
		$data['keywords']		= $this->keyword;
		
		$this->render($this->router->method, $data);
	}
	
	public function notice()
	{
		$data['title'] 			= EMPRESA.' - Notícias';
		$data['rows']			= $this->notice->getAll(array('status_id' => 1), false, true, "fixed desc, id desc");
		$data['description']	= strip_tags(character_limiter('Carmianics Noticias do mundo automotivo', 160));
		$data['keywords']		= $this->keyword;
		
		$this->render($this->router->method, $data);
	}
	
	public function notice_view($id)
	{
		$data['row']	= $this->notice->getAll(array('id' => $id));
		
		if($data['row']){
			$data['title'] 			= EMPRESA.' - '.$data['row']['name'];
			$data['description']	= strip_tags(character_limiter($data['row']['description'], 160));
			$data['keywords']		= $this->keyword;
		}
		
		$this->render($this->router->method, $data);
	}
	
	public function service()
	{
		$data['title'] 			= EMPRESA.' - Serviços';
		$data['rows']			= $this->service->list_site();
		$data['description']	= strip_tags(character_limiter('Confira nossos serviços em atendimento à domicílio', 160));
		$data['keywords']		= $this->keyword;
		
		$this->render($this->router->method, $data);
	}
	
	public function service_detail($id)
	{
		$data['row']	= $this->service->getAll(array('id' => $id));
		
		if($data['row']){
			$data['title'] 			= EMPRESA.' - '.strip_tags($data['row']['name']);
			$data['description']	= strip_tags(character_limiter($data['row']['description'], 160));
			$data['keywords']		= $this->keyword;
		}
		
		$this->render($this->router->method, $data);
	}
	
	public function product()
	{
		$data['title'] 			= EMPRESA.' - Produtos';
		$data['rows']			= $this->product->list_site();
		$data['description']	= strip_tags(character_limiter('Confira nossos produtos', 160));
		$data['keywords']		= $this->keyword;
		
		$this->render($this->router->method, $data);
	}
	
	public function product_detail($id)
	{
		$data['row']	= $this->product->getAll(array('id' => $id));
		
		if($data['row']){
			$data['title'] 			= EMPRESA.' - '.strip_tags($data['row']['name']);
			$data['description']	= strip_tags(character_limiter($data['row']['description'], 160));
			$data['keywords']		= $this->keyword;
		}
		
		$this->render($this->router->method, $data);
	}
	
	public final function error_404()
	{
		$data['title'] 			= EMPRESA.' - 404';
		$empresa				= $this->business->getAll();
		$data['description']	= strip_tags(character_limiter($empresa['description'], 160));
		$data['keywords']		= $this->keyword;
		
		$this->render($this->router->method, $data);
	}
	
	public final function contact()
	{
		$data['title'] 			= EMPRESA.' - Contato';
		$empresa				= $this->business->getAll();
		$data['description']	= strip_tags(character_limiter($empresa['description'], 160));
		$data['keywords']		= $this->keyword;
		
		$this->render($this->router->method, $data);
	}
	
	public final function contact_footer()
	{
		
		$robot = $this->agent->robot();
		
		if(empty($_POST['email']) and  empty($robot)){
			
			$this->form_validation->set_rules($this->validation);
			
			if($this->form_validation->run() === TRUE){
				
				if($this->contact->save()){
					echo json_encode(array('retorno' => 'ok', 'mensagem' => 'Formulário enviado com Sucesso!'));
				}else{
					echo json_encode(array('retorno' => 'erro', 'mensagem' => 'Erro ao enviar formulário'));
				}
			}else{
				echo json_encode(array('retorno' => 'erro', 'mensagem' => validation_errors()));
			}
		}
	}
}