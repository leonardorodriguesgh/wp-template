<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tesouraria extends CI_Controller {

	/*public $param;
    public $pdf;*/
	// $param = "'c', 'A4-L'"
	public function __construct() {

		parent::__construct();

		$this->load->model('Aluno_model');
		$this->load->model('Curso_model');
		$this->load->model('Tesouraria_model');
		$this->load->model('Solicitacao_model');
		$this->redirecionar_login();		
		$this->redirecionar_perfil();

		/*Construtor mPDF*/
		
		/*$this->param =$param;
		$this->pdf = new mPDF($this->param);*/
	

	}

	

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
	|--------------------------------------------------------------------------
	| Controller -
	|--------------------------------------------------------------------------
	|
	|
	|
	|
	*/

	private function verificar_cadastrar(){	
		if( !array_key_exists($this->permissao,$this->session->userdata('permissoes') ) || $this->session->userdata('permissoes')[$this->permissao]['Cadastrar'] == 0 )		
			redirect($this->session->userdata('prefixo').'/acesso-negado');
	}

	/*
	|--------------------------------------------------------------------------
	| Controller -
	|--------------------------------------------------------------------------
	|
	|
	|
	|
	*/

	private function verificar_editar(){	
		if( !array_key_exists($this->permissao,$this->session->userdata('permissoes') ) || $this->session->userdata('permissoes')[$this->permissao]['Editar'] == 0 )		
			redirect($this->session->userdata('prefixo').'/acesso-negado');
	}

	/*
	|--------------------------------------------------------------------------
	| Controller -
	|--------------------------------------------------------------------------
	|
	|
	|
	|
	*/

	private function verificar_visualizar(){	
		if( !array_key_exists($this->permissao,$this->session->userdata('permissoes') ) || $this->session->userdata('permissoes')[$this->permissao]['Consultar'] == 0 )		
			redirect($this->session->userdata('prefixo').'/acesso-negado');
	}

	/*
	|--------------------------------------------------------------------------
	| Controller -
	|--------------------------------------------------------------------------
	|
	|
	|
	|
	*/

	private function verificar_deletar(){	
		if( !array_key_exists($this->permissao,$this->session->userdata('permissoes') ) || $this->session->userdata('permissoes')[$this->permissao]['Excluir'] == 0 )		
			redirect($this->session->userdata('prefixo').'/acesso-negado');
	}

	/*
	|--------------------------------------------------------------------------
	| Controller -
	|--------------------------------------------------------------------------
	|
	|
	|
	|
	*/

	public function index() {


		$data['ativo']  = 'tesouraria';
		$data['titulo'] = 'Tesouraria';
		$ativo = 1 || 0;
		$this->load->view('administrador/templates/header', $data);
		$this->load->view('administrador/templates/nav_menu',$data);

		$data['cursoNum'] = $this->Curso_model->contaCurso($ativo);
		$data['certificadoNum'] = $this->Solicitacao_model->getCertificadolMes();
		$data['alunoNum'] = $this->Aluno_model->getAlunoMes();

		$nome = $this->input->post('alunoSearch');
		$data['query'] = $this->Aluno_model->getAlunoIndex($nome);

		if(isset($data['query'][0]['codigo'])){$id = $data['query'][0]['codigo'];}else{$id = "";}
		//var_dump($data['query']);
		
		//$data['aluno'] = $this->Aluno_model->getAluno($id);
		//var_dump($data['aluno']);
		$cpf = $data['query'][0]['cpf'];
		$data['cpf'] = $this->my_functions->formatar_cpf($cpf);

		if(empty($data['query']) && ($nome) == ""){	     	
	     	/*$data['query'] = $this->Curso_model->getCurso(); */ 
	     	$data['message'] = "";
	    }if(($data['query']) == null && !empty($nome)){
	    	$data['message'] = "<p class='alert alert-danger'>Aluno inexistente</p>";
	    }elseif(!empty($data['query']) && !empty($nome)){
	    	$data['message'] = "";
	    }	    	    


    	$this->load->view('administrador/perfil/tesouraria/indice', $data);
    	$this->load->view('administrador/templates/footer');
	}

	public function recibo($aluno){
		$data['ativo']  = 'tesouraria';
		$data['titulo'] = 'Tesouraria';

		$this->load->view('administrador/templates/header', $data);
		$this->load->view('administrador/templates/nav_menu',$data);

		$data['alunoUsuario'] = $this->Aluno_model->getAlunoUsuario($aluno);  
		$data['infoPagamento'] = $this->Tesouraria_model->getPagamento($aluno);
		//$data['aluno'] = $this->Aluno_model->getAluno($aluno);
		$cpf = $data['alunoUsuario'][0]['cpf'];
		$rg = $data['alunoUsuario'][0]['rg'];
		$data['cpf'] = $this->my_functions->formatar_cpf($cpf);
		$data['rg'] = $this->my_functions->formatar_cpf($rg);
		
		
		$this->load->view('administrador/perfil/tesouraria/recibo',$data);
		$this->load->view('administrador/templates/footer', $data);
	}


	

	public function gerar_recibo($aluno)
	{
		//$relatorio_conteudo = $_REQUEST['id'];
		// echo $relatorio_conteudo;
		$filename = "recibo_lisieux.pdf";
		
		
		//$mpdf = new mPDF();//resgata o mpdf das pastas third_party

		//echo $teste;
		// Instancia a classe mPDF
		//$mpdf = new mPDF();
			

		// Ao invés de imprimir a view 'welcome_message' na tela, passa o código
		// HTML dela para a variável $html
		//$html = $this->load->view('welcome_message','',TRUE);
		// Define um Cabeçalho para o arquivo PDF
		//$mpdf->SetHeader('Gerando PDF no CodeIgniter com a biblioteca mPDF');
		// Define um rodapé para o arquivo PDF, nesse caso inserindo o número da
		// página através da pseudo-variável PAGENO
		//$mpdf->SetFooter('{PAGENO}');
		// Insere o conteúdo da variável $html no arquivo PDF
		//$mpdf->writeHTML($html);
		// Cria uma nova página no arquivo
		//$mpdf->AddPage();
		// Insere o conteúdo na nova página do arquivo PDF
		//$mpdf->WriteHTML('<p><b>Minha nova página no arquivo PDF</b></p>');
		// Gera o arquivo PDF
		//$mpdf->Output();
		require_once APPPATH . '/../vendor/autoload.php';
		$mpdfConfig = array(
			'mode' => 'utf-8', 
			'format' => 'A4',    // format - A4, for example, default ''
			'default_font_size' => 0,     // font size - default 0
			'default_font' => '',    // default font family
			'margin_left' => 5,    	// 15 margin_left
			'margin_right' => 5,    	// 15 margin right
			// 'mgt' => $headerTopMargin,     // 16 margin top
			// 'mgb' => $footerTopMargin,    	// margin bottom
			'margin_header' => 0,     // 9 margin header
			'margin_footer' => 0,     // 9 margin footer
			'orientation' => 'P'  	// L - landscape, P - portrait
		);
		$mpdf = new \Mpdf\Mpdf($mpdfConfig);  // L - landscape, P - portrait*/
		
		$alunoUsuario = $this->Aluno_model->getAlunoUsuario($aluno);  
		$data['infoPagamento'] = $this->Tesouraria_model->getPagamento($aluno);
		$alunoUsuario = $this->Aluno_model->getAlunoUsuario($aluno);  
		$cpf = $alunoUsuario[0]['cpf'];
		$rg = $alunoUsuario[0]['rg'];

		

		$vl_total = 0;
		$pago = 0;
		//Mascara Rg

		$str = $rg;	        	
		
		$rep = substr_replace($str, '.', 2, 0);
		$s_str = $rep;
		$s_str = trim(chunk_split($rep, 3, '.'), '.');
		$alunoRg = $s_str;
		$rg = substr_replace ( $alunoRg , '' , 3 , 1 );
		$arg = substr_replace ( $rg , '-' , 10, 1 );
		//$html = "teste";
		//var_dump($data['infoPagamento']);
		($alunoUsuario[0]['ds_sexo'] = 'm') ? $genero = 'Masculino': $genero =  'Feminino';
		$html = '<script src="http://localhost/wordpress/s/assets/js/vendor/jquery-3.2.1.min.js"></script>
		<script src="http://localhost/wordpress/s/assets/js/vendor/bootstrap.min.js"></script>
		<link href="http://localhost/wordpress/s/assets/css/vendor/bootstrap.min.css" rel="stylesheet">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-te/1.4.0/jquery-te.js"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-te/1.4.0/jquery-te.css" rel="stylesheet">';
		$string = $cpf;	      
		$alunoCpf = $string;
		$acpf = substr_replace ( $alunoCpf , '-' , 11 , 1 );
		$html .= "
		<div id='main'>
			<div><h1 id='print' style=' color:#297f54; font-weight: lighter; border-bottom: 1px solid #ccc;'>{$alunoUsuario[0]['nome']}</h1></div>
			<table id='tbPdf' style='width: 100%; color:#297f54; border-bottom: 1px solid #ccc; margin-bottom: 25px; padding-bottom: 25px'>
			
				<tr>
					<td>
						
						<strong style='font-weight: bold;'> TELEFONE </strong>
						<p>{$alunoUsuario[0]['telefone']}</p>
						
					</td>
					<td>
						
						<strong style='font-weight: bold;'> CELULAR </strong>
						<p>{$alunoUsuario[0]['celular']}</p>
						
					</td>
					<td>
						
						<strong style='font-weight: bold;'> EMAIL </strong>
						<p>{$alunoUsuario[0]['email']}</p>
						
					</td>
				</tr>
				<tr>
					<td>
						
						<strong style='font-weight: bold;'> DATA DE NASCIMENTO </strong>
						<p>{$alunoUsuario[0]['dt_nascimento']}</p>
						
					</td>
					<td>
						<strong style='font-weight: bold;'> GENERO </strong>
						<p>$genero</p>
					</td>
					<td>
						<strong style='font-weight: bold;'> CPF </strong>
						<p> $acpf</p>
					</td>
					
				</tr>
				<tr>
					<td>
						<strong style='font-weight: bold;'> CEP </strong>
						<p>{$alunoUsuario[0]['cep']}</p>
					</td>
					<td class='col-md-6'>
						<strong style='font-weight: bold;'> ENDERECO </strong>
						<p>{$alunoUsuario[0]['endereco']}, {$alunoUsuario[0]['numero']}</p>
					</td>
					<td>
						<strong style='font-weight: bold;'> RG </strong>
						<p>$arg</p>
					</td>
				</tr>
			</table>
			
			
			<div class='table-responsive text-center col-xs-12'>
				<table class='table'>
					
					
					<thead style='border-bottom: 0px;'>
									
						<tr>
							<th scope='col' class='text-center'><label>Curso</label></th>
							<th scope='col' class='text-center'><label>Forma de pagamento</label></th>
							<th scope='col' class='text-center'><label>Valor/parcela</label></th>
							<th scope='col' class='text-center'><label>Qnt. de parcelas</label></th>
							<th scope='col' class='text-center'><label>Pago</label></th>
							<th scope='col' class='text-center'><label>Valor Total</label></th>
					
						</tr>
					</thead>	
					
					<tbody>";
						
						foreach($data['infoPagamento'] as $infoPagamento => $row):
					
						$vl_total += $row['vl_inscricao'];						
						($row['id_status_pag'] == 3) ? $pago += $row['vl_inscricao'] : $pago += 0 ;	
						$aPagar = $vl_total - $pago;
						$html .= "	
						<tr>   
							
							<td scope='row' style='width:250px'>{$row['nm_curso']}</td>
							<td scope='row'>{$row['ds_forma_pag']}</td>
							<td scope='row'>{$row['vl_inscricao']}</td>
							<td scope='row'>1</td>
							<td scope='row'>{$row['nm_status']}</td>
							<td scope='row'>{$row['vl_inscricao']}</td>
						</tr>";
						endforeach;
					$html .= "</tbody>	
				</table>
			</div>
			<div>
				<div style='width: 100%'>	
					<table style='position: absolute; text-align: center;' align='right'>			
						<thead>
							<tr>
								<th>
									<div>
										<p style='color:#666;font-size: 16px;font-weight: 100; border-bottom: 1px solid #ccc'>Investimento total</p>
									</div>						
								</th>
							</tr>
						</thead>
						<tbody>				
							<tr scope='row' style='border-top: 0px;'>
								<td style='padding:6px; border-bottom: 1px solid #ccc'>
									<div style='color:#297f54'>Pago</div>
									<div>R$ $pago</div>
								</td>								
							</tr>
							<tr scope='row'>
								<td style='padding:6px;'>
									<div style='color:#297f54'>A Pagar</div>
									<div>R$ $aPagar</div>
								</td>								
							</tr>	
							<tr scope='row'>
								<td style='background-color: #297f54;color: #fff;border-top: 0px'>
									<div class='col-md-6' >Total</div>
									<div>R$ $vl_total</div>
								</td>
							</tr>						
						</tbody>
					</table>		
				</div>
			</div>
		</div>";
		$header ='';
		$css = "
		<style>
		body{font-family: Sans-serif, Verdana !important}
		#tbPdf{margin-bottom: 50px !important;border-bottom: 1px solid #ccc !important;}
		#tbPdf tr td{padding: 20px !important; border: 0px solid #ccc;}
		#tbPdf tr td p{padding-top: 50px !important}
		.table tbody tr td, .table thead tr th{padding: 10px; border-bottom: 1px solid #ccc}
		.table{border:1px solid #ccc;}
		.table thead tr th{color: #297f54; font-weight:normal !important}
		</style>";
		$footer ="";
		// $html = 'Teste';
		$mpdf->setAutoTopMargin = 'stretch';
  		$mpdf->setAutoBottomMargin = 'stretch';
		$mpdf->WriteHTML($css, 1); 
		$mpdf->SetHeader($header);
		$mpdf->SetFooter($footer);
		$mpdf->WriteHTML($html);	
		$mpdf->Output($filename, "D");// GERA O PDF
	}


}