<?php

$link = mysqli_connect("localhost", "root", "", "lisieux_treinamento");

mysqli_set_charset($link,"utf8");

$query = mysqli_query($link, "
	SELECT  nm_titulo_curso, tag_curso
	FROM ci_curso
	WHERE cd_situacao_curso >= 2 ORDER BY dt_inicio_curso ASC LIMIT 10
");

$list = array();

while ($row = mysqli_fetch_assoc($query)) {
	
	$id = (int) $row['cd_curso'];

	$query_lotes = mysqli_query($link, "
		SELECT MIN(L.vl_lote_curso) AS valor
		FROM ci_lote L INNER JOIN ci_curso C 
		ON L.cd_curso = C.cd_curso
		WHERE L.cd_curso = $id
	");

	while($lote = mysqli_fetch_assoc($query_lotes)){
		$list[] = array(
			'titulo' 	=> $row['nm_titulo_curso'],
			'tag' => $row['tag_curso']
		);
	}
}
?>

<aside class="sidebar">
	<h4>Cursos</h4>
	<nav class="list_cursos">
		<?php foreach ($list as $value) { ?>
			<a href="<?bloginfo('url') ?>/cursos-e-consultoria/curso/<? echo $value['tag'] ?>/"><li><?= $value['titulo'] ?></li></a>
		<?php } ?>
	</nav>
<aside>
