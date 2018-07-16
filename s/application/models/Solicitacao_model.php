<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitacao_model extends CI_Model {

  
  function __construct()
  {
    parent::__construct();  
    
    $this->load->model('Procedures');
  }
  public function getCertificadolMes(){
    $query = $this->db->query('select count( CURRENT_DATE - INTERVAL 1 MONTH ) as num FROM tb_solicitacao WHERE tipo = "certificado"');
    return $query->row_array();
  }
  
} 

