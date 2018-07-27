<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curso_model extends CI_Model {

  private $_inserirCurso = "CALL p_I_CadastrarCurso(?,?,?,?,?,?,?,?,?,?)";
  private $_editarCurso = "CALL p_U_EditarCurso(?,?,?,?,?,?,?,?,?,?,?)";
  private $_SelecionarCurso = "CALL p_S_Curso(?)";  
  private $_SelecionarBanner = "CALL p_S_Banner(?)";
  private $_PesquisaCurso = "CALL p_S_CursoPesquisa(?,?,?,?)";  
  private $_ContaCurso = "CALL p_S_ProcuraCurso(?)";
  private $_ContaMaxCurso = "CALL p_S_GetLastInsertCurso(?)";
  private $_InsereBannerCurso = "CALL p_I_BannerCurso(?,?,?,?,?,?,?)";
  private $_EditaBannerCurso = "CALL p_U_BannerCurso(?,?,?,?,?,?,?)";
  private $_pegaPrecosLote = "CALL p_S_PrecoLote(?)";
 
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
  public function adicionar($tag_curso, $nome, $tipo, $sigla, $situacao, $ds_curso, $conteudo_programatico){
    
    
    $data = array(
      //'id_curso' => 1,
      'tag_curso' => $tag_curso,
      'nm_curso' => $nome,
      'tipo' => $tipo,
      'sigla_curso' => $sigla,
      'situacao' => $situacao,
      'ds_curso' => $ds_curso,
      'conteudo_programatico' => $conteudo_programatico,
      'dt_ultima_modificacao' => date("Y-m-d H:i:s"),
      'id_ultima_modificacao' => 1,//$this->session->userdata('codigo'),
      'ativo' => 1
      
    );

    return $this->Procedures->insert_and_get_id($this->_inserirCurso, $data);

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
  public function editar($id, $tag_curso, $nome, $tipo, $sigla, $situacao, $ds_curso, $ativo, $conteudo_programatico){
    $data = array(
      'codigo' => $id,//$this->session->userdata('codigo')
      'tag_curso' => $tag_curso,
      'nm_curso' => $nome,
      'tipo' => $tipo,
      'sigla_curso' => $sigla,
      'situacao' => $situacao,
      'ds_curso' => $ds_curso,
      'conteudo_programatico' => $conteudo_programatico,
      'dt_ultima_modificacao' => date("Y-m-d H:i:s"),
      'id_ultima_modificacao' => 1,//$this->session->userdata('codigo'),
      'ativo' => $ativo
      
    );
    $this->Procedures->execute($this->_editarCurso, $data);
    
    
     
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
  public function getCurso(){
    $query = $this->db->select('*')->from('tb_curso')->limit(5)->get();
    //$query = $this->db_get();
    return $query->result();

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
  public function getCursoIndex($nome, $limite){
    $data = array(
      'nm_curso' => $nome,
      'tipo' => $nome,
      'ds_curso' => $nome,
      'sp_limite' => $limite
    );
      
    
    return $this->Procedures->result_array($this->_PesquisaCurso, $data);
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
  public function getDetalhesCurso($id){
     $data = array(
      'id_curso' => $id//$this->session->userdata('codigo')     
      
    );
    
    //executa uma procedure que seleciona a tabela de especifico id
    //retorna a row da tabela do id em forma de array
    return $this->Procedures->row_array($this->_SelecionarCurso, $data); 
    
  }
  /*precisa arrumar p/ retornar o formulario que foi cadastrado*/
  public function getDetalhesCadCurso(){
    $ativo = 1;    
    $data = array(
      'ativo' => $ativo   
    
    );
    return $this->Procedures->row_array($this->_ContaMaxCurso, $data); 
  }
  public function getBanner($id){
    $data = array(
      'id_banner' => $id//$this->session->userdata('codigo')     
      
    );
    return $this->Procedures->row_array($this->_SelecionarBanner, $data); 
  }

  /*public function getModalCad(){
    $this->load->view('administrador/perfil/curso/cadastrar');
  }*/
  public function contaCurso($ativo){
    $data = array(
      'ativo' => $ativo
    ); 
    return $this->Procedures->result_array($this->_ContaCurso, $data);
  }
  
  public function adicionaBannerCurso( $id_curso, $url){
    $data = array(      
      //'id_banner' => $id_curso,
      'id_curso' => $id_curso,
      'ds_banner' => 'Teste',
      'url_banner'  => $url,
      'dt_ultima_modificacao' => date("Y-m-d H:i:s"),
      'id_ultima_modificacao'=> 1,
      'ativo' => 1,
      'tamanho' => 'md'
    );

    return $this->Procedures->row_array($this->_InsereBannerCurso, $data);
  }

  public function editaBannerCurso( $id_curso, $url){
    $data = array(      
      'id_banner' => $id_curso,
      'ds_banner' => 'Teste',
      'url_banner'  => $url,
      'dt_ultima_modificacao' => date("Y-m-d H:i:s"),
      'id_ultima_modificacao'=> 1,
      'ativo' => 1,
      'tamanho' => 'md'
    );

    return $this->Procedures->execute($this->_EditaBannerCurso, $data);
  }
  /*
  public function do_upload($img){
    //$this->My_functions->enviar_imagem( '', 'assets/images/sistema/user/', $_FILES["'".$img."'"], 1934 , 709 );
    $this->my_functions->enviar_imagem( '', '/assets/images/sistema/user/', $_FILES, 500 , 200 );
  }
  */


  /*public function getPrecoLote($id_turma){
    $data = array(
      'id_turma' => $id_turma
    );

    return $this->Procedures->row_array($this->_pegaPrecosLote, $data);
  }SELECT MAX(vl_lote) AS max_vl, MIN(vl_lote) AS min_vl FROM tb_lote
     RIGHT JOIN tb_turma ON tb_lote.id_turma = tb_turma.id_turma 
     LEFT JOIN tb_curso ON tb_turma.id_curso = tb_curso.codigo;*/
   public function getLote($id){
    $query = $this->db->select('MAX(vl_lote) AS max_vl, MIN(vl_lote) AS min_vl')->from('tb_lote')->join('tb_turma', 'tb_lote.id_turma = tb_turma.id_turma', 'left')->join('tb_curso', 'tb_turma.id_curso = tb_curso.codigo', 'right')->where('tb_turma.id_curso', $id)->get();
    return $query->result();
   }
} 
