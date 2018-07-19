<?php  /* Template Name: Inscreva-se */ ?>
<?php  get_header() ?>
<div class="title_page contato">
	<div class="container">
		<h1><strong>INSCREVA-SE</strong></h1>
	</div>
</div>


<?php 
	$link = mysqli_connect("localhost", "root", "", "lisieux_treinamento");

	mysqli_set_charset($link,"utf8");
	
	$info_cursos = array();
	
	$nome_lote = array(
		1 => 'Primeiro Lote',
		2 => 'Segundo Lote',
		3 => 'Terceiro Lote'
	);

	$sql ="
			SELECT 
	C.tipo, T.dt_inicio, T.dt_termino, B.url_banner, C.nm_curso,
	C.ds_curso, C.nm_curso, 
	T.qtd_aulas, T.qtd_horas, C.tag_curso, C.codigo, C.sigla_curso
	FROM tb_curso as C 
	INNER JOIN tb_turma as T ON T.id_curso = C.codigo
	INNER JOIN tb_banner_curso as B ON C.codigo = B.id_curso
	";
	
	//$sql .= ( $wp_query->query_vars['curso'] != null) ? " WHERE C.tag_curso = '".$wp_query->query_vars['curso']."'" : "";
	 //var_dump($wp_query->query_vars['curso']);
	// var_dump($wp_query->query_vars['name']);
	$query = mysqli_query($link, $sql);
	
	
	while($row = mysqli_fetch_assoc($query)){
		$id_curso = $row['codigo'];
		$queryVagas = "SELECT T.qtd_vagas - count(I.id_turma)  as Disponiveis  FROM `tb_turma` as T
		INNER JOIN tb_inscricao as I ON T.id_curso = I.id_turma
		WHERE T.id_curso = ".$id_curso;
		
		
		$queryVagasDisponiveis = mysqli_query($link, $queryVagas);
	
		while($vagas = mysqli_fetch_assoc($queryVagasDisponiveis)){
			$vagasDisponiveis = $vagas['Disponiveis'];
		}
		$LoteSql = "
			SELECT L.vl_lote, L.dt_inicio, L.dt_termino
			FROM tb_lote L
			INNER JOIN tb_turma T ON L.id_turma = T.id_turma
			INNER JOIN tb_curso C ON T.id_turma = C.codigo
			WHERE L.dt_termino >= NOW()
			AND L.dt_inicio <= NOW()
			AND T.id_curso = ".$id_curso." Limit 1";
		
		$Lotequery = mysqli_query($link, $LoteSql);
		
		while($rowL = mysqli_fetch_assoc($Lotequery)){

			$info_cursos[] = array(
				'id' 			=> $row['codigo'],
				//'dia_semana'	=> $row['nm_dia_semana'],
				//'hr_inicio'		=> $row['hr_inicio'],
				//'hr_termino'	=> $row['hr_termino'],
				'dt_inicio'		=> date("d/m/Y", strtotime($row['dt_inicio'])),
				'dt_termino'	=> date("d/m/Y", strtotime($row['dt_termino'])),
				'tipo'			=> $row['tipo'],
				'vagas'			=> $row['qtd_vagas'],
				'disponiveis'	=> $vagasDisponiveis,
				'image' 		=> $row['url_banner'],
				//'image_mob'		=> $row['nm_url_capa_mobile_curso'],
				'titulo'		=> $row['nm_curso'],
				'chamada' 		=> ($row['ds_curso'] == "") ? $row['nm_curso'] : $row['ds_curso'],
				'descricao' 	=> $row['ds_curso'],
				'tag' 			=> $row['tag_curso'],
				//'lote'			=> $nome_lote[$rowL['nr_lote']],
				'valor'			=> $rowL['vl_lote'],
				// 'link'			=> $row['nm_url_landing_page'],
				// 'pdf'			=> $row['nm_url_pdf'],
				'sigla'			=> $row['sigla_curso']
			);
		}
	}
	
?>

<?php  if (isset($info_cursos)) : ?>
	<?php //var_dump($rowL); var_dump($lotequery)?>
	<section class="content_course_intern">
		<div class="container">
			<div class="col-sm-12 col-md-10 col-lg-9">

				<?php  foreach ($info_cursos as $value) : ?>

					<article class="box_curso">
						<div class="info_init">
							<div class="align-center">
								<div class="data_curso">
									<img class="img-responsive" src="<?php  bloginfo('template_url') ?>/images/icon_dia.png">
									<p style="padding-top:12px">
										<!--<?php//  echo $value['dia_semana'] ?>, <?php//  echo substr($value['hr_inicio'],0, 2) ?>h às 
										<?php // echo substr($value['hr_termino'],0, 2) ?>h
										<br>-->
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
								<picture >
									<source media="(min-width: 768px)" srcset="<?php bloginfo('url')?>/s<?php  echo $value['image'] ?>" style="width:100%; max-height:10vh;object-fit:cover;"/>
									<img class="img-responsive" src="<?php bloginfo('url')?>/s<?php  echo $value['image'] ?>" style="width:100%;object-fit:cover;max-height:50vh;">
								</picture>
								<div class="lote_info">
									<?php  echo $value['lote'] ?>: R$<?php  echo number_format($value['valor'], 2, ',', '.') ?>
								</div>
							</div>
							<h3 class="ttl_curso"><?php  echo $value['titulo'] ?></h3>
							<p class="txt_curso"><?php  echo string_limit_words($value['chamada'], 20) ?></p>
							<a href="/wordpress/cursos-e-consultoria/<?php  echo $value['tag']; ?>">
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