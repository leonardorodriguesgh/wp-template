<?php

$link = mysqli_connect("localhost", "root", "", "lisieux_treinamento");

mysqli_set_charset($link,"utf8");
//,T.ic_boleto, T.qt_cartao
$turmas = array();
$sql = "SELECT T.id_turma, T.dt_inicio, T.dt_termino, T.qtd_vagas FROM tb_turma T INNER JOIN tb_curso C ON T.id_curso = C.codigo WHERE T.id_curso = ".$id_curso."";
$query = mysqli_query($link, $sql);
$count = 1;

while ( $row = mysqli_fetch_assoc( $query ) ) {
	$turmas[] = array(
		'id'	 => $row['id_turma'],
		'numero' => $count++,
		'inicio' => $row['dt_inicio'],
		'final'	 => $row['dt_termino'],
		'vagas'	 => $row['qtd_vagas']/*,
		'boleto' => $row['ic_boleto'],
		'cartao' => $row['qt_cartao']*/
	);
}
?>