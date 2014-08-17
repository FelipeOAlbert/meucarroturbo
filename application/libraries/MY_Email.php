<?php
class MY_Email extends CI_Email {

	private $assunto;
	private $title;
	private $conteudo;
	private $destinos;


 	public function __construct()
    {
        parent::__construct();
    }


	 /**
	* Ao preencher valor do chamado (OS)
    **/
	public function os_save_values($email,$content){

		$this->assunto = "Valores do chamado ".$content['id'];
		$this->title = "Valores preenchidos no chamado ".$content['id'];
		$this->conteudo = 'Olá, o chamado '.$content['id'].' foi preenchido com o valor total de <b>'.$content['value'].'</b><br /><br />
								Condutor : '.$content['conductor'].' <br />
								Horário de inicio : '.$content['start_in'].' <br />
								Horário de final : '.$content['end_in'].' <br /><br />
								Destinos : <br />'.$content['destinations_list'].' <br /><br />
								Lembrando que tempo de espera em cada destino e urgencia encarece sua corrida! <br />
								<img src="'.$content['map'].'" alt="Destinos por onde o condutor passou" /><br />
								<br>Equipe Sonic.';

		$this->destinos = $email;

		$this->envia();
	}

    /**
	* Ao cadastrar novo cliente este metodo é chamado para enviar dados de acesso
    **/
	public function novo_cliente($email){

		$this->assunto = "Sonic | Bem Vindo!";
		$this->title = "Novo Cadastro";
		$this->conteudo = 'Olá, seja bem vindo ao Sonic.<br />Para acessar sua conta utilize seu email e cnpj como login e senha, respectivamente.<br><a href="'.site_url().'">Clique aqui para acessar</a>!<br>Equipe Sonic.';

		$this->destinos = $email;

		$this->envia();
	}

	private function get_destinos(){

		//Converte um só para array
		if(is_string($this->destinos))
			$this->destinos = array($this->destinos);

		//Retira duplicados
		array_unique($this->destinos);

		return $this->destinos;
	}

	private function envia(){

		$destinos = $this->get_destinos();

		// if( ENVIRONMENT != 'production' )
		// 	return false;
		

		//envia para o primeiro do array
		$this->to( $destinos[0] );
		unset($destinos[0]);

		//Coloca os outros como copia
		$this->cc($destinos);

		$this->set_mailtype('html');
		$this->from('noreply@sonic.com.br', ' Sonic - Email do Sistema');
		$this->subject( $this->assunto );
		$corpo = '
			<html>
				<head>
				<title>Sonic - MVP</title>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
				</head>
				<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
					<table align="center" width="600" height="600" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td><img src="'.base_url().'/assets/img/header-email.jpg" width="600" height="150" alt="" style="display:block"></td>
						</tr>
						<tr>
							<td>
								<div style="border: 1px solid #e0e0e0;padding: 15px 30px;">
								<p style="font:12px Arial, sans-serif; color: #5c5c5c; line-height: 16px;">
								<strong style="font-size: 13px; color: #0180ff;">'.$this->title.'</strong>
								<br />'.$this->conteudo.'</div>
							</td>
						</tr>
					</table>
				</body>
			</html>';
		$this->message($corpo);
		
		if($this->send()){
			$this->log_mail();
			return true;
		}

		$this->log_mail(0);
		return false;
	}

	private function log_mail($status=1){
		$CI =& get_instance();
			
			$data = array(
			   'assunto' => $this->assunto,
			   'titulo' => $this->title,
			   'conteudo' => $this->conteudo,
			   'enviado' => $status,
			   'destinos' => implode(',', $this->destinos)
			);

		$CI->db->insert('log_email', $data); 
	}

}