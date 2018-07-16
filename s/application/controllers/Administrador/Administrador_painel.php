<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrador_painel extends CI_Controller {

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

		$this->load->model('Curso_model');
		$this->load->model('Aluno_model');
		$this->load->model('Solicitacao_model');
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
	| Controller - Painel Administrador
	|--------------------------------------------------------------------------
	|
	|
	|
	|
	*/
	public function index(){		
		
		$data['ativo']  = 'Home';
		$data['titulo'] = 'Lista de Cursos';	
		$ativo = 1 || 0;	
		$data['query'] = $this->Curso_model->getCurso();  
		 
		$data['cursoNum'] = $this->Curso_model->contaCurso($ativo);
		$data['certificadoNum'] = $this->Solicitacao_model->getCertificadolMes();
		$data['alunoNum'] = $this->Aluno_model->getAlunoMes();

		$this->load->view('administrador/templates/header', $data);		
		$this->load->view('administrador/templates/nav_menu',$data);
    	$this->load->view('administrador/perfil/indice', $data);
    	$this->load->view('administrador/templates/footer');		
    	//$this->select_curso();
	}

	/*
	|--------------------------------------------------------------------------
	| Controller - Perfil
	|--------------------------------------------------------------------------
	|
	|
	|
	|
	*/

	public function perfil() {

		$data['ativo']  = 'perfil';
		$data['titulo'] = 'Perfil';
		$data['pagina'] = 'perfil/indice.php';

		$this->load->view('administrador/base', $data);

	}

	/*
	|--------------------------------------------------------------------------
	| Controller - Página em Construção
	|--------------------------------------------------------------------------
	|
	|
	|
	|
	*/

	public function em_construcao() {

		$this->redirecionar_login();

		$data['ativo'] = '';
		$data['titulo'] = 'Em Construção';
		$data['pagina'] = 'em-construcao.php';

		$this->load->view('administrador/base', $data);

	}

}