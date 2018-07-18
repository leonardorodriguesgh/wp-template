<?php

$link = mysqli_connect("localhost", "root", "", "lisieux_treinamento");

mysqli_set_charset($link,"utf8");

$query = mysqli_query($link, "
	SELECT  C.codigo, C.nm_curso, C.tag_curso
	FROM tb_curso C
	INNER JOIN tb_turma T ON C.codigo = T.id_curso
	WHERE C.ativo = 1 ORDER BY T.dt_inicio ASC LIMIT 10
");

$list = array();

while ($row = mysqli_fetch_assoc($query)) {
	
	$id = (int) $row['codigo'];

	$query_lotes = mysqli_query($link, "
		SELECT MIN(L.vl_lote) AS valor
		FROM tb_lote L INNER JOIN tb_curso C 
		ON L.id_turma = C.codigo
		WHERE L.id_turma = $id
	");

	while($lote = mysqli_fetch_assoc($query_lotes)){
		$list[] = array(
			'titulo' 	=> $row['nm_curso'],
			'tag' => $row['tag_curso']
		);
	}
}
?>

<aside class="sidebar">
	<h4>Cursos</h4>
	<nav class="list_cursos">
		<?php foreach ($list as $value) { ?>
			<a href="<?php bloginfo('url') ?>/cursos-e-consultoria/<?php echo $value['tag'] ?>/"><li><?= $value['titulo'] ?></li></a>
		<?php } ?>
	</nav>
<aside>
