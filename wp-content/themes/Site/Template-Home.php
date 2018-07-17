<?php  /* Template Name: Home */ ?>

<?php get_header();?>

<?php global $course_id; ?>

<?php include('carousel.php');
var_dump($turma);?>

<section class="section" id="section1"> 
	<div class="container">
		
		<div class="col-md-4 col-sm-4 it_s item_curso_online">
			<div class="item_services">
				<h4>
					CURSOS <strong>ONLINE</strong>
					<span></span>
				</h4>
				<p>
					Para maior comodidades de seus alunos, todos os cursos oferecidos pelo Lisieux Treinamento também podem ser feitos de forma online.<br>&nbsp;
				</p>
			</div>
		</div>
		<div class="col-md-4 col-sm-4 it_s item_curso_presencial">
			<div class="item_services">
				<h4>
					CURSOS <strong>PRESENCIAIS</strong>
					<span></span>
				</h4>
				<p>
					Os cursos, palestras e treinamentos da Lisieux  são voltados para o aprimoramento dos profissionais de saúde (médicos, dentistas, psicólogos, etc.) e suas equipes de apoios (secretárias, recepcionistas e gerentes de clinicas e consultório.<br>&nbsp;
				</p>
			</div>
		</div>
		<div class="col-md-4 col-sm-4 it_s item_consultoria">
			<div class="item_services">
				<h4>
					<strong>CONSULTORIA</strong>
					<span></span>
				</h4>
				<p>
					Está precisando melhorar a sua clínica ou consultório mas não sabe como? Nosso serviço de consultoria pode ajudar. Atuando em todos os aspectos do seu negócio.
				</p>
			</div>
		</div>

		<div class="title_ancora">
			<h2>INSCRIÇÕES<strong> ABERTAS</strong></h2>
			<span></span>
		</div>

	</div>
</section>

<?php require('current-course.php'); ?>

<section class="current_course">
	<div class="container">
		<div class="call_current_course col-md-12">
			<div class="row_flex">
				<div class="col-sm-12 col-md-6 col-md-push-6">
					<article class="cover_current" style="background: url('s/<?php echo $curso->imgchamada; ?>')">
						<picture>
							<source media="(max-width: 991px)" srcset="<?php echo $curso->image; ?>">
							<img class="img-responsive" src="">
						</picture>
					</article>
				</div>
				<div class="col-sm-12 col-md-6 col-md-pull-6">
					<article class="current_course">
						<h2 class="call"><?php echo $curso->chamada; ?></h2>
						<p class="content"><?php echo string_limit_words($curso->txtchamada, 108); ?></p>
						<p class="info">
							<img class="img-responsive" src="<?php bloginfo('template_url'); ?>/images/icon_aulas.png">
							<?php echo $curso->aulas; ?> aula<?php if( $turma->qtd_aulas > 1 ) echo "s" ?>
						</p>
						<p class="info">
							<img class="img-responsive" src="<?php bloginfo('template_url'); ?>/images/icon_horas.png">
							<?php echo $turma->qtd_horas;?>h
						</p>
						<div class="clear"></div>
						<a href="cursos-e-consultoria/<?php echo $curso->tag; ?>">
							<span class="btn-inscricao">Saiba mais</span>
						</a>
					</article>
				</div>
			</div>
		</div>
	</div>
</section>

<?php require('next-courses.php'); ?>

<section class="section" id="section2">
	<div class="container">
		
		<div class="title_ancora">
			<h2>PRÓXIMOS<strong> CURSOS</strong></h2>
			<span></span>
		</div>

		<?php foreach ($nextCourses as $value) { ?>
			<a href="<?php bloginfo('url'); ?>/cursos-e-consultoria/<?php echo $value['tag'] ?>/">
				<div class="col-sm-4 col-md-3">
					<article class="list_next">
						<div class="thumbnail">
							<img class="img-responsive" src="<?php echo $value['image'] ?>">
							<span class="value">
								<?php if( strtotime($value['data_final']) > strtotime($value['data_inicio'])) :?>
									<?php 	echo  date("d/m/Y", strtotime($value['data_inicio'])); ?> 
										até 
									<?php  echo date("d/m/Y", strtotime($value['data_final'])); ?>

								<?php else: echo date("d/m/Y", strtotime($value['data_inicio'])); endif; ?>
							</span>
						</div>
						<div class="content">
							<h4 class="title"><?php echo $value['titulo']; ?> 
								<?php if($value['cidade'] == '') {
									 	
									} else {
										echo "- ".$value['cidade'];
									}
								?> 
							</h4>
							<p class="description">
								<?php echo string_limit_words($value['descricao'], 20); ?>
							</p>
						</div>
						<div class="info">
							<p class="info_classroms">
								<img class="img-responsive" src="<?php bloginfo('template_url'); ?>/images/icon_aulas.png">
								<?php echo $value['aulas']; ?> aula<?php if( $value['aulas'] > 1 ) echo "s" ?>
							</p>
							<p class="info_duration">
								<img class="img-responsive" src="<?php bloginfo('template_url'); ?>/images/icon_horas.png">
								<?php echo $value['horas']; ?>h
							</p>
						</div>
						<div class="clear"></div>
						<a href="cursos-e-consultoria/<?php echo $value['tag']; ?>">
							<span class="btn-inscricao btn-block text-center">Saiba mais</span>
						</a>
					</article>
				</div>
			</a>
		<?php } ?>
	</div>
</section>

<section class="section" id="section3">
	<div class="row_flex">
		<article class="img-lisieux hidden-xs hidden-sm col-md-6"></article>
		<article class="content_services col-md-6">
			<div class="container_services">
				<div class="title_ancora">
					<h2>O QUE<strong> OFERECEMOS</strong></h2>
					<span></span>
				</div>
				<div class="col-sm-6 col-md-6">
					<div class="item_service">
						<img class="img-responsive" src="<?php bloginfo('template_url') ?>/images/icon_curso_presencial.png">
						<h4>Aulas presenciais<br>e Online</h4>
						<p>Pensando na sua comodidade, você pode assistir às aulas tanto online, quanto de forma presencial</p>
					</div>
				</div>
				<div class="col-sm-6 col-md-6">
					<div class="item_service">
						<img class="img-responsive" src="<?php bloginfo('template_url') ?>/images/icon_material.png">
						<h4>Material disponível<br>Online</h4>
						<p>Apostilas para os alunos do curso estão disponíveis para a consulta online.</p>
					</div>
				</div>
				<div class="col-sm-6 col-md-6">
					<div class="item_service">
						<img class="img-responsive" src="<?php bloginfo('template_url') ?>/images/icon_senha.png">
						<h4>Acesso protegido<br>por senha</h4>
						<p>Todo o conteúdo do site é protegido com senha individual e de uso pessoal de cada aluno.</p>
					</div>
				</div>
				<div class="col-sm-6 col-md-6">
					<div class="item_service">
						<img class="img-responsive" src="<?php bloginfo('template_url') ?>/images/icon_acesso.png">
						<h4>Acesso pelo seu<br>dispositivo predileto</h4>
						<p>Acesso ao sistema em qualquer lugar, seja no seu computador, smartphone ou tablet.</p>
					</div>
				</div>
			</div>
		</article>
	</div>
</section>

<?php get_footer(); ?>