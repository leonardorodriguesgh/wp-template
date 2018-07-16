<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	/*
	|--------------------------------------------------------------------------
	| Método construtor.
	|--------------------------------------------------------------------------
	|
	|
	|
	|
	*/

	public function __construct() {
		
		parent::__construct();
		$this->load->model('login_model');

	}
	private $permissao  = 1;
	/*
	|--------------------------------------------------------------------------
	| Controller - Login.
	|--------------------------------------------------------------------------
	| 
	| 
	| 
	| 
	*/

	public function index() {

		$this->form_validation->set_rules('email','E-mail','trim|required|valid_email');
		$this->form_validation->set_rules('senha','Senha','trim|required');
		$data['titulo'] = "Login - Lisieux Treinamentos";

		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('administrador/templates/header_login', $data);
			$this->load->view('login/logar');	
			$this->load->view('login/recuperar-senha');		
		}
		else
		{	
			
			$usuario = $this->login_model->verificarUsuario($this->input->post());

			if( !$usuario ):

				$this->session->set_flashdata('erro','Email/Senha Inválido ou Usuário inexistente!');

				redirect('login', 'refresh' );

			elseif( $usuario['suspenso'] == 1 ):	

				$this->session->set_flashdata('suspenso','Usuário suspenso, por favor entre em contato');

				redirect('login', 'refresh' );

			else:
				
				$permissoes = $this->buscar_permissoes( $usuario['perfil'] , $this->login_model->buscarPermissoes( $usuario['codigo'] ) );

				$dados = array('codigo' => $usuario['codigo'], 
							   'usuario' => $usuario['nome'], 
							   'email' => $usuario['email'], 
							   'perfil' => $usuario['perfil'], 
							   'prefixo' => $usuario['prefixo'], 
							   'permissoes' => $permissoes['permissoes'],
							   'menu' => $permissoes['menu'],
							   'profissional' => '0',
							   'logado' => TRUE);
				//$_SESSION['dados'] = $dados;

				$this->session->set_userdata($dados);

				redirect('/','refresh'); 

				//var_dump($this->session->userdata());
				

			endif;				
		}

	}

	/*
	|--------------------------------------------------------------------------
	| Controller - Recuperação de senha.
	|--------------------------------------------------------------------------
	| 
	| 
	| 
	| 
	*/

	public function recuperar_senha() {

		$this->form_validation->set_rules('email','E-mail','trim|required|valid_email');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('/login/recuperar-senha');
		}
		else
		{	
			$usuario = $this->login_model->buscarUsuarioPorEmail( $this->input->post() );

			if($usuario):

				$senha = $this->login_model->resetarSenha( $usuario['codigo'], $this->my_functions->generate_pwd() );

				$configuracao['assunto'] = '[Agendas Lisieux] Recuperação de senha';
				$configuracao['remetente'] = array(
					'nome' => 'Agendas Lisieux', 
					'email' => 'contato@summercomunicacao.com.br'
				);
				$configuracao['replayto'][] = array(
					'nome' => 'Agendas Lisieux', 
					'email' => 'contato@summercomunicacao.com.br'
				);
				$configuracao['destinatarios'][] = array(
					'nome' => $usuario['nome'], 
					'email' => $usuario['email']
				); 
				$configuracao['titulo'] = "Sua nova senha foi gerada com sucesso";
				$configuracao['dados'] = array(
					'senha:' => $senha,
					'url para Acesso:' => site_url()
				);

				$this->my_functions->enviar_email( $configuracao );

				$this->session->set_flashdata('sucesso','Recuperação de senha efetuado com sucesso! Verifique seu email');

				redirect('login', 'refresh');

			else:

				$this->session->set_flashdata('erro','Email Inválido ou Usuário inexistente');

				redirect('recuperar-senha', 'refresh');

			endif;

		}

	}

	/*
	|--------------------------------------------------------------------------
	| Controller - Sair do sistema.
	|--------------------------------------------------------------------------
	| 
	| 
	| 
	| 
	*/

	public function sair() {

		$this->session->sess_destroy();

		redirect('login', 'refresh');

	}

	/*
	|--------------------------------------------------------------------------
	| Buscar permissões e geração interna no menu.
	|--------------------------------------------------------------------------
	|
	|
	|
	|
 	*/

	private function buscar_permissoes( $_perfil , $_permissoes ) {

		$dados = array();

		foreach ($_permissoes as $_permissao):
			$dados['permissoes'][ $_permissao['modulo'] ][  $_permissao['permissao']  ] = $_permissao['acesso'];
		endforeach;

		foreach ($dados['permissoes'] as $permissão => $paginas):

			if( array_sum($paginas) > 0 ) :

				$dados['menu'][ strtolower( $this->my_functions->limpa_str( $permissão ) ) ] = $permissão;

			endif;

		endforeach;

		return $dados;
		
	}

}