<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Turma_model extends CI_Model {

  private $_inserirTurma = "CALL p_I_Turma(?,?,?,?,?,?,?,?)";
  private $_SelecionarTurma = "CALL p_S_Turma(?)";
  private $_PesquisaTurma = "CALL p_S_TurmaPesquisa(?,?,?)";

  function __construct()
  {
    parent::__construct();  
    
    $this->load->model('Procedures');
  }

  /*
  |--------------------------------------------------------------------------
  | Função: 
  |--------------------------------------------------------------------------
  | 
  | 
  |
  | 
  |
  */
  public function adicionar($nome, $tipo, $inicio, $termino){
    $data = array(
      'id_curso' => 1,
      'nm_turma' => $nome,
      'tipo' => $tipo,
      'dt_ultima_modificacao' => date("Y-m-d H:i:s"),
      'id_ultima_modificacao' => $this->session->userdata('codigo'),
      'ativo' => 1,
      'dt_inicio' => $inicio,
      'dt_termino' => $termino,
    );

    return $this->Procedures->insert_and_get_id($this->_inserirTurma,$data);

  }

  
   /*
  |--------------------------------------------------------------------------
  | Função: 
  |--------------------------------------------------------------------------
  | 
  | 
  |
  | 
  |
  */
  public function getDetalhesTurma($id){
     $data = array(
      'id_curso' => $id//$this->session->userdata('codigo')     
      
    );
    
    //executa uma procedure que seleciona a tabela de especifico id
    //retorna a row da tabela do id em forma de array
    return $this->Procedures->result_array($this->_SelecionarTurma, $data); 
    
  }
  /*
  |--------------------------------------------------------------------------
  | Função: 
  |--------------------------------------------------------------------------
  | 
  | 
  |
  | 
  |
  */
  public function getTurmaIndex($id, $nome ){
    $data = array(
      'id_curso' => $id,
      'nm_turma' => $nome,
      'tipo' => $nome
    );
      
    
    return $this->Procedures->result_array($this->_PesquisaTurma, $data);
 } 
}