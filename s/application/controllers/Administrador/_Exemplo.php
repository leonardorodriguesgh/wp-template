<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class _Exemplo extends CI_Controller {

	/*
	|--------------------------------------------------------------------------
	| Variável privada setando a permissão
	|--------------------------------------------------------------------------
	|
	|
	|
	|
	*/

	private $permissao  = 'Exemplo';

	/*
	|--------------------------------------------------------------------------
	| Método Construtor do controller
	|--------------------------------------------------------------------------
	|
	|
	|
	|
	*/

	public function __construct() {

		parent::__construct();

		$this->redirecionar_login();		
		$this->redirecionar_perfil();

	}

	/*
	|--------------------------------------------------------------------------
	| Controller - Redirecionar para o login.
	|--------------------------------------------------------------------------
	|
	|
	|
	|
	*/

	private function redirecionar_login() {
		if(!$this->session->userdata('logado'))		
			redirect('login');
	}

	/*
	|--------------------------------------------------------------------------
	| Controller - Redirecionar para o perfil correto.
	|--------------------------------------------------------------------------
	|
	|
	|
	|
	*/

	private function redirecionar_perfil() {
		if( $this->session->userdata('perfil') != 1 )		
			redirect('/');
	}


	/*
	|--------------------------------------------------------------------------
	| Controller -
	|--------------------------------------------------------------------------
	|
	|
	|
	|
	*/

	private function verificar_cadastrar(){	
		if( !array_key_exists($this->permissao,$this->session->userdata('permissoes') ) || $this->session->userdata('permissoes')[$this->permissao]['Cadastrar'] == 0 )		
			redirect($this->session->userdata('prefixo').'/acesso-negado');
	}

	/*
	|--------------------------------------------------------------------------
	| Controller -
	|--------------------------------------------------------------------------
	|
	|
	|
	|
	*/

	private function verificar_editar(){	
		if( !array_key_exists($this->permissao,$this->session->userdata('permissoes') ) || $this->session->userdata('permissoes')[$this->permissao]['Editar'] == 0 )		
			redirect($this->session->userdata('prefixo').'/acesso-negado');
	}

	/*
	|--------------------------------------------------------------------------
	| Controller -
	|--------------------------------------------------------------------------
	|
	|
	|
	|
	*/

	private function verificar_visualizar(){	
		if( !array_key_exists($this->permissao,$this->session->userdata('permissoes') ) || $this->session->userdata('permissoes')[$this->permissao]['Consultar'] == 0 )		
			redirect($this->session->userdata('prefixo').'/acesso-negado');
	}

	/*
	|--------------------------------------------------------------------------
	| Controller -
	|--------------------------------------------------------------------------
	|
	|
	|
	|
	*/

	private function verificar_deletar(){	
		if( !array_key_exists($this->permissao,$this->session->userdata('permissoes') ) || $this->session->userdata('permissoes')[$this->permissao]['Excluir'] == 0 )		
			redirect($this->session->userdata('prefixo').'/acesso-negado');
	}

	/*
	|--------------------------------------------------------------------------
	| Controller -
	|--------------------------------------------------------------------------
	|
	|
	|
	|
	*/

	public function index() {

		$this->verificar_visualizar(); 

		$data['ativo']  = '';
		$data['titulo'] = '';
		$data['pagina'] = '';


		//$this->load->view('', $data);

	}

}