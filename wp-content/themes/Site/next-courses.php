<?php
$link = mysqli_connect("localhost", "root", "", "lisieux_treinamento");

mysqli_set_charset($link,"utf8");

$query = mysqli_query($link, "
SELECT 
	tb_curso.codigo, tb_curso.tag_curso, tb_curso.nm_curso, tb_curso.ds_curso, 
	(select url_banner from tb_banner_curso where id_curso = tb_curso.codigo order by id_banner asc LIMIT 1 ) as image
FROM 
	tb_curso 
order by 
	tb_curso.codigo asc LIMIT 4
");

$nextCourses = array();

while ($row = mysqli_fetch_assoc($query)) {
	
	$id = (int) $row['codigo'];

	// $query_lotes = mysql_query("
	// 	SELECT MIN(L.vl_lote_curso) AS valor, T.dt_inicio_turma AS data
	// 	FROM ci_lote L 
	// 	INNER JOIN ci_curso C ON L.cd_curso = C.cd_curso
	// 	INNER JOIN ci_turma_curso T ON T.cd_curso = L.cd_curso
	// 	WHERE L.cd_curso = $id
	// ");

	// SELECT T.dt_inicio_turma AS data_inicio, T.dt_final_turma AS data_final, A.nm_cidade AS cidade
	// 	FROM ci_turma_curso T
	// 	INNER JOIN ci_curso C ON T.cd_curso = C.cd_curso 
	// 	INNER JOIN ci_turma_curso_local A ON T.cd_turma_curso_local = A.cd_turma_curso_local
	// 	WHERE C.cd_curso = $id

	$query_turmas = mysqli_query($link,"

		SELECT T.dt_inicio AS data_inicio, T.dt_termino AS data_final, qtd_aulas, qtd_horas
		FROM tb_turma T
		INNER JOIN tb_curso C ON T.id_curso = C.codigo
		ORDER BY C.codigo asc LIMIT 1
	");
	while($turma = mysqli_fetch_assoc($query_turmas)){
		$nextCourses[] = array(
			'titulo' 	=> $row['nm_curso'],
			'descricao' => $row['ds_curso'],
			'aulas' 	=> $turma['qtd_aulas'],
			'horas' 	=> $turma['qtd_horas'],
			'image' 	=> $row['image'],
			'tag'       => $row['tag_curso'],
			'data_inicio'  => $turma['data_inicio'],
			'data_final'  => $turma['data_final']/*,
			'cidade'    => $turma['cidade'],*/
		);
	}

}
?>



