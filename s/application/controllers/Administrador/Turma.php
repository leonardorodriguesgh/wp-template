<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Turma extends CI_Controller {

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

		$this->load->model('Material_model');
		$this->load->model('Curso_model');
		$this->load->model('Solicitacao_model');
		$this->load->helper(array('form', 'url'));
		$this->load->model('Turma_model');
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

	/*public function index() {

		$data['ativo']  = 'home';
		$data['titulo'] = 'Home';
		$data['pagina'] = 'indice.php';

		$this->load->view('administrador/base', $data);

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
	|--------------------------------------------------------------------------------
	|TURMAS
	|--------------------------------------------------------------------------------
	|
	|									|
	|									|
	|									|
	|									|
	|									|
	|									|
	|									|
	|									|
	|									|
	|									|
	|									|
	|									|
	|									V
	|
	|
	|
	*/

	public function select_turma($id){
		$data['ativo']  = 'turma';
		$data['titulo'] = 'Material Turma '. $id;
		$this->load->view('administrador/templates/header', $data);		
		$this->load->view('administrador/templates/nav_menu',$data);
		$data['turmaDados'] = $this->Material_model->getTurmaMaterial($id);//dados da turma  <-------------------- BUSCAR PELO ID DA TURMA E NAO PELO ID DO CURSO (MUDAR MODEL) 

		$data['materialDados'] = $this->Material_model->getAllMaterial();//dados de material de apoio
		//echo $id;
		//VOU TER QUE FAZER UM MODEL CHAMANDO O PELO ID DA TURMA
		$data['aulaDados'] = $this->Material_model->getAllAulas();
		
		
		$this->load->view('administrador/perfil/turma/material', $data);
		$this->load->view('administrador/templates/footer');
	}
	public function cadastrarMaterial($id_turma){		

		$data['ativo']  = 'turma';
		$data['titulo'] = 'Cadastrar Material';

		$this->load->view('administrador/templates/header', $data);		
		$this->load->view('administrador/templates/nav_menu',$data);
		$data['materialDados'] = $this->Material_model->getAllMaterial();//dados de material de apoio
		$data['turmaDados'] = $this->Material_model->getTurmaMaterial($id_turma);

		$this->load->library('form_validation');
		$this->form_validation->set_rules('nm_mat', 'Name', 'trim|required');
		$this->form_validation->set_rules('descricao', 'Descricao', 'trim|required');
		if (empty($_FILES['materialFiles']['name']))
		{
		    $this->form_validation->set_rules('materialFiles', 'Document', 'required');
		}

		if ($this->form_validation->run()) {
		
			$nome = $this->input->post('nm_mat');
			$descricao = $this->input->post('descricao');
			$arquivo['file'] = $_FILES['materialFiles'];
			
			$caminho = $this->my_functions->enviar_imagem( '/lisieuxtreinamentos/sistema', '/assets/material-apoio/', $arquivo, 500 , 200 );		
			$data['callback'] = $this->Material_model->adicionaMaterialApoio($nome, $descricao, $caminho['url'], $id_turma);
			$data['message'] = "<h4 class='alert alert-success'>Material cadastrado!!</h4>";
		
		}else{
			$data['message'] = "<h4 class='alert alert-danger'>".validation_errors()."</h4>";
		}
		$this->load->view('administrador/perfil/turma/material', $data);
		$this->load->view('administrador/templates/footer');
	}

	

	public function index($id){
		$data['ativo']  = 'curso';
		$data['titulo'] = 'Turmas do curso '. $id;
		$this->load->view('administrador/templates/header', $data);		
		$this->load->view('administrador/templates/nav_menu',$data);
		$data['certificadoNum'] = $this->Solicitacao_model->getCertificadolMes();
		//$data['turmaDados'] = $this->Turma_model->getDetalhesTurma($id);   
		//$data['bannerDados'] = $this->Curso_model->getBanner($id);
		$ativo = 1 || 0;	
		$data['cursoNum'] = $this->Curso_model->contaCurso($ativo);

		/*$nome = $this->input->post('turmaSearch');
		$data['turma'] = $this->Curso_model->getTurmaIndex($id, $nome);*/
		//echo $id;
		//var_dump($data['turmaDados']);

		$nome = $this->input->post('turmaSearch');
		$data['turma'] = $this->Turma_model->getTurmaIndex($id, $nome);
		//var_dump($data['turma']);
		$this->load->view('administrador/perfil/turma/indice', $data);
		
		$this->load->view('administrador/templates/footer');
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

	/*
	|--------------------------------------------------------------------------
	| Controller - Cadastrar Turma
	|--------------------------------------------------------------------------
	|
	|
	|
	|
	*/

	public function cadastrar() {

		$this->load->library('form_validation');
		$this->form_validation->set_rules('nome','Nome da Turma',
										'required|min_length[5]|max_length[50]');
		$this->form_validation->set_rules('Tipo','Tipo da Turma',
										'required');
		$this->form_validation->set_rules('inicio','Inicio da Turma',
										'required');
		$this->form_validation->set_rules('termino','Termino da Turma',
										'required');

		if($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{
			$nome=$this->input->post('nome');
			$tipo=$this->input->post('tipo');
			$inicio=$this->input->post('inicio');
			$termino=$this->input->post('termino');

			if($this->modelturmas->adicionar($nome, $tipo, $sigla, $situacao, $ds_curso, $inicio, $termino))
			{
				redirect(base_url('?'));
			}
			else
			{
				echo "Houve um erro no sistema";	
			}

		}

	}

}