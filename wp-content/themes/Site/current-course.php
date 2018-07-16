<?php

	$link = mysqli_connect("localhost", "root", "", "lisieux_treinamento");

	mysqli_set_charset($link,"utf8");
	
	//Como vou passar tudo isso se no meu banco nao existem tantos campos?
	$sql = 	
	"
		SELECT  cd_curso, tag_curso, nm_chamada_curso, ds_chamada_curso, url_image_chamada_curso, ds_informacao_curso, qt_numero_aulas, qt_total_horas, nm_url_capa_curso, nm_url_landing_page
		FROM ci_curso
		WHERE cd_situacao_curso = 2 ORDER BY dt_inicio_curso ASC
	";

	$query = mysqli_query($link, $sql);
	while($row = mysqli_fetch_assoc($query)){
		$curso = (object) array(
			'id' 		 => $row['cd_curso'],
			'chamada' 	 => $row['nm_chamada_curso'],
			'txtchamada' => $row['ds_chamada_curso'],
			'imgchamada' => $row['url_image_chamada_curso'],
			'descricao'  => $row['ds_informacao_curso'],
			'aulas' 	 => $row['qt_numero_aulas'],
			'horas' 	 => $row['qt_total_horas'],
			'image' 	 => $row['nm_url_capa_curso'],
			'tag' 		 => $row['tag_curso'],
			'link'		 => $row['nm_url_landing_page']
		);
	}
	$course_id = $curso->id;

?>


