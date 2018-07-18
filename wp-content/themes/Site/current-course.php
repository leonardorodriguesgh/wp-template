<?php

	$link = mysqli_connect("localhost", "root", "", "lisieux_treinamento");

	mysqli_set_charset($link,"utf8");
	
	//Como vou passar tudo isso se no meu banco nao existem tantos campos?
	/*
		url_image_chamada_curso,
		ds_informacao_curso,
		qt_numero_aulas,
		, qt_total_horas, nm_url_capa_curso, nm_url_landing_page
	*/
	$sql = 	
	"
	SELECT 
		tb_curso.codigo, tb_curso.tag_curso, tb_curso.nm_curso, tb_curso.ds_curso, 
			(select url_banner from tb_banner_curso where id_curso = tb_curso.codigo order by id_banner asc LIMIT 1 ) as image
	FROM 
		tb_curso order by tb_curso.codigo asc LIMIT 1
	";

	$query = mysqli_query($link, $sql);
	while($row = mysqli_fetch_assoc($query)){
		$curso = (object) array(
			'id' 		 => $row['codigo'],
			'chamada' 	 => $row['nm_curso'],
			'txtchamada' => $row['ds_curso'],
			'imgchamada' => $row['image'],/*,
			'descricao'  => $row['ds_informacao_curso'],
			'aulas' 	 => $row['aulas'], //qt_numero_aulas
			'horas' 	 => $row['horas'],//qt_total_horas
			/*'image' 	 => $row['nm_url_capa_curso'],*/
			'tag' 		 => $row['tag_curso']
			//'link'		 => $row['nm_url_landing_page']
		);
	}
	$course_id = $curso->id;
/*,
			(select qtd_aulas from tb_turma where id_curso = tb_curso.codigo ORDER BY id_curso desc limit 1) as aula,
			(select qtd_horas from tb_turma where id_curso = tb_curso.codigo ORDER BY id_curso desc limit 1) as horas, */

	$sql_turma = "
	SELECT 
		qtd_aulas, qtd_horas 
			
	FROM 
		tb_turma
	WHERE
		id_curso = (select codigo FROM tb_curso Order By codigo asc limit 1) 
		order by id_curso asc LIMIT 1
	";

	$qry = mysqli_query($link, $sql_turma);
	while($row = mysqli_fetch_assoc($qry)){
		$turma = (object) array(
			'id' 		 => $row['id_turma'],
			'aulas' 	 => $row['qtd_aulas'],
			'horas'		 => $row['qtd_horas']
			
		);
	}
	$turma_id = $turma->id;
?>


