<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tesouraria_model extends CI_Model {  

    private $_buscaPagamento = "CALL p_S_Pagamento(?)";

    function __construct()
    {
        parent::__construct();  

        $this->load->model('Procedures');
    }

    public function getPagamento($id_aluno){
    $data = array(
        'id_aluno' => $id_aluno
    );
    return $this->Procedures->result_array($this->_buscaPagamento, $data);
 }
}