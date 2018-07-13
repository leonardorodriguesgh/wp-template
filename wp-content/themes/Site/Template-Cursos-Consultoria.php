<?php /* Template Name: Cursos e Consultoria */ ?>
<?php get_header(); ?>

<?php require('search-courses.php'); ?>

<div class="title_page contato">
	<div class="container">
		<h1>CURSOS E <strong>CONSULTORIA</strong></h1>
	</div>
</div>

<section class="section_cursos">
	<div class="container">
		<div class="col-sm-9 col-md-10 col-lg-9">
			<form class="search" method="get" action="<?php bloginfo('url'); ?>/cursos-e-consultoria/">
				<input type="text" name="p" id="p" placeholder="Digite o nome do curso que está buscando">
				<input type="submit" value="e" class="btn-lupa">
			</form>

			<?php
				if(isset($wp_query->query['p']))
					echo "<h2 class='search_txt'> Resultados encotrados: <strong>".$wp_query->query['p']."</strong></h2>"; 

			?>
			<div class="clear"></div>
		
			<?php foreach ($nextCourses as $value) { ?>	

				<?php
					if($value['error'] > 0) :
						echo "<h3 class='no-results'> Curso ou consultoria não encontrado </h3>";
					else :
				?>
					<a href="<?php bloginfo('url'); ?>/cursos-e-consultoria/curso/<?php echo $value['tag'] ?>/">
						<div class="col-sm-6 col-md-4">
							<article class="list_next">
								<div class="thumbnail">
									<img class="img-responsive" src="<?php echo $value['image'] ?>">
									<span class="value">
										<?php 
										if(date("d/m/Y",strtotime($value['data_inicio'])) == '30/11/-0001') {
											$inicial = "Data a definir";
										} else {
											$inicial = date("d/m/Y",strtotime($value['data_inicio']));
										}
										if(date("d/m/Y",strtotime($value['data_final'])) == '30/11/-0001') {
											$final = "Data a definir";
										} else {
											$final = date("d/m/Y",strtotime($value['data_final']));
										}
										if( strtotime($value['data_final']) > strtotime($value['data_inicio'])) :?>
											<?php 	echo  $inicial; ?> 
												até 
											<?php  echo$final; ?>

										<?php else: echo $inicial; endif; ?>
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
										<?php echo string_limit_words($value['descricao'], 15); ?>
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
							</article>
						</div>
					</a>
				<?php endif; ?>
			<?php } ?>
		</div>

		<div class="col-sm-3 col-md-2 col-lg-3 hidden-xs">
			<?php include("sidebar-courses.php") ?>
		</div>

	</div>
</section>

<?php get_footer() ?>