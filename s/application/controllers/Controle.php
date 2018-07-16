<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controle extends CI_Controller {

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

		$this->redirecionar_login();

	}
	
	/*
	|--------------------------------------------------------------------------
	|  Verifica se o usuario esta logado no sistema.
	|--------------------------------------------------------------------------
	|
	|
	|
	|
	*/

	private function redirecionar_login() {
		if( !$this->session->userdata('logado') )
			redirect('login');
	}	


	/*
	|--------------------------------------------------------------------------
	| Controller - Indice.
	|--------------------------------------------------------------------------
	|
	|
	|
	|
	*/

	public function index() {

		switch ( $this->session->userdata('perfil') ) {
			case 1:
				redirect('adm/painel');
				break;
			case 2:
				redirect('u/painel');
				break;
			case 3:
				redirect('u');
				break;
			default:
				redirect('s');
				break;
		}

	}

	/*
	|--------------------------------------------------------------------------
	| Controller - Acesso Negado.
	|--------------------------------------------------------------------------
	|
	|
	|
	|
	*/

	public function negado() {

		$this->redirecionar_login();

		$data['ativo'] = '';
		$data['titulo'] = 'Acesso Negado';
		$data['pagina'] = 'acesso-negado.php';

		$this->load->view('errors/error_404', $data);

	}

}