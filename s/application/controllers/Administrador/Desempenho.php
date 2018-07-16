<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Desempenho extends CI_Controller {

	public function __construct() {

		parent::__construct();

		$this->redirecionar_login();
		$this->load->model('Curso_model');
		$this->load->model('Aluno_model');
		$this->load->model('Solicitacao_model');
		$this->redirecionar_perfil();
		$this->redirecionar_login();
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


		$data['ativo']  = 'desempenho';
		$data['titulo'] = 'Desempenho';

		$ativo = 1 || 0;
		$data['cursoNum'] = $this->Curso_model->contaCurso($ativo);
		$data['certificadoNum'] = $this->Solicitacao_model->getCertificadolMes();
		$data['alunoNum'] = $this->Aluno_model->getAlunoMes();

		$this->load->view('administrador/templates/header', $data);
		$this->load->view('administrador/templates/nav_menu',$data);

		$nome = $this->input->post('alunoSearch');
		$data['query'] = $this->Aluno_model->getAlunoIndex($nome);

		if(isset($data['query'][0]['codigo'])){$id = $data['query'][0]['codigo'];}else{$id = "";}
		//var_dump($data['query']);
		
		$data['aluno'] = $this->Aluno_model->getAluno($id);
		//var_dump($data['aluno']);
		$cpf = $data['aluno']['cpf'];
		$data['cpf'] = $this->my_functions->formatar_cpf($cpf);

		if(empty($data['query']) && ($nome) == ""){	     	
	     	/*$data['query'] = $this->Curso_model->getCurso(); */ 
	     	$data['message'] = "";
	    }if(($data['query']) == null && !empty($nome)){
	    	$data['message'] = "<p class='alert alert-danger'>Aluno inexistente</p>";
	    }elseif(!empty($data['query']) && !empty($nome)){
	    	$data['message'] = "";
	    }	    	    
		$this->load->view('administrador/perfil/desempenho/indice', $data);
		$this->load->view('administrador/templates/footer', $data);

	}

	public function select_aluno_desempenho($aluno){
		$data['ativo']  = 'desempenho';
		$data['titulo'] = 'Desempenho';

		$ativo = 1 || 0;
		$data['cursoNum'] = $this->Curso_model->contaCurso($ativo);
		$data['alunoUsuario'] = $this->Aluno_model->getAlunoUsuario($aluno);  

		$this->load->view('administrador/templates/header', $data);
		$this->load->view('administrador/templates/nav_menu',$data);
		$this->load->view('administrador/perfil/desempenho/detalhes');
		$this->load->view('administrador/templates/footer', $data);
	}
}