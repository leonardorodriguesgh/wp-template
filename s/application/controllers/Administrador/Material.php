<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Material extends CI_Controller {
	
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
		$this->load->model('Solicitacao_model');
		$this->load->helper(array('form', 'url'));
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

	public function index(){
		$data['ativo']  = 'material';
		$data['titulo'] = 'Material';

		$this->load->view('administrador/templates/header', $data);		
		$this->load->view('administrador/templates/nav_menu',$data);
		$data['certificadoNum'] = $this->Solicitacao_model->getCertificadolMes();
		
		$nome = $this->input->post('materialSearch');
		$data['countMaterialMes'] = $this->Material_model->getMaterialMes();
		$data['materialDados'] = $this->Material_model->getMaterialApoio($nome);

		if(empty($data['materialDados']) && ($nome) == ""){	     	
	     	/*$data['query'] = $this->Curso_model->getCurso(); */ 
	     	$data['message'] = "";
	    }if(empty($data['materialDados']) && !empty($nome)){
	    	$data['message'] = "<p class='alert alert-danger'>Material inexistente</p>";
	    }elseif(!empty($data['materialDados']) && !empty($nome)){
	    	$data['message'] = "";
	    }	    	    
		$this->load->view('administrador/perfil/material/indice', $data);
		
		$this->load->view('administrador/templates/footer');

	}

	public function callRemove($id){
		$data['ativo']  = 'material';
		$data['titulo'] = 'Material';
		$this->load->view('administrador/templates/header', $data);		
		$this->load->view('administrador/templates/nav_menu',$data);
		$this->load->view('administrador/templates/footer');		
		$data['materialDados'] = $this->Material_model->getMaterialApoioSelected($id);
		$this->load->view('administrador/templates/material_modal', $data);
		if(isset($_POST['material'])){
			
			$this->Material_model->removeMaterial($id);
			
			echo "foi";
			
			redirect('administrador/material/');
		}
	
	}

	public function select_material($id){
		$data['ativo']  = 'material';
		$data['titulo'] = 'Material';
		$this->load->view('administrador/templates/header', $data);		
		$this->load->view('administrador/templates/nav_menu',$data);
		/*$data['materialDados'] = $this->Material_model->getMaterialApoio();*/
		$this->load->view('administrador/perfil/turma/material', $data);
		$this->load->view('administrador/templates/footer');		
		
			
		if(isset($_POST['det'])){
			//echo "det";
			redirect('administrador/material/material/'.$id);
		}elseif(isset($_POST['remove'])){
			redirect('administrador/material/callRemove/'.$id);
			/*if (isset($_POST['rmMaterial'])) {
				redirect('administrador/material/callRemove/'.$id);
			}*/
			//var_dump($id);
		}
	}

	public function material($id){
		$data['ativo']  = 'material';
		$data['titulo'] = 'Material';
		$this->load->view('administrador/templates/header', $data);		
		$this->load->view('administrador/templates/nav_menu',$data);
		/*$data['materialDados'] = $this->Material_model->getMaterialApoio();*/
		$this->load->view('administrador/perfil/turma/material', $data);
		$this->load->view('administrador/templates/footer');		
	}


	public function exercicios($id_aula){
		$data['ativo']  = 'material';
		$data['titulo'] = 'Criar Exercicios';
		$this->load->view('administrador/templates/header', $data);				
		$this->load->view('administrador/templates/nav_menu',$data);
		$data['aulaDados'] = $this->Material_model->getAula($id_aula);
		$data['questaoDados'] = $this->Material_model->getQuestaoExercicio();
		/*$data['id_tipo'] = $this->Material_model->busca_last_questao();
		var_dump($data['id_tipo']['id_tipo']);*/
		$this->load->view('administrador/perfil/material/exercicio',$data);
		$this->load->view('administrador/templates/footer');		
		$data['tipoQuestao'] = $this->Material_model->getTipoQuestao();
		$this->load->view('administrador/templates/criar_exercicio_modal', $data);
	}
	
	private function redirecionar_login() {
		if(!$this->session->userdata('logado'))		
			redirect('login');
	}

	public function cadastra_exercicio($id_aula){	
		$qt_questao = $this->input->post('counter');			
		if($qt_questao >= 1){
			echo $qt_questao;
			/*-------------- EXERCICIO ---------------*/
			$this->load->library('form_validation');
			$this->form_validation->set_rules('desc','Descricao do exercicio',
											'required|min_length[2]');

			if(!$this->form_validation->run())
			{			
				
				$_SESSION['message'] = "<h4 class='alert alert-danger'>Houve um erro no sistema".validation_errors()."</h4>";
				redirect('administrador/material/exercicios/'.$id_aula);
			}
			else
			{			
				$data['aulaDados'] = $this->Material_model->getAula($id_aula);	
				$ds_exercicio = $this->input->post('desc');
				$nm_exercicio = $data['aulaDados'][0]['titulo'];	
						
				$this->Material_model->cadastra_exercicio( $id_aula, $ds_exercicio, $nm_exercicio);
		
				/*-------------- QUESTAO ----------------*/
				
					
				$contador = $qt_questao;
				$data['id_tipo'] = $this->Material_model->busca_last_questao($qt_questao);
				for ($i=0; $i < $contador; $i++) { 
						
					//$ds_enunciado = $this->input->post('qDis');
					$qt_questao = $qt_questao - 1;
					$ds_enunciado = $this->input->post('quest['.$i.']');			
					$nm_questao = $ds_enunciado; 
					$data['questao'] = $this->Material_model->cadastra_questao($ds_enunciado, $nm_questao, $qt_questao);					
				}		
				/*-------------- /QUESTAO ----------------*/
				$_SESSION['message'] = "<h4 class='alert alert-success'>curso cadastrado :)</h4>";			
				redirect('administrador/material/exercicios/'.$id_aula);
					
			}
			/*-------------- /EXERCICIO --------------*/
			
		}else{
			
			$_SESSION['message'] = "<h4 class='alert alert-danger'>Houve um erro no sistema".validation_errors()."</h4>";
			redirect('administrador/material/exercicios/'.$id_aula);
		}
	}
	

	/*public function cadastra_questao($id_aula){
		/*$data['aulaDados'] = $this->Material_model->getAula($id_aula);	
		$descricao = $this->input->post('desc');
		$nome = $data['aulaDados'][0]['titulo'];

		$descricao = '';
		$tipo = '';
		$nome = '';
		$id_exercicio = '';
		$data['questao'] = $this->Material_model->cadastra_questao($descricao, $tipo, $nome, $id_exercicio);
		redirect('administrador/material/');


	}*/
	/*public function detalhes(){
		$data['ativo']  = 'material';
		$data['titulo'] = 'Material';
		$this->load->view('administrador/templates/header', $data);		
		$this->load->view('administrador/templates/nav_menu',$data);

		$this->load->view('administrador/perfil/material/detalhes');
		$this->load->view('administrador/templates/footer');		
	}*/
	
	/*public function cadastrarMaterial(){

		

		$nome = $this->input->post('nomeMaterial');
		$arquivo1['file'] = $_FILES['video'];
		$caminho1 = $this->my_functions->enviar_imagem( '/lisieuxtreinamentos/sistema', '/assets/material-apoio/', $arquivo1, 500 , 200 );
		$arquivo2['file'] = $_FILES['texto'];
		$caminho2 = $this->my_functions->enviar_imagem( '/lisieuxtreinamentos/sistema', '/assets/material-apoio/', $arquivo2, 500 , 200 );
		$arquivo3['file'] = $_FILES['texto'];
		$caminho3 = $this->my_functions->enviar_imagem( '/lisieuxtreinamentos/sistema', '/assets/material-apoio/', $arquivo3, 500 , 200 );
		var_dump($caminho1);
		var_dump($caminho2);
		var_dump($caminho3);
		//$data['callback'] = $this->Material_model->adicionaMaterialApoio($caminho['url'], $nome);
		$data['message'] = "<h4 class='alert alert-success'>Banner cadastrado!!</h4>";
	}*/
}