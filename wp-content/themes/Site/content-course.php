<?php
$link = mysqli_connect("localhost", "root", "", "lisieux_treinamento");

mysqli_set_charset($link,"utf8");

$query = mysqli_query($link, "SELECT * FROM  ci_aula_curso WHERE cd_curso = ".$info_curso->id."");

$i = 1;
$conteudo = array();

if(mysqli_num_rows($query) != 0){
	while ($row = mysqli_fetch_assoc($query)) {
		$conteudo[] = array(
			'count' => $i++,
			'conteudo' => $row['nm_material_aula']
		);
	}
}

?>