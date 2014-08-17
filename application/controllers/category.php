<?php defined('BASEPATH') OR exit('No direct script access allowed');

class category extends CI_Controller {
	
	private $validation, $data;
	
	function __construct()
	{
		parent::__construct();
		$this->security_model->is_logged();
		
		$this->load->model("category_model", "dm");
		
		$this->validation = array(
			array(
				'field'	=> 'name',
				'label'	=> 'Nome',
				'rules' => 'trim|required',
			),
		);
		
		$this->data = array();
	}
	
	public final function render($method)
	{
		$this->load->view('dashboard/'.$this->router->class.'/'.$method, $this->data);
	}
	
	public function index($pagina = 1, $busca = false)
	{
		$this->data['list']		= $this->dm->lista($pagina, $busca);
		
		if($busca){
			$this->data['paginacao']	= pagination($pagina, $this->dm->total($busca), $this->router->class.'/'.$this->router->method, $busca);
		}else{
			$this->data['paginacao']	= pagination($pagina, $this->dm->total(), $this->router->class.'/'.$this->router->method);
		}
		
		if(base64_decode($busca, true)){
			
			$busca = base64_decode($busca);
			parse_str($busca, $busca);
			$busca = array_map('trim', $busca);
			
			$this->data['search']['id']			= @$busca['id'];
			$this->data['search']['name']		= @$busca['name'];
			$this->data['search']['status_id']	= @$busca['status_id'];
		}
		
		$this->render($this->router->method, $this->data);
	}

	public function create()
	{
		$this->form_validation->set_rules($this->validation);
		
		if($this->input->post() && $this->form_validation->run() === TRUE){
			
			if($this->dm->save()){
				$this->session->set_userdata('mensagem', array('mensagem' => 'Categoria Salva com sucesso', 'retorno' => true));
			}else{
				$this->session->set_userdata('mensagem', array('mensagem' => 'Erro ao salvar categoria', 'retorno' => false));
			}
			
			redirect($this->router->class);
		}
		
		$this->render($this->router->method);
	}
	
	public function update($id)
	{
		$this->data['row']	= $this->dm->getAll(array('id' => $id));
		
		$this->form_validation->set_rules($this->validation);
		
		if($this->input->post() && $this->form_validation->run() === TRUE){
			
			if($this->dm->save($id)){
				$this->session->set_userdata('mensagem', array('mensagem' => 'Categoria editado com sucesso', 'retorno' => true));
			}else{
				$this->session->set_userdata('mensagem', array('mensagem' => 'Erro ao editar categoria', 'retorno' => false));
			}
			
			redirect($this->router->class);
		}
		
		$this->render($this->router->method);
	}
	
	public function delete($id)
	{
		if($this->dm->change_status($id, '0')){
			$this->session->set_userdata('mensagem', array('mensagem' => 'Categoria inativado com sucesso', 'retorno' => true));
		}else{
			$this->session->set_userdata('mensagem', array('mensagem' => 'Erro ao inativar categoria', 'retorno' => false));
		}
		
		redirect($this->router->class);
	}
	
	public function active($id)
	{
		if($this->dm->change_status($id, '1')){
			$this->session->set_userdata('mensagem', array('mensagem' => 'Categoria ativado com sucesso', 'retorno' => true));
		}else{
			$this->session->set_userdata('mensagem', array('mensagem' => 'Erro ao ativar categoria', 'retorno' => false));
		}
		
		redirect($this->router->class);
	}
}