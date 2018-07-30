<?php  /*Template Name: Pagamento */ ?>
<?php  get_header() ?>

<div class="title_page contato">
	<div class="container">
		<h1>CURSOS E <strong>CONSULTORIA</strong></h1>
	</div>
</div>


<?php  include('single-course.php'); ?>
<?php 	$info_curso = (object) array(
		'id' 			=> $row['codigo'],
		/*'dia_semana'	=> $row['nm_dia_semana'],
		'hr_inicio'		=> $row['hr_inicio'],
		'hr_termino'	=> $row['hr_termino'],*/
		'dt_inicio'		=> date("d/m/Y", strtotime($row['dt_inicio'])),
		'dt_termino'	=> date("d/m/Y", strtotime($row['dt_termino'])),
		'tipo'			=> $row['tipo'],
		'vagas'			=> $row['qtd_vagas'],
		'disponiveis'	=> $vagasDisponiveis,
		'image' 		=> $row['url_banner'],
		//'image_mob'		=> $row['nm_url_capa_mobile_curso'],
		'titulo'		=> $row['nm_curso'],
		'chamada' 		=> ($row['ds_curso'] == "") ? $row['nm_curso'] : $row['ds_curso'],
		//'descricao' 	=> $row['ds_informacao_curso'],
		'aulas' 		=> $row['qtd_aulas'],
		'horas' 		=> $row['qtd_horas'],
		'tag' 			=> $row['tag_curso'],
		//'link'			=> $row['nm_url_landing_page'],
		//'pdf'			=> $row['nm_url_pdf'],
		// 'init_turma'	=> date("d/m/Y", strtotime($row['dt_inicio'])),
		// 'final_turma'	=> date("d/m/Y", strtotime($row['dt_termino'])),
		'sigla'			=> $row['sigla_curso']
	);
	
 ?>
