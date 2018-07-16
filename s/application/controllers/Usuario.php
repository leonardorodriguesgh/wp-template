<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

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

		$this->load->helper(array('form', 'url'));
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
		if( $this->session->userdata('perfil') != 2 )		
			redirect('sair');
	}	

	/*
	|--------------------------------------------------------------------------
	| Controller - Painel Aluno
	|--------------------------------------------------------------------------
	|
	|
	|
	|
	*/

	public function index() {

		/*$data['ativo']  = 'aluno';
		$data['titulo'] = 'Aluno';*/

		$this->load->view('aluno/perfil/indice');

	}

	/*
	|--------------------------------------------------------------------------
	| Controller - Perfil
	|--------------------------------------------------------------------------
	|
	|
	|
	|
	

	public function perfil() {

		$data['ativo']  = 'perfil';
		$data['titulo'] = 'Perfil';
		$data['pagina'] = 'perfil/indice.php';

		$this->load->view('aluno/base', $data);

	}*/

}