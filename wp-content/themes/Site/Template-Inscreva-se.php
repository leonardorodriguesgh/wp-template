<?php  /* Template Name: Inscreva-se */ ?>
<?php  get_header() ?>
<div class="title_page contato">
	<div class="container">
		<h1><strong>INSCREVA-SE</strong></h1>
	</div>
</div>

<?php  include('single-course.php'); ?>

<?php  if (isset($info_cursos)) : ?>

	<section class="content_course_intern">
		<div class="container">
			<div class="col-sm-12 col-md-10 col-lg-9">
				<?php  foreach ($info_cursos as $value) : ?>

					<article class="box_curso">
						<div class="info_init">
							<div class="align-center">
								<div class="data_curso">
									<img class="img-responsive" src="<?php  bloginfo('template_url') ?>/images/icon_dia.png">
									<p>
										<?php  echo $value['dia_semana'] ?>, <?php  echo substr($value['hr_inicio'],0, 2) ?>h às 
										<?php  echo substr($value['hr_termino'],0, 2) ?>h
										<br>
										<strong><?php echo $value['dt_inicio'] ?> - <?php echo $value['dt_termino'] ?></strong>
									</p>
								</div>
								<div class="tipo_aula">
									<img class="img-responsive" src="<?php  bloginfo('template_url') ?>/images/icon_tipo_aula.png">
									<p><strong><?php  echo $value['tipo'] ?></strong></p>
								</div>
								<div class="vagas_disponivel">
									<img class="img-responsive" src="<?php  bloginfo('template_url') ?>/images/icon_vagas.png">
									<p><strong><?php  echo $value['vagas'] ?> vagas disponiveis</strong></p>
								</div>
							</div>
						</div>
						<div class="apresentacao_curso">
							<div class="image_cursos">
								<picture>
									<source media="(min-width: 768px)" srcset="<?php  echo $value['image'] ?>">
									<img class="img-responsive" src="<?php  echo $value['image_mob'] ?>">
								</picture>
								<div class="lote_info">
									<?php  echo $value['lote'] ?>: R$<?php  echo number_format($value['valor'], 2, ',', '.') ?>
								</div>
							</div>
							<h3 class="ttl_curso"><?php  echo $value['titulo'] ?></h3>
							<p class="txt_curso"><?php  echo string_limit_words($value['chamada'], 20) ?></p>
							<a href="http://lisieuxtreinamento.com.br/cursos-e-consultoria/curso/<?php  echo $value['tag']; ?>">
								<span class="btn_inscreva">INSCREVA-SE</span>
							</a>
						</div>
					</article>
					
				<?php  endforeach; ?>
			</div>
			<div class="col-md-2 col-lg-3 hidden-xs hidden-sm">
				<?php  include("sidebar-courses.php") ?>
			</div>
		</div>
	</section>

<?php  else : ?>

<h2 class="no-results">Não há cursos disponiveis no momento</h2>

<?php  endif; ?>


<?php  get_footer() ?>