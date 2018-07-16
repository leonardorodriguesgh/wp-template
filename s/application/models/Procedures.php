<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Procedures extends CI_Model {

  function __construct()
  {
    parent::__construct();
  }

  /*
  |--------------------------------------------------------------------------
  | Função: result_array
  |--------------------------------------------------------------------------
  | 
  | Função gerada para executar uma procedure que retornará uma Array de retorno
  |
  | Ex. Comando de Update
  |
  */

  public function result_array($procedure,$dados = array()) {

  	$query    = $this->db->query($procedure,$dados);
  	$res      = $query->result_array();

  	$query->next_result(); 
  	$query->free_result(); 
  	
  	return $res;

  }

  /*
  |--------------------------------------------------------------------------
  | Função: row_array
  |--------------------------------------------------------------------------
  | 
  | Função gerada para executar uma procedure que retornará uma linha de retorno
  |
  | Ex. Comando de Update
  |
  */

  public function row_array($procedure,$dados = array()) {

  	$query    = $this->db->query($procedure,$dados);
  	$res      = $query->row_array();

  	$query->next_result(); 
  	$query->free_result(); 

  	return $res;

  }

  /*
  |--------------------------------------------------------------------------
  | Função: insert_and_get_id
  |--------------------------------------------------------------------------
  | 
  | Função gerada para executar uma procedure que retornará uma chave primária
  |
  | Ex. Comando de Insert
  |
  */

  public function insert_and_get_id($procedure,$dados = array()) {

  	$query = $this->db->query($procedure,$dados);
    $res   = $query->row_array();

    $query->next_result(); 
    $query->free_result(); 

  	return  $res['codigo'];
	
  }

  /*
  |--------------------------------------------------------------------------
  | Função: execute
  |--------------------------------------------------------------------------
  | 
  | Função gerada para executar uma procedure que não retornará dados vindo do banco
  |
  | Ex. Comando de Update ou Insert
  |
  */
  
  public function execute($procedure,$dados = array()) {

  	$query = $this->db->query($procedure,$dados);

  	$query->free_result(); 

  }

}