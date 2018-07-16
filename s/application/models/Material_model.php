<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Material_model extends CI_Model {
	private $_pesquisaMaterialApoio = "CALL p_S_MaterialApoio(?,?,?)";
	private $_materialApoioDetalhes = "CALL p_S_MaterialApoioDetalhes(?,?)";
	private $_atualizaMaterialApoio = "CALL p_U_MaterialApoio(?,?)";
  private $_InsereMaterialApoio = "CALL p_I_AnexoMaterialApoio(?,?,?,?,?,?,?)";
  private $_SelecionarTurmaMaterial = "CALL p_S_TurmaMaterial(?)";
  private $_PesquisaTurma = "CALL p_S_TurmaPesquisa(?,?,?)";
  private $_InsereExercicio = "CALL p_I_Exercicio(?,?,?,?,?,?)";
  private $_InsereQuestaoDados = "CALL p_U_Questao(?,?,?,?,?,?)";
  //private $_InsereQuestao = "CALL p_I_Questao(?,?,?,?,?,?)";
  private $_ProcuraTipoQuestao = "CALL p_S_Questao(?)";

  function __construct()
  {
    parent::__construct();  
    
    $this->load->model('Procedures');
  }

  
  public function getMaterialApoio($nome){
    /*$query = $this->db->select('*')->from('tb_material_apoio')->where('ativo', 1)->get();
    return $query->result();*/
    $data = array(
      'nm_material_apoio' => $nome,
      'ds_material_apoio' => $nome,
    	'ativo' => 1
    );
    return $this->Procedures->result_array($this->_pesquisaMaterialApoio, $data);
  }
  public function getMaterialApoioSelected($id){
    /*$query = $this->db->select('*')->from('tb_material_apoio')->where('ativo', 1)->where('id_material_apoio', $id)->get();
    return $query->result();*/
    $data = array(
    	'id_material_apoio' => $id,
    	'ativo' => 1
    );
    return $this->Procedures->row_array($this->_materialApoioDetalhes, $data);
  }
  
  public function getAllMaterial(){
    /*$query = $this->db->select('*')->from('tb_anexo_material_apoio')->get();
    return $query->result_array();*/

   $query = $this->db->select('*')->from('tb_anexo_material_apoio')->join('tb_material_apoio', 'tb_anexo_material_apoio.id_material_apoio = tb_material_apoio.id_material_apoio', 'left')->get();       
    return $query->result_array();
  }
  
  public function removeMaterial($id){
  	/*$ativo = 0;
  	$data = array(
  		'id_material_apoio' => $id,
  		'ativo' => $ativo
  	);
  	return $query = $this->db->set('ativo', $ativo)->where('id_material_apoio', $id)->update('tb_material_apoio');*/
  	$data = array(
  		'id_material_apoio' => $id,
  		'ativo' => 0
  	);
    return $this->Procedures->execute($this->_atualizaMaterialApoio, $data);
  }
  public function adicionaMaterialApoio($nome, $descricao, $url, $id_turma){// implementar cadastro do material na tb_anexo_material_apoio com linkagem das turmas
    
    $data = array(      
      //'id_anexo_aula' => $id_material,
      //'id_turma' => $id_turma,
      'nm_material_apoio' => $nome,
      'id_turma' => $id_turma,
      'ds_material_apoio' => $descricao,
      'url' => $url,
      'dt_ultima_modificacao' => date("Y-m-d H:i:s"),
      'id_ultima_modificacao' => 1,
      'ativo' => 1
    );

    return $this->Procedures->execute($this->_InsereMaterialApoio, $data);
  }
  public function getTurmaMaterial($id_turma){
    $data = array(
      'id_turma' => $id_turma//$this->session->userdata('codigo')     
      
    );
    
    //executa uma procedure que seleciona a tabela de especifico id
    //retorna a row da tabela do id em forma de array
    return $this->Procedures->row_array($this->_SelecionarTurmaMaterial, $data); 
  }

  public function getAllAulas(){
    $query = $this->db->select('*')->from('tb_aula')->get();
    return $query->result_array();
  }

  public function getAula($id){
    $query = $this->db->select('*')->from('tb_aula')->where('id_aula', $id)->get();
    return $query->result_array();
  }


  /*--------------------------- CADASTRA EXERCICIO ---------------------*/

  public function busca_last_questao($qt_questao){
    $id = $this->db->select_max('id_questao')->from('tb_questao')->get();
    $id_questao = $id->row_array();
    $max_id_questao = json_encode($id_questao);
    $id_questao_decode = json_decode($max_id_questao)->id_questao;
    $id_qt_questao = $id_questao_decode - $qt_questao;
    
    $query = $this->db->select('*')->from('tb_questao')->where('id_questao >=', $id_qt_questao)->get();
    return $query->result_array();
  }
  public function cadastra_questao($ds_enunciado, $nm_questao, $qt_questao){
    $max_id = $this->db->select_max('id_questao')->from('tb_questao')->get();
    $get_max_id = json_encode($max_id->row_array());
    $max_id_decode = json_decode($get_max_id);    
    $valor_id_questao = $max_id_decode->id_questao;
    $valor_update = $valor_id_questao - $qt_questao;

    $data = array(              
        
        'ds_enunciado' => $ds_enunciado,    
        'dt_ultima_modificacao' => date("Y-m-d H:i:s"),
        'id_ultima_modificacao' => 1,
        'ativo' => 1,        
        'nm_questao' => $nm_questao,
        'sp_qt_questao' => $valor_update);

    return $this->Procedures->execute($this->_InsereQuestaoDados, $data);
  
  }
  public function cadastra_exercicio($id_aula, $ds_exercicio,  $nm_exercicio){
   
    $data = array(      
        
        'ds_exercicio' => $ds_exercicio,        
        'dt_ultima_modificacao' => date("Y-m-d H:i:s"),
        'id_ultima_modificacao' => 1,        
        'id_aula' => $id_aula,
        'ativo' => 1,
        'nm_exercicio' => $nm_exercicio);
        

    return $this->Procedures->execute($this->_InsereExercicio, $data);
  }


   /*--------------------------- CADASTRA QUESTAO ------------------------*/
   /*public function cadastra_questao($descricao, $tipo, $nome, $id_exercicio){
    $data = array(      
        
        'ds_enunciado' => $descricao,      
        'id_tipo' => $tipo,
        'dt_ultima_modificacao' => date("Y-m-d H:i:s"),
        'id_ultima_modificacao' => 1,      
        'ativo' => 1,
        'nm_questao' => $nome,
        
      );

    return $this->Procedures->execute($this->_InsereQuestao, $data);
   }*/
  public function getQuestaoExercicio(){
    $query = $this->db->select_max('id_questao')->from('tb_questao')->get();
    $res = $query->row_array();    
    $data = array(
      'id_questao' => $res
    );
    return $this->Procedures->row_array($this->_ProcuraTipoQuestao, $data);
  }
  public function getTipoQuestao(){
    $query = $this->db->select('*')->from('tb_tipo_questao')->get();
    return $query->result_array();
  }

  public function getMaterialMes(){
    $query = $this->db->query('select count( CURRENT_DATE - INTERVAL 1 MONTH ) as x FROM tb_material_apoio');
    return $query->row_array();
  }

} 
