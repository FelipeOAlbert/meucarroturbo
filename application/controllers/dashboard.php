<?php defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model("user_model", "user");
		
		$this->validation= array(
			array(
				'field'	=> 'name',
				'label'	=> 'Nome',
				'rules' => 'trim|required',
			),
			array(
				'field'	=> 'email',
				'label'	=> 'Email',
				'rules' => 'trim|required|valid_email|is_unique[user.email]',
			)
		);
	}

	public function index($pagina=1, $busca=false, $tipo=false)
	{
		$this->security_model->is_logged();
		
		$this->load->view($this->router->class.'/'.$this->router->method);
	}

	public function personal_info()
	{
		$this->security_model->is_logged();
		
		$data['row']		= $this->user->getAll(array('id' => $this->session->userdata('user_id')));
		
		// verificando se o email e diferente do que o user ja tem...
		if($data['row']['email'] == $this->input->post('email')){
			$this->validation[1]['rules'] = 'trim|required|valid_email';
		}
		
		// verificando se a senha foi alterada
		if(!empty($_POST['password']) and !empty($_POST['confirm_password'])){
			$this->validation[] = array(
				'field'	=> 'password',
				'label'	=> 'Senha',
				'rules' => 'trim|required|matches[confirm_password]',
			);
			$this->validation[] = array(
				'field'	=> 'confirm_password',
				'label'	=> 'Confirmar Senha',
				'rules' => 'trim|required',
			);
		}
		
		$this->form_validation->set_rules($this->validation);
		
		if($_POST && $this->form_validation->run() === TRUE){
			
			if($this->user->save_profile()){
				$retorno			= true;
				$data['mensagem']	= 'Dados Atualizados com sucesso';
			}else{
				$retorno=false;
				$data['mensagem'] = 'Erro ao atualizar os dados';
			}
			
			$this->session->set_userdata('mensagem', array('mensagem'=>$data['mensagem'],'retorno'=>$retorno));
			
			redirect("dashboard");
		}
		
		$this->load->view('dashboard/personal-info',$data);
	}

	public function signin($id = false)
	{
		$data['erro'] = false;
		
		if($id){
			$data['erro'] = 'Necessário fazer login para acessar a página solicitada!';
		}
		
		if( $this->input->post("login", false) != false && $this->input->post("password", false) != false ){
			
			if($this->security_model->login_admin()){
				redirect("dashboard");
			}else{
				$data['erro'] = "Login ou Senha inválidos!";
			}
		}
		
		$this->load->view($this->router->class.'/'.$this->router->method, $data);
	}
	
	public final function logout()
	{
		$this->session->sess_destroy();
		redirect('dashboard');
	}
}