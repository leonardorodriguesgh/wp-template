<?php
$link = mysqli_connect("localhost", "root", "", "lisieux_treinamento");

mysqli_set_charset($link,"utf8");

$query = mysqli_query($link, "
	SELECT  cd_curso,nm_titulo_curso, ds_chamada_curso, qt_numero_aulas, 
	qt_total_horas, nm_url_thumbnail_curso, tag_curso
	FROM ci_curso
	WHERE cd_situacao_curso = 3 ORDER BY dt_inicio_curso ASC LIMIT 4
");

$nextCourses = array();

while ($row = mysqli_fetch_assoc($query)) {
	
	$id = (int) $row['cd_curso'];

	// $query_lotes = mysql_query("
	// 	SELECT MIN(L.vl_lote_curso) AS valor, T.dt_inicio_turma AS data
	// 	FROM ci_lote L 
	// 	INNER JOIN ci_curso C ON L.cd_curso = C.cd_curso
	// 	INNER JOIN ci_turma_curso T ON T.cd_curso = L.cd_curso
	// 	WHERE L.cd_curso = $id
	// ");

	$query_turmas = mysqli_query($link,"

		SELECT T.dt_inicio_turma AS data_inicio, T.dt_final_turma AS data_final, A.nm_cidade AS cidade
		FROM ci_turma_curso T
		INNER JOIN ci_curso C ON T.cd_curso = C.cd_curso 
		INNER JOIN ci_turma_curso_local A ON T.cd_turma_curso_local = A.cd_turma_curso_local
		WHERE C.cd_curso = $id
	");

	while($turma = mysqli_fetch_assoc($query_turmas)){
		$nextCourses[] = array(
			'titulo' 	=> $row['nm_titulo_curso'],
			'descricao' => $row['ds_chamada_curso'],
			'aulas' 	=> $row['qt_numero_aulas'],
			'horas' 	=> $row['qt_total_horas'],
			'image' 	=> $row['nm_url_thumbnail_curso'],
			'tag'       => $row['tag_curso'],
			'data_inicio'  => $turma['data_inicio'],
			'data_final'  => $turma['data_final'],
			'cidade'    => $turma['cidade'],
		);
	}

}
?>



