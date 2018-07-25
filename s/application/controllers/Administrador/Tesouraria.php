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


	

	public function gerar_recibo()
	{
		//$relatorio_conteudo = $_REQUEST['id'];
		// echo $relatorio_conteudo;
		$filename = "recibo_lisieux.pdf";
		
		include_once APPPATH . 'vendor\mpdf/mpdf/mpdf.php'; 
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
		$mpdf = new mPDF(
             'utf-8',    // mode - default ''
             'A4-P',    // format - A4, for example, default ''
             0,     // font size - default 0
             '',    // default font family
             30,     // margin_left
             30,     // margin right
             30,    // margin top
             30,    // margin bottom
             0,     // margin header
             0,     // margin footer
             'P');  // L - landscape, P - portrait*/
		
		
		$alunoUsuario = $this->Aluno_model->getAlunoUsuario($aluno);  
		$html = "teste";
		/*$html = "<?= form_open(base_url('').'administrador/tesouraria/gerar_recibo');?>
		<div class='d-green text-left border-bot'><h1 id='print'><?= $alunoUsuario[0]['nome']?><button type='submit' class='btn btn-success' style='float:right; letter-spacing: .1em; padding: 8px 15px;'> IMPRIMIR </button></h1></div>
		<?= form_close();?>
		<div class='col-md-12' id='info-aluno' style='border-bottom: 1px solid #ccc'>
			<?php				
				$string = $cpf;	        	
				$s_string = trim(chunk_split($string, 3, '.'), '.');
				$alunoCpf = $s_string;
				$acpf = substr_replace ( $alunoCpf , '-' , 11 , 1 );
		
				//Mascara Rg
		
				$str = $rg;	        	
				
				$rep = substr_replace($str, '.', 2, 0);
				$s_str = $rep;
				$s_str = trim(chunk_split($rep, 3, '.'), '.');
				$alunoRg = $s_str;
				$rg = substr_replace ( $alunoRg , '' , 3 , 1 );
				$arg = substr_replace ( $rg , '-' , 10, 1 );
		
			?>
			<div class='row text-left'>
				<div class='col-md-2'>
					<strong> TELEFONE </strong>
					<p><?= $alunoUsuario[0]['telefone']?></p>
				</div>
				<div class='col-md-2'>
					<strong> CELULAR </strong>
					<p><?= $alunoUsuario[0]['celular']?></p>
				</div>
				<div class='col-md-3'>
					<strong> EMAIL </strong>
					<p><?= $alunoUsuario[0]['email']?></p>
				</div>
			</div>
			<div class='row text-left'>
				<div class='col-md-2'>
					<strong> Data de nascimento</strong>
					<p><?= $alunoUsuario[0]['dt_nascimento']?></p>
				</div>
				<div class='col-md-2'>
					<strong> Sexo </strong>
					<p><?= ($alunoUsuario[0]['ds_sexo'] = 'm') ? 'Masculino': 'Feminino'; ?></p>
				</div>
				<div class='col-md-2'>
					<strong> CPF </strong>
					<p><?= $acpf;?></p>
				</div>
				<div class='col-md-2'>
					<strong> RG </strong>
					<p><?= $arg?></p>
				</div>
			</div>
			<div class='row text-left'>
				<div class='col-md-2'>
					<strong> CEP </strong>
					<p><?php echo $alunoUsuario[0]['cep']?></p>
				</div>
				<div class='col-md-6'>
					<strong> Endereco </strong>
					<p><?php echo $alunoUsuario[0]['endereco'].', '.$alunoUsuario[0]['numero']?></p>
				</div>
			</div>
		</div>
		
		
		<div class='table-responsive text-center col-xs-12'>
			<table class='table text-center'>
				
				
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
				
				<tbody>
					<?php $vl_total = 0;
					$pago = 0;
					foreach($infoPagamento as $row):
					$vl_total += {$row['vl_inscricao']};	
					({$row['id_status_pag']} == 3) ? $pago += {$row['vl_inscricao']} : $pago += 0 ;	
					?>
					<tr>   
						<td scope='row' name='' style='display:none;'></td>
						<td scope='row' style='width:250px'><?= {$row['nm_curso']}?></td>
						<td scope='row'><?= {$row['ds_forma_pag']}?></td>
						<td scope='row'><?= {$row['vl_inscricao']}?></td>
						<td scope='row'>1</td>
						<td scope='row'><?= {$row['nm_status']}?></td>
						<td scope='row'><?= {$row['vl_inscricao']}?></td>
					</tr>	
					<?php endforeach;?>		
				</tbody>	
			</table>
		</div>
		<div class='col-md-12 row'>
			<div class='col-md-3' style='float:right;right: 2.2%'>
				<table class='table' id='sub_tb_recibo'>			
					<thead>
						<tr>
							<th>
								<div class='col-md-12 text-center'>
									<strong style='color:#666;font-size: 16px; border-bottom: 0px;font-weight: bold'>Investimento total</strong>
								</div>						
							</th>
						</tr>
					</thead>
					<tbody>				
						<tr scope='row' style='border-top: 0px;'>
							<td>
								<div class='col-md-6'>Pago</div>
								<div class='col-md-6' >R$ <?= $pago?></div>
							</td>
							
						</tr>
						<tr scope='row'>
							<td>
								<div class='col-md-6'>A Pagar</div>
								<div class='col-md-6' >R$ <?= $vl_total - $pago?></div>
							</td>
							
						</tr>	
						<tr scope='row'>
							<td style='background-color: #297f54;color: #fff;border-top: 0px'>
								<div class='col-md-6' >Total</div>
								<div class='col-md-6'>R$ <?= $vl_total?></div>
							</td>
						</tr>						
					</tbody>
				</table>		
			</div>
		</div>";*/
		$header ="";
		$footer ="";
		// $html = 'Teste';
		// $mpdf->WriteHTML($css, 1); 
		$mpdf->SetHeader($header);
		$mpdf->SetFooter($footer);
		$mpdf->WriteHTML($html);	
		$mpdf->AddPage("<body></body>");	
		/*$mpdf->SetProtection(array('print'));
		$mpdf->useDefaultCSS2 = true; // define as fontes
		$mpdf->useOnlyCoreFonts = true;
		$mpdf->showImageErrors = true;
		$mpdf->debug = true;
		$mpdf->SetTitle("Lisieux | Treinamentos - Recibo");	// define o titulo do arquivo
		$mpdf->SetAuthor("Lisieux"); // define o autor do arquivo
		$mpdf->showWatermarkText = true;
		$mpdf->SetDisplayMode('fullpage');*/
		$mpdf->Output($filename, "D"); // imprime o arquivo ex: ('nome do arquivo', 'I') I para abrir no navegador e D para download
		
	}


}