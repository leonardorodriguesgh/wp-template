<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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

		$data['titulo'] = "Treinamentos Lisieux - Cursos";

		$this->load->view('public_templates/header', $data);
		$this->load->view('indice');
		/*$this->load->view('');*/

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