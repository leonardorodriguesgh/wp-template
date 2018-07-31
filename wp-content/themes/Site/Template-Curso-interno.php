<?php /* Template Name: Curso Interno */ ?>
<?php get_header(); ?>

<div class="title_page contato">
	<div class="container">
		<h1>CURSOS E <strong>CONSULTORIA</strong></h1>
	</div>
</div>

<?php include('single-course.php'); ?>
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
<?php if (isset($info_curso)) : ?>
	
	<section class="content_course_intern">
		<div class="container">
			<div class="col-sm-12 col-md-10 col-lg-9">
				
				<div class="info_init">
					<div class="align-center">
						<div class="data_curso">
							<img class="img-responsive" src="<?php bloginfo('template_url') ?>/images/icon_dia.png">
							<p style="padding-top:12px">
								<!--<?php// echo $info_curso->dia_semana ?>, <?php// echo substr($info_curso->hr_inicio,0, 2) ?>h às 
								<?php// echo substr($info_curso->hr_termino,0, 2) ?>h
								<br>-->
								<strong>

									<?php 
										if($info_curso->dt_inicio == '30/11/-0001') {
											$inicial = "Data a definir";
										} else {
											$inicial = $info_curso->dt_inicio;
										}
										if($info_curso->dt_termino == '30/11/-0001') {
											$final = "Data a definir";
										} else {
											$final = $info_curso->dt_termino;
										}

										if($inicial != $final ) 
											echo "".$inicial."  até  ".$final."";
										else
											echo "".$inicial;
									?>
									
								</strong>
							</p>
						</div>
						<div class="tipo_aula">
							<img class="img-responsive" src="<?php bloginfo('template_url') ?>/images/icon_tipo_aula.png">
							<p><strong><?php echo $info_curso->tipo ?></strong></p>
						</div>
						<div class="vagas_disponivel">
							<img class="img-responsive" src="<?php bloginfo('template_url') ?>/images/icon_vagas.png">
							<p><strong><?php echo $info_curso->vagas ?> vagas disponiveis</strong></p>
						</div>
					</div>
				</div>

				<div class="apresentacao_curso">
					<picture>
						<source media="(min-width: 768px)"id="testador"  srcset="<?php bloginfo('url')?>/s<?php echo $info_curso->image ?>">
						<img class="img-responsive" src="<?php echo $info_curso->image_mob ?>">
					</picture>
					<h3 class="ttl_curso"><?php echo $info_curso->titulo ?></h3>
					
				</div>

				<div class="descricao_curso">
					<h4>DESCRIÇÃO</h4>
					<p class="txt_curso"><?php echo $info_curso->chamada ?></p>
					<?php 
						if($info_curso->pdf != null){
							echo '<p>Clique aqui e conheça os detalhes do curso: <a href="'.$info_curso->pdf.'" target="_blank" class="text-success"><u>Ver mais sobre o curso</u></a></p>';
						} else {}

					?>
				</div>

				<?php include("content-course.php") ?>
				
				
				<?php foreach ($conteudo as $value) : ?>
					<div class="conteudo_curso">
						<h4>CONTEÚDO <span></span></h4>
						<?
							if($value['count'] % 2 != 0)
								$back = "fafafa";
							else 
								$back = "fff";
						?>
						<div class="item_aula" style="background: #<?php echo $back ?>">
							Aula <?php echo $value['count']?>: <strong><?php echo $value['conteudo'] ?></strong>
						</div>
					</div>
				<?php endforeach; ?>

				<?php require('lotes.php'); ?>

				<?php if ( !empty($lotes) ) :  ?>
					<div class="investimento_curso">
						<h4>INVESTIMENTO</h4>

						<?php $i = 0; ?>
						<?php foreach ($lotes as $value) :

							if($value['situacao'] != 1) : ?>
								<div class="col-xs-12 col-sm-4 col-md-4 item_lote disabled">
									<?php if($value['situacao'] < 0) {?> 
										<span class="line_red"></span>
									<?php } ?>
									<div class="box_lote">
										<div class="bd bd<?echo $i++;?>">
											<div class="center">
												<h3 class="title_lote"><?php echo $value['nomeLote']; ?></h3>
												<div class="valor_lote">
													<div class="monetario">
														<p>R$ <strong><?php echo number_format($value['valor'], 0,",","."); ?></strong></p>
													</div>
													<div class="decimal">
														<p><strong>,00</strong></p>
													</div>
												</div>
												<p class="data_lote">
													Até <?php echo date('d/m/Y',strtotime($value['final'])) ?>
												</p>
											
												<span class="btn-inscricao">INSCREVA-SE</span>
												
											</div>
										</div>
									</div>
								</div>
								
							<?php else :?>
								<div class="col-xs-12 col-sm-4 col-md-4 item_lote enabled">
									<div class="box_lote">
										<div class="bd bd<?echo $i++;?>">
											<div class="center">
												<h3 class="title_lote"><?php echo $value['nomeLote']; ?></h3>
												<div class="valor_lote">
													<div class="monetario">
														<p>R$ <strong><?php echo number_format($value['valor'], 0,",","."); ?></strong></p>
													</div>
													<div class="decimal">
														<p><strong>,00</strong></p>
													</div>
												</div>
												<p class="data_lote">
													Até <?php echo date('d/m/Y',strtotime($value['final'])) ?>
												</p>
												<a href="<?php bloginfo('url'); ?>/<?php echo $info_curso->tag; ?>/">
													<span class="btn-inscricao">INSCREVA-SE</span>
												</a>
											</div>
										</div>
									</div>
								</div>
							<?php endif; ?>				
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
				<div class="infos_contato">
					<h4>PARA MAIORES INFORMAÇÕES OU CONTRATAÇÃO:</h4>
					<p><b>Ligue: (11) 94224-5480 ou nos chame pelo Whatsapp:</b> (16) 99104-5480 </p>
					<p><b>E-mail:</b> treinamento@eslisieux.com.br</p>
				</div>
			</div>
			<div class="col-md-2 col-lg-3 hidden-xs hidden-sm">
				<?php include("sidebar-courses.php") ?>
			</div>
		</div>
	</section>
<?php else : ?>
	<h2 class="no-results">Informações indisponíveis no momento...</h2>
<?php endif;?>


<?php get_footer(); ?>