<?php  if (isset($info_curso)) : ?>

	<section class="content_course_intern">
		<div class="container">
			<div class="col-sm-12 col-md-10 col-lg-9">
				
				<div class="apresentacao_curso">
					<picture>
						<source media="(min-width: 768px)" srcset="<?php bloginfo('url')?>/s<?php  echo $info_curso->image ?>">
						<img class="img-responsive" src="<?php bloginfo('url')?>/s<?php echo $info_curso->image ?>">
					</picture>
					<h3 class="ttl_curso"><?php  echo $info_curso->titulo ?></h3>
					<p class="txt_curso"><?php  echo $info_curso->chamada ?></p>
				</div>

				<?php  require('lotes.php'); ?>

				<?php  foreach ($lotes as $value) : ?>
					<?php  if($value['situacao'] == 1) : ?>
						<?php   $price = number_format($value['valor'], 2, ',', '.');
							echo '<input type="hidden" value="'.$price.'" id="precoCurso"/>'; ?>
						<article class="content_price" id="content_compra">
							<div class="col-sm-6 col-md-6">
								<div class="center">
									<img src="<?php  bloginfo('template_url') ?>/images/icon_lotes.gif">
									<input type="hidden" value="<?php  echo $value['lote'] + 1 ?>" id="lote_atual">
									<p>
										Lote <?php  echo $value['lote'] + 1 ?><br>
										<strong>Disponível até </strong><?php  echo date('d/m/Y',strtotime($value['final'])) ?>
									</p>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="center">
									<img src="<?php  bloginfo('template_url') ?>/images/icon_investimento.jpg">
									<p>
										Investimento<br>
										<strong>R$ <?php  echo number_format($value['valor'], 2, ',', '.'); ?></strong>
									</p>
								</div>
							</div>
						</article>
					<?php  endif ?>
				<?php  endforeach ?>

				<section class="content_turmas">

					<div class="conteudo_curso">
						<h4>ESCOLHA A TURMA <span></span></h4>
					</div>

					<?php  require('turmas.php'); ?>

					<?php  foreach ($turmas as $value) : 
						$cartao = $value['cartao'];
					?>
						<article class="item_turma col-xs-12 col-md-12" data-cod="<?php  echo $value['numero'] ?>" data-cadcom="<?php  echo $value['id'] ?>">
							<div class="left col-sm-8 col-md-8">
								<p>Turma <?php  echo $value['numero'] ?>: <strong>De <?php  echo date('d/m/Y',strtotime($value['inicio'])) ?> até <?php  echo date('d/m/Y',strtotime($value['final'])) ?></strong></p>
							</div>
							<div class="right col-sm-4 col-md-4">
								<p><span class="icon_vaga"></span>
								<?php 
									$vaga = $value['vagas'];
									$vagas = $vaga + 1;
									if($info_curso->disponiveis == null):
										$disponiveis = $vaga;
									else:
										$disponiveis = $info_curso->disponiveis;
									endif;
									if($disponiveis < $vagas):

										echo $disponiveis." / ".$vaga." vagas disponíveis";
									else:
										echo "Não há vagas disponíveis";
									endif;
								?>
								</p>
							</div>
						</article>

					<?php  endforeach ?>

				</section>

				<section class="content_contas">
					<?php 
						if($info_curso->disponiveis < $vagas) {
					?>
					<div>
						<?php  
							$wp_session = WP_Session::get_instance();
							
							if($wp_session['UserLogin'] != '' || $wp_session['UserLogin'] != null) { ?>
								<div class="libera-continuar" style="display:none">
									<span class="btn_form btn_login" id="js-pagamento--libera">Continuar compra</span>
								</div>
								<form id="formCadastroAluno" class="formSingup formCad" method="POST" data-cadastrado="sucesso" data-usuario="<?php  echo $wp_session['UserLogin']; ?>">
									<input type="hidden" value="" class="js-codigo">
									<input type="hidden" value="" class="js-info">
									<input type="hidden" value="<?php  echo $info_curso->id ?>" class="js-produto">
									<input type="hidden" value="<?php  echo $info_curso->titulo ?>" class="js-desc_produto">
					                <input type="hidden" class="js-nome">
					                <input type="hidden" class="js-email">
					                <input type="hidden" class="js-telefone">
					                <input type="hidden" class="js-cpf">
					                <input type="hidden" class="js-cidade">
					                <input type="hidden" class="js-cep">
					                <input type="hidden" class="js-endereco">
					                <input type="hidden" class="js-estado">
					                <input type="hidden" class="js-bairro">
					                <input type="hidden" class="js-numero">
					                <input type="hidden" class="js-complemento">
									<h4><b>Você já está conectado</b> <br> <small>Escolha a forma de pagamento</small></h4>

									<!-- : <?php  echo $wp_session['UserName']; ?>  -->

								</form>
								<div class="msg-conta">Você já possui uma compra deste curso.</div>

							<?php  } else { ?>
							<div class="libera-compra">
								<span class="btn_form btn_login" id="js-pagamento--libera">Fazer novo cadastro</span>
								<span class="btn_form btn_login" id="tenho-cadastro" data-toggle="modal" data-target="#myModal">Já tenho cadastro</span>	
							</div>
							<br>
							<br>
							<form id="formCadastroAluno" class="formSingup formCad" method="POST">
								<input type="hidden" value="" class="js-codigo">
								<input type="hidden" value="" class="js-info">
								<input type="hidden" value="<?php  echo $info_curso->id ?>" class="js-produto">
								<input type="hidden" value="<?php  echo $info_curso->titulo ?>" class="js-desc_produto">
								<p>Para concluir a inscrição, preencha com seus dados</p>
								<div class="row">
									<div class="col-sm-6 col-md-7">
										<input type="text" class="js-nome" name="nome" placeholder="Nome" required>
									</div>
									<div class="col-sm-6 col-md-5">
										<input type="text" class="js-telefone" name="telefone" placeholder="Telefone" onkeypress="return MascaraTel(this, '(99) 999999999)', event);" pattern="(\d{2})(\d{9})" maxlength="14" required>
									</div>
									<div class="col-sm-6 col-md-7">
										<input type="text" class="js-email email" id="verificaEmail" name="email" placeholder="E-mail" required>
									</div>
									<div class="col-sm-6 col-md-5">
										<input type="text" class="js-confirmaremail" name="confirmaremail" placeholder="Confirmar e-mail" required>
									</div>
									<div class="col-sm-6 col-md-7">
										<input type="password" class="js-senha" id="verificaSenha" name="senha" placeholder="Senha" required>
									</div>
									<div class="col-sm-6 col-md-5">
										<input type="password" class="js-confirmarsenha" name="confirmarsenha" placeholder="Confirmar Senha" required>
									</div>
									<div class="col-sm-4 col-md-4">
										<input type="text" class="js-cpf" name="cpf" placeholder="CPF" onkeypress="return MascaraTel(this, '999.999.999-99', event);" required="required" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="Digite o CPF no formato xxx.xxx.xxx-xx" maxlength="14" required>
									</div>
									<div class="col-sm-4 col-md-4">
										<input type="text" class="js-cep" name="cep" placeholder="CEP" onkeypress="return MascaraTel(this, '99999-999', event);" required="required" pattern="\d{5}-\d{3}" title="Digite o CEP no formato xxxxx-xxx" maxlength="9" required>
									</div>
									<div class="col-sm-4 col-md-4">
										<input type="text" class="js-cidade" name="cidade" placeholder="Cidade" required>
									</div>
									<div class="col-sm-4 col-md-4">
										<input type="text" class="js-bairro" name="bairro" placeholder="Bairro" required>
									</div>
									<div class="col-sm-4 col-md-4">
										<input type="number" class="js-numero" name="numero" placeholder="Numero" required>
									</div>
									<div class="col-sm-4 col-md-4">
										<input type="text" class="js-complemento" name="complemento" placeholder="Complemento">
									</div>
									<div class="col-sm-3 col-md-3">
										<select class="js-estado" name="estado" required>
											<option default> Estado</option>
											<option value="SP">SP</option>
										</select>
									</div>
									<div class="col-sm-9 col-md-9">
										<input type="text" class="js-endereco" name="endereco" placeholder="Endereço" required>
									</div>
									<div class="col-xs-12 col-md-6">
										<button type="submit" class="btn_form" id="btnCadastrarAluno" value="Cadastrar"> Concluir cadastro </button>
									</div>
									<div class="alert" id="alert-cadastro" role="alert"></div>
								</div> 
							</form>	
							
						<?php  } ?>
						
						<form class="formSingup cupom-desconto">
							<input type="hidden" value="<?php   echo $info_curso->id; ?>" id="js-curso-codigo">
							<div class="content_wrap row">							
								<div class="col-xs-12 col-md-3">
									<p><b>Cupom de desconto</b></p>
								</div>
								<div class="col-xs-12 col-md-4">
									<input type="text" id="cupomdesconto" name="cupomdesconto">
									<div id="msg_cupom"></div>
								</div>
								<div class="col-xs-12 col-md-4">
									<button type="submit" class="btn_form btn_login"> Aplicar </button>
								</div>
							</div>
						</form>

						<form class="formSingup payment_card">
							<div class="content_wrap row">
								<p class="texto-preto">Formas de pagamento</p>
								<img src="<?php  bloginfo('template_url') ?>/images/formas-pagamento.png" class="img-responsive forma-pagamento">
							</div>

							<div class="content_wrap row" id="op_pgto">
								<p class="texto-preto js-mostra" data-mostra=".pagamento_credito"><img src="<?php  bloginfo('template_url') ?>/images/icon_credito.png" class=""> <b>Cartão de Crédito</b> <small>(R$ <span class="price"><?php  echo $price ?></span> em até <?php  echo $cartao; ?> vezes sem juros)</small></p>
								<div class="pagamento_credito">
									<div class="col-sm-12 col-md-12">
					  					<img class="bandeira" id="bandeira">
									</div>
									<div class="col-sm-6 col-md-4">
									<input type="hidden" id="sessionId">
										<input type="text" id="numero" name="numero" placeholder="Número" onblur="brandCard();" required="required" pattern="[0-9]+$" title="Apenas Números" maxlength="16">
									</div>
									<div class="col-sm-6 col-md-6">
										<input type="text" id="cardnome" name="cardnome" placeholder="Nome no cartão">
									</div>
									<div class="col-sm-6 col-md-2">
										<input type="text" id="cvv" name="cvv" placeholder="CVV (XXX)" maxlength="3" required="required" pattern="[0-9]+$" title="Apenas Números" placeholder="CVV">
									</div>
									<div class="col-sm-6 col-md-4">
										<input type="text" id="mes" name="mes" placeholder="Mês (XX)" maxlength="2" minlength="2" required="required" pattern="[0-9]+$" title="Apenas Números">
									</div>
									<div class="col-sm-6 col-md-4">
										<input type="text" id="ano" name="ano" placeholder="Ano (XXXX)" maxlength="4" minlength="4" required="required" pattern="[0-9]+$" title="Apenas Números" onblur="validarCartao(PagSeguroDirectPayment.getSenderHash());">
									</div>
									<div class="col-sm-6 col-md-4">
										<select name="parcelas" id="parcelas">
											<option value="" dafault>Parcelas</option>
											<?php  
												if($cartao != null) {
													for ($i=1; $i <= $cartao; $i++) { 
														$valor_parcela = $price/$i;
														echo '<option value="'.$i.'">'.$i.'x</option>';
													}	
												}
											?>
										</select>
									</div>	
									
									<div class="col-sm-6 col-md-7">
										<input type="text" id="cpf" name="cpf" placeholder="Digite o CPF" required="required" pattern="\d{11}" title="Digite o CPF no formato xxxxxxxxxxx" maxlength="11">
									</div>
									<div class="col-sm-6 col-md-5">
										<input type="text" id="nascimento" name="nascimento" placeholder="Data de nascimento (XX/XX/XXXX)" onkeypress="return MascaraTel(this, '99/99/9999', event);" required="required" maxlength="10" pattern="[0-9]{2}\/[0-9]{2}\/[0-9]{4}$">
									</div>
									<input type="hidden" name="creditCardToken" id="creditCardToken"  />
					      			<input type="hidden" name="creditCardBrand" id="creditCardBrand" />
					      			<div class="product-all-track">
					      				<aside class="track-0" data-track="<?php  echo base64_encode($price) ?>"></aside>
					      			</div>
					      			<input type="hidden" id="js--sigla-curso" value="<?php  echo $info_curso->sigla ?>">
					      			<div class="row">
						      			<div class="col-md-12">
									  		<button type="submit" class="btn btn-volta text-center text-uppercase center-block" onclick="fecharPedido(PagSeguroDirectPayment.getSenderHash())">Finalizar</button>
									  	</div>
									</div>
								</div>
							</div>
						</form>

						<form class="formSingup payment_boleto">
							<div class="content_wrap row" id="op_pgto">
								<p class="texto-preto js-mostra" data-mostra=".pagamento_boleto"><img src="<?php  bloginfo('template_url') ?>/images/icon_boleto.png" class=""> <b>Boleto Bancário</b> <small>(R$ <span class="price"><?php  echo $price ?></span> à vista)</small></p>
								<div class="pagamento_boleto">
									<div class="col-sm-12 col-md-12">
										<button type="submit" class="btn btn-volta text-center text-uppercase center-block" onclick="pagarBoleto(PagSeguroDirectPayment.getSenderHash());">Gerar Boleto</button>
									</div>
								</div>
							</div>
						</form>
					</div>
					<?php  } else { 
					 	echo "Infelizmente não há mais vagas disponíveis para este curso.";
					} ?>	
				</section>
				<section class="situacao-cadastro text-center">
					<h3 id="js-situacao_titulo"><strong>Inscrição concluída</strong></h3>
					<p class="situacao-cadastro_icon">
						<img src="<?php  bloginfo('template_url') ?>/images/icon_sucesso.png" class="img-responsive" id="js-situacao_imagem" width="100px">
					</p>
					<p class="lead" id="js-situacao_descricao">
						Você receberá os dados de confirmação por e-mail, <br> aguarde a aprovação do pagamento.
					</p>
					<p><a href="<?php  bloginfo('url') ?>/cursos-e-consultoria/" class="btn btn-volta text-center text-uppercase center-block">Voltar</a></p> 
				</section>

			</div>
			<div class="col-md-2 col-lg-3 hidden-xs hidden-sm">
				<?php  include("sidebar-courses.php") ?>
			</div>
		</div>
	</section>

<?php  endif ?>
	

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="<?php  bloginfo('template_url') ?>/js/jquery.base64.js"></script>
	<!-- <script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script> -->
	
	<script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>

	<script>
	//passa p/ pag anterior? 
		$(document).ready(function(){
			$.ajax({
				type: 'GET',
				url: 'http://localhost/wordpress/wp-content/themes/Site/pagseguro/get-session.php',
				cache: false,
				success: function(data){
					PagSeguroDirectPayment.setSessionId(data);
					$('#sessionId').val(data);
					console.log(data);
				}
			});
		});
	</script>


<?php  get_footer() ?>