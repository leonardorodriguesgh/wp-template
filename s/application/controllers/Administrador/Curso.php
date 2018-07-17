<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curso extends CI_Controller {

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

		$this->load->model('Curso_model');
		$this->load->model('Turma_model');
		$this->load->model('Aluno_model');
		$this->load->model('Solicitacao_model');
		$this->load->helper(array('form', 'url'));
		$this->redirecionar_login();
		$this->redirecionar_perfil();
	}
	

	/*
	|--------------------------------------------------------------------------
	| Variável privada setando a permissão
	|--------------------------------------------------------------------------
	|
	|
	|
	|
	*/	

	/*----------------------------------------
	Inserir dados no banco
	------------------------------------------

	*/
	
	public function cadastrar_curso() {
		//if($_SERVER['REQUEST_METHOD'] == 'POST'){

		$data['ativo']  = 'Curso';
		$data['titulo'] = 'Cadastrar Curso';
		
		$data['cursoDados'] = $this->Curso_model->getDetalhesCadCurso(); 
		$this->load->view('administrador/templates/header', $data);
		$this->load->view('administrador/templates/nav_menu',$data);
    	
    	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nome','Nome do Curso',
										'required|min_length[2]|max_length[50]');
		$this->form_validation->set_rules('tipo','Tipo do Curso',
										'required');
		$this->form_validation->set_rules('sigla','Sigla do Curso',
										'required|min_length[2]|max_length[3]');
		

		if(!$this->form_validation->run())
		{
			
			
			$data['message'] = "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><h4 class='alert alert-danger alert-dismissible fade in' role='alert'>Houve um erro no sistema".validation_errors()."</h4>";
		}
		else
		{
			
			$nome=$this->input->post('nome');
			$tipo=$this->input->post('tipo');
			$sigla=$this->input->post('sigla');
			$situacao=$this->input->post('situacao');
			$ds_curso=$this->input->post('ds_curso');
			
			$nm_tag_curso = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$nome);
			$tag = str_replace(" ", "-", $nm_tag_curso);
			$tag_curso = strtolower($tag);
			if($this->Curso_model->adicionar($tag_curso, $nome, $tipo, $sigla, $situacao, $ds_curso))
			{
				$data['message'] = "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><h4 class='alert alert-success alert-dismissible fade in' role='alert'>curso cadastrado :)</h4>";
			}else{			
			
				$data['message'] = "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><h4 class='alert alert-danger alert-dismissible fade in' role='alert'>Houve um erro no sistema</h4>";	
			}
		}

		$this->load->view('administrador/perfil/curso/cadastrar', $data); 
    	$this->load->view('administrador/templates/footer');
		//}
	}
	/*
	-----------------------------------------
	UPDATE DE DADOS 
	-----------------------------------------
	*/
	public function editar_curso($id) {

		$data['ativo']  = 'Curso';
		$data['titulo'] = 'Editar Curso '.$id;

		$data['cursoDados'] = $this->Curso_model->getDetalhesCurso($id); 
		$data['bannerDados'] = $this->Curso_model->getBanner($id);
		$this->load->view('administrador/templates/header', $data);
		$this->load->view('administrador/templates/nav_menu',$data);
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('nome','Nome do Curso',
										'required|min_length[2]|max_length[50]');
		$this->form_validation->set_rules('tipo','Tipo do Curso');
		$this->form_validation->set_rules('sigla','Sigla do Curso','min_length[2]|max_length[3]');
		//$this->form_validation->set_rules('inicio','Inicio do Curso',
		//								'required');
		//$this->form_validation->set_rules('termino','Termino do Curso',
		//								'required');
		$this->form_validation->set_rules('ativo','Curso Ativo',
											'required|min_length[1]|max_length[1]');


		if(!$this->form_validation->run())
		{
			
			$data['message'] = "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><h4 class='alert alert-danger alert-dismissible fade in' role='alert'>Erro na atualização".validation_errors()."</h4>";
		}
		else
		{
			$id_curso = $this->input->post('codigo');
			$nome=$this->input->post('nome');
			$tipo=$this->input->post('tipo');
			$sigla=$this->input->post('sigla');
			$situacao=$this->input->post('situacao');
			$ds_curso=$this->input->post('ds_curso');
			$ativo=$this->input->post('ativo');


			$this->Curso_model->editar($id_curso, $nome, $tipo, $sigla, $situacao, $ds_curso, $ativo);
			$query = $this->db->select('*')->from('tb_curso')->where('codigo', $id_curso)->get();
			$qr = $query->row();
			//var_dump($qr);
			if ($qr->codigo = $id_curso){
				//redirect(base_url('?'));

				$data['message'] = "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><h4 class='alert alert-success alert-dismissible fade in' role='alert'>Curso atualizado :)</h4>";
				 
				
				
			}else{
				$data['message'] = "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><h4 class='alert alert-danger alert-dismissible fade in' role='alert'>Erro na atualização</h4>";
				
			}

		}

		$this->load->view('administrador/perfil/curso/editar',$data);
		$this->load->view('administrador/templates/footer');

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
		$data['ativo']  = 'Curso';
		$data['titulo'] = 'Administrar Cursos';

		$this->load->view('administrador/templates/header', $data);		
		$this->load->view('administrador/templates/nav_menu',$data);
		$data['certificadoNum'] = $this->Solicitacao_model->getCertificadolMes();
		
		$query = $this->db->query('SELECT * FROM tb_curso');
		$data['num'] = $query->num_rows();		
		$data['count'] = $this->input->post('limite');		
		$nome = $this->input->post('cursoSearch');
		$data['query'] = $this->Curso_model->getCursoIndex($nome, $data['count']);
		

		if(empty($data['query']) && ($nome) == ""){	     	
	     	/*$data['query'] = $this->Curso_model->getCurso(); */ 
	     	$data['message'] = "";
	    }if(empty($data['query']) && !empty($nome)){
	    	$data['message'] = "<p class='alert alert-danger'>Curso inexistente</p>";
	    }elseif(!empty($data['query']) && !empty($nome)){
	    	$data['message'] = "";
	    }	    	    	   

	    /*$this->load->library('pagination');

		$config['base_url'] = site_url('a/cursos');
		$query = $this->db->select('*')->from('tb_curso')->get();
		$config['total_rows'] = $query->num_rows();
		$config['per_page'] = 5;

		$this->pagination->initialize($config);

		$data['pagination'] = $this->pagination->create_links();*/
		
    	$this->load->view('administrador/perfil/curso/lista', $data);   
    	$this->load->view('administrador/templates/footer'); 
    	//$this->select_curso();
	}
	
	

	public function select_curso($id){
		
		$data['ativo']  = 'curso';
		$data['titulo'] = 'Curso '. $id;
		$this->load->view('administrador/templates/header', $data);		
		$this->load->view('administrador/templates/nav_menu',$data);
		$data['cursoDados'] = $this->Curso_model->getDetalhesCurso($id);   
		$data['bannerDados'] = $this->Curso_model->getBanner($id);
		
		//var_dump($id); 
		// $id = $this->input->post('id_curso');
		// $get_id['data'] = $this->Curso_model->mostrar_detalhes($id);
		
			//echo '<pre>';
			//url de insersao
			/*var_dump($caminho['url']);*/
		$ativo = 1 || 0;	
		$data['cursoNum'] = $this->Curso_model->contaCurso($ativo);
			
		if(isset($_POST['det'])){
			$nome = $this->input->post('turmaSearch');
			$data['turma'] = $this->Turma_model->getTurmaIndex($nome, $id);
			$this->load->view('administrador/perfil/curso/editar', $data);
		}else{
			redirect('administrador/turma/index/'.$id);
		}
		$this->load->view('administrador/templates/footer');
		
		

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
	private function redirecionar_perfil() {
		if( $this->session->userdata('perfil') != 1 )		
			redirect('/');
	}	*/
	public function cadBanner($id_curso){
		$data['ativo']  = 'curso';
		$data['titulo'] = 'Curso '. $id_curso;

		
		$this->load->view('administrador/templates/header', $data);		
		$this->load->view('administrador/templates/nav_menu', $data);
		$data['cursoDados'] = $this->Curso_model->getDetalhesCurso($id_curso);   
		$data['bannerDados'] = $this->Curso_model->getBanner($id_curso);
		/*Resgata path da img 		
		var_dump($data['cursoDados']);
		var_dump($data['bannerDados']);*/

		if($data['cursoDados']['codigo']){
			
			$desktop['file'] = $_FILES['desktop'];
			$caminho1 = $this->my_functions->enviar_imagem_original( '/wordpress/s', '/assets/images/sistema/banner-curso', $desktop);
			print_r($caminho1);
			$data['callback'] = $this->Curso_model->adicionaBannerCurso($id_curso, $caminho1['url']);
			$data['message'] = "<h4 class='alert alert-success'>Banner cadastrado!!</h4>";
		
			$mobile['file'] = $_FILES['desktop'];
			$caminho2 = $this->my_functions->enviar_imagem_original( '/wordpress/s', '/assets/images/sistema/banner-curso', $mobile);
			print_r($caminho2);
			$data['callback'] = $this->Curso_model->adicionaBannerCurso($id_curso, $caminho2['url']);
			$data['message'] = "<h4 class='alert alert-success'>Banner cadastrado!!</h4>";
	
		}else{
			echo "Para proceder cadastre mais um curso";
		}



		$this->load->view('administrador/perfil/curso/editar', $data);   
	    $this->load->view('administrador/templates/footer'); 
		
    	
	}

	public function editBanner($id_curso){
		$data['ativo']  = 'curso';
		$data['titulo'] = 'Curso '. $id_curso;
		
		$this->load->view('administrador/templates/header', $data);		
		$this->load->view('administrador/templates/nav_menu', $data);
		$data['cursoDados'] = $this->Curso_model->getDetalhesCurso($id_curso);   
		$data['bannerDados'] = $this->Curso_model->getBanner($id_curso);
		/*Resgata path da img */
		$arquivo['file'] = $_FILES['desktop'];
		$caminho = $this->my_functions->enviar_imagem( '/lisieuxtreinamentos/sistema', '/assets/images/sistema/banner-curso', $arquivo, 500 , 200 );
		//var_dump($caminho);
		$data['callback'] = $this->Curso_model->editaBannerCurso($id_curso, $caminho['url']);
		$data['message'] = "<h4 class='alert alert-success'>Banner atualizado!!</h4>";
		
		$this->load->view('administrador/perfil/curso/detalhes', $data);   
    	$this->load->view('administrador/templates/footer'); 
			
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
		//$this->load->view('administrador/perfil/curso/editar');
		//$this->load->view('administrador/perfil/curso/editar');

		//$this->load->view('administrador/base', $data);

	}*/

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