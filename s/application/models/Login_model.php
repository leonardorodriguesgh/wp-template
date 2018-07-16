<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

  private $_ativarUsuario = "CALL p_S_UsuarioAtivar(?,?,?,?)";
  
  private $_buscarPermissoes = "CALL p_S_LoginPermissoes(?)";  
  private $_buscarUsuarioPerfil = 'CALL p_S_UsuarioPerfil(?)';
  private $_buscarUsuarioPorCodigo = "CALL p_S_UsuarioPorCodigo(?)";
  private $_buscarUsuarioPorEmail = "CALL p_S_UsuarioPorEmail(?)";

  private $_inserirUsuario = "CALL p_I_Usuario(?,?,?,?,?,?,?,?,?)";  
  private $_editarUsuario = "CALL p_U_Usuario(?,?,?,?,?,?,?)";

  private $_editarUsuarioFoto = "CALL p_U_UsuarioFoto(?,?,?,?)";
  
  private $_resetarSenha = "CALL p_U_LoginResetarSenha(?,?,?,?)";

  private $_verificarUsuario = "CALL p_S_LoginVerificarUsuario(?,?)";
  private $_verificarUsuarioDisponivel = "CALL p_S_UsuarioDisponivel(?,?)";

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

  public function ativarUsuario($dados) {

    $data = array( 
      'codigo' => $dados['profissional'],
      'suspenso' => ( $dados['suspenso'] == 1 )? 0 : 1, 
      'data_modificacao' =>  date("Y-m-d H:i:s"), 
      'modificado_por' => $this->session->userdata('codigo') 
    );

    $this->Procedures->execute($this->_ativarUsuario,$data);

    return $data['suspenso'];

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

  public function buscarPermissoes($codigo) {

    $data = array('codigo' => $codigo); 

    return $this->Procedures->result_array($this->_buscarPermissoes,$data);

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

  public function buscarUsuarioPerfil( $data ) { 

    return $this->Procedures->row_array($this->_buscarUsuarioPerfil,$data);

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

  public function buscarUsuarioPorCodigo($codigo) {

    $data = array('codigo' => $codigo); 

    return $this->Procedures->row_array($this->_buscarUsuarioPorCodigo,$data);

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

  public function buscarUsuarioPorEmail($dados) {

    $data = array('email' => $dados['email']); 

    return $this->Procedures->row_array($this->_buscarUsuarioPorEmail,$data);

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

  public function inserirUsuario($perfil,$dados){

    $data = array(
      'perfil' => $perfil,
      'data_cadastro' => date('Y-m-d H:m:s'),
      'ativo' => 1,
      'nome' => $dados['nome'],
      'email' => $dados['email'],
      'senha' => do_hash(KEY_ENCRYPTION.$dados['senha'], 'md5'),
      'suspenso' => 0,
      'data_modificacao' => date("Y-m-d H:i:s"), 
      'modificado_por' => $this->session->userdata('codigo') 
    );

    return $this->Procedures->insert_and_get_id($this->_inserirUsuario,$data);

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

  public function editarUsuario($codigo,$dados) {

    $data = array(
      'codigo' => $codigo,
      'perfil' => ((array_key_exists('perfil',$dados ))? $dados['perfil'] : '' ),
      'nome' => $dados['nome'], 
      'senha' => $dados['senha'],
      'criptografia' => do_hash(KEY_ENCRYPTION.$dados['senha'],'md5'),
      'data_modificacao' => date("Y-m-d H:i:s"), 
      'modificado_por' => $this->session->userdata('codigo')
    );

    $this->Procedures->execute($this->_editarUsuario,$data);

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

  public function resetarSenha($codigo,$senha) {

    $data = array(
      'codigo' => $codigo,
      'senha' => do_hash(KEY_ENCRYPTION.$senha, 'md5'),
      'data_modificacao' => date("Y-m-d H:i:s"), 
      'modificado_por' => 0 
    );

    $this->Procedures->execute($this->_resetarSenha,$data);

    return $senha;

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

  public function verificarUsuario($dados) {

    $data = array(
      'email' => $dados['email'],
      'senha' => do_hash(KEY_ENCRYPTION.$dados['senha'], 'md5')
    );

    return $this->Procedures->row_array($this->_verificarUsuario,$data);
        
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

  public function editarUsuarioFoto($codigo, $foto) {

    $data = array( 
      'codigo' => $codigo,
      'foto' => $foto, 
      'data_modificacao' => date("Y-m-d H:i:s"), 
      'modificado_por' => $this->session->userdata('codigo')
    );
    
    $this->Procedures->execute($this->_editarUsuarioFoto,$data);
        
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

  public function verificarUsuarioDisponivel($codigo,$dados) { 

    $data = array(
      'codigo' => $codigo,
      'email' => $dados['email']
    ); 
    
    return $this->Procedures->row_array($this->_verificarUsuarioDisponivel,$data);

  }
  
}