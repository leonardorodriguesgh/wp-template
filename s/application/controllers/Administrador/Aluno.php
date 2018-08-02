<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aluno extends CI_Controller {

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

		
		$this->load->model('Aluno_model');
		$this->load->model('Curso_model');
		$this->load->model('Solicitacao_model');
		$this->redirecionar_login();
		$this->redirecionar_perfil();
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
	



	/*----------------------------------------
	Inserir dados no banco
	------------------------------------------

	*/
	
	/*public function cadastrar_curso() {
		//if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('nome','Nome do Curso',
											'required|min_length[2]|max_length[50]');
			$this->form_validation->set_rules('tipo','Tipo do Curso',
											'required');
			$this->form_validation->set_rules('sigla','Sigla do Curso',
											'required|min_length[2]|max_length[3]');
			//$this->form_validation->set_rules('inicio','Inicio do Curso',
			//								'required');
			//$this->form_validation->set_rules('termino','Termino do Curso',
			//								'required');
			$this->form_validation->set_rules('ativo','Curso Ativo',
											'required|min_length[1]|max_length[1]');

			if(!$this->form_validation->run())
			{
				
				echo validation_errors();
			}
			else
			{
				
				$nome=$this->input->post('nome');
				$tipo=$this->input->post('tipo');
				$sigla=$this->input->post('sigla');
				$situacao=$this->input->post('situacao');
				$ds_curso=$this->input->post('ds_curso');
				$ativo=$this->input->post('ativo');
				

				if($this->Curso_model->adicionar($nome, $tipo, $sigla, $situacao, $ds_curso, $ativo))
				{
					//redirect(base_url('?'));
					echo "Curso cadastrado :)";
				}
				else
				{
					echo "Houve um erro no sistema";	
				}

			}
		//}
	}*/
	/*
	-----------------------------------------
	UPDATE DE DADOS 
	-----------------------------------------
	*/
	public function carregar_aluno() {

		$data['ativo']  = 'home';
		$data['titulo'] = 'Aluno';		

		$this->load->view('administrador/templates/header', $data);
		$this->load->view('administrador/templates/nav_menu',$data);
		$id = 2;
		$data['aluno'] = $this->Aluno_model->getAluno($id);
		$data['alunoUsuario'] = $this->Aluno_model->getAlunoUsuario($id);
		
		/*if($this->Aluno_model->ativarAluno(0)){
			return $this->Aluno_model->ativarAluno(1);
		}else{
			$this->Aluno_model->ativarAluno(0);
		}*/

		$this->load->view('administrador/perfil/aluno/detalhes', $data);
		$this->load->view('administrador/templates/footer');
		


	}
	/*
	|-------------------------------------------------------------
	|FUNCAO QUE ATIVA E DESATIVA OS ALUNOS RETORNANDO PARA A VIEW
	|-------------------------------------------------------------
	|
	|else{
				$this->Aluno_model->ativaAluno();
				return redirect(base_url('Aluno/carregar_aluno'));
			}
	*/

	public function ativarAluno($id){

		
		$data['aluno'] = $this->Aluno_model->getAluno($id);		
		$data['alunoUsuario'] = $this->Aluno_model->getAlunoUsuario($id);  
		
		if(isset($_POST['ativar'])){

			if($data['aluno'][0]['ativo'] == 0){
				$this->Aluno_model->ativaAluno($id);
				
				
			}
			return redirect(base_url('administrador/aluno/select_aluno/'.$id));
		}
		if(isset($_POST['desativar'])){

			if($data['aluno'][0]['ativo'] == 1){
				$this->Aluno_model->desativaAluno($id);			
				
			}
			return redirect(base_url('administrador/aluno/select_aluno/'.$id));
		}
		
	}
	/*
	|---------------------------------------------------------------------------
	|Controller - Listar cursos
	|---------------------------------------------------------------------------
	|
	|
	|
	|
	|
	*/
	/*public function listar_cursos(){
		$data['query'] = $this->Curso_model->getCurso();   
    	$this->load->view('administrador/perfil/curso/indice', $data);
    	//$this->select_curso();
	}

	public function select_curso($id){
		$data['cursoDados'] = $this->Curso_model->getDetalhesCurso($id);   
		$data['bannerDados'] = $this->Curso_model->getBanner();
		//var_dump($data); 
		// $id = $this->input->post('id_curso');
		// $get_id['data'] = $this->Curso_model->mostrar_detalhes($id);
		$this->load->view('administrador/perfil/curso/detalhes', $data);
	}*/
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

/*
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

	public function index() {

		$data['ativo']  = 'home';
		$data['titulo'] = 'Alunos';
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
		
		//$data['aluno'] = $this->Aluno_model->getAluno($id);
		//var_dump($data['aluno']);
		$cpf = $data['query'][0]['cpf'];
		$data['cpf'] = $this->my_functions->formatar_cpf($cpf);

		if(empty($data['query']) && ($nome) == ""){	     	
	     	/*$data['query'] = $this->Curso_model->getCurso(); */ 
	     	$data['message'] = "";
	    }if(($data['query']) == null && !empty($nome)){
	    	$data['message'] = "<p class='alert alert-danger'>Aluno inexistente</p>";
	    }elseif(!empty($data['query']) && !empty($nome)){
	    	$data['message'] = "";
	    }	    	    


    	$this->load->view('administrador/perfil/aluno/indice', $data);
    	$this->load->view('administrador/templates/footer');

	}


	/*
	|--------------------------------------------------------------------------
	| Controller - Detalhes
	|--------------------------------------------------------------------------
	|
	|
	|
	|
	|*/
	public function select_aluno($id){
		$data['ativo']  = 'aluno';
		$data['titulo'] = 'Aluno '. $id;
		$this->load->view('administrador/templates/header', $data);		
		$this->load->view('administrador/templates/nav_menu',$data);
		$data['aluno'] = $this->Aluno_model->getAluno($id);		
		$data['getAtivo'] = $this->Aluno_model->getAlunoAtivo($id);
		//var_dump($data['aluno']);

		$data['alunoUsuario'] = $this->Aluno_model->getAlunoUsuario($id);  
		//var_dump($data['aluno']);
		//var_dump($data); 
		// $id = $this->input->post('id_curso');
		// $get_id['data'] = $this->Curso_model->mostrar_detalhes($id);
		
			//echo '<pre>';
			//url de insersao
			/*var_dump($caminho['url']);*/
			
		

		$this->load->view('administrador/perfil/aluno/detalhes', $data);

		$this->load->view('administrador/templates/footer');
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
/*
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