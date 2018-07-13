<? /* Template Name: Search */ ?>
<? get_header(); ?>

<div class="title_page contato">
	<div class="container">
		<h1>CURSOS E <strong>CONSULTORIA</strong></h1>
	</div>
</div>

<section class="section_cursos">
	<div class="container">
		<div class="col-sm-10 col-md-9">
			<form class="search" method="get" action="<?php bloginfo('url'); ?>/cursos-e-consultoria/">
				<input type="text" name="s" id="s" placeholder="Digite o nome do curso que está buscando">
				<input type="submit" value="e" class="btn-lupa">
			</form>
		</div>
		<div class="clear"></div>

		<? require('next-courses.php'); ?>

		<? foreach ($nextCourses as $value) { ?>	

			<div class="col-sm-4 col-md-3">
				<article class="list_next">
					<div class="thumbnail">
						<img class="img-responsive" src="<? echo $value['image'] ?>">
						<span class="value">
							A partir de R$
							<? echo number_format($value['valor'], 2, ',', ''); ?>
						</span>
					</div>
					<div class="content">
						<h4 class="title"><? echo $value['titulo']; ?></h4>
						<p class="description">
							<? echo string_limit_words($value['descricao'], 15); ?>
						</p>
					</div>
					<div class="info">
						<p class="info_classroms">
							<img class="img-responsive" src="<? bloginfo('template_url'); ?>/images/icon_aulas.png">
							<? echo $value['aulas']; ?> aulas
						</p>
						<p class="info_duration">
							<img class="img-responsive" src="<? bloginfo('template_url'); ?>/images/icon_horas.png">
							<? 
								$min = (int)$value['horas']; 
								if($min >= 60) $h = number_format($min / 60, 2, ':', '');
								else $h = "00:".$min;
								echo $h;
							?>h
						</p>
					</div>
				</article>
			</div>
		<? } ?>
	</div>
</section>

<? get_footer() ?>