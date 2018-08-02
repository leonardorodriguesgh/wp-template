<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aluno_model extends CI_Model {

  private $_SelecionarAluno = "CALL p_S_Aluno(?)";
  private $_AtivarAluno = "CALL p_U_AtivarAluno(?)";
  private $_AlunoUsuario = "CALL p_S_AlunoUsuario(?)";
  private $_PesquisaAluno = "CALL p_S_AlunoPesquisa(?,?)";
  function __construct()
  {
    parent::__construct();  
    
    $this->load->model('Procedures');
  }

  
  public function getAluno($id){
   
    $data = array(
      'id_aluno' => $id 
      
    );
    //executa uma procedure que seleciona a tabela de especifico id
    //retorna a row da tabela do id em forma de array
    return $this->Procedures->result_array($this->_SelecionarAluno, $data); 
    
   /* $query = $this->db->select('*')->from('tb_aluno')->where('id_aluno', $id)->get();
    $res = $query->result();
    return $res;*/
  }  
  public function ativaAluno($aluno){
     
     $data = array(
      'id_aluno' => $aluno 
      
    );
    //executa uma procedure que seleciona a tabela de especifico id
    //retorna a row da tabela do id em forma de array
    return $this->Procedures->execute($this->_AtivarAluno, $data); 

  }
  public function desativaAluno($aluno){
    
     $data = array(
      'id_aluno' => $aluno
      
    );
    //executa uma procedure que seleciona a tabela de especifico id
    //retorna a row da tabela do id em forma de array
    return $this->Procedures->execute($this->_AtivarAluno, $data); 

  }
  public function getAlunoUsuario($id){
    
    $data = array(
      'id_aluno' => $id 
      
    );
    //executa uma procedure que seleciona a tabela de especifico id
    //retorna a row da tabela do id em forma de array
    return $this->Procedures->result_array($this->_AlunoUsuario, $data); 

  }  

  public function getAlunoIndex($nome){
    $data = array(
      'nome' => $nome,
      'email' => $nome
    );
      
    
    return $this->Procedures->result_array($this->_PesquisaAluno, $data);
  }  
  
  public function getAlunoMes(){
    $query = $this->db->query('select count( CURRENT_DATE - INTERVAL 1 MONTH ) as num FROM tb_aluno WHERE ativo = 1');
    return $query->row_array();
  }
  
  public function getAlunoAtivo($id){
    $query = $this->db->query("SELECT ativo FROM tb_aluno WHERE id_aluno = ".$id);
    return $query->row_array();
  }
  
} 
