<?php
$link = mysqli_connect("localhost", "root", "", "lisieux_treinamento");

mysqli_set_charset($link,"utf8");

$lotes = array();

$sql = "SELECT vl_lote, dt_inicio, dt_termino FROM tb_lote L INNER JOIN tb_curso C ON L.id_turma = C.codigo WHERE L.id_turma = ".$course_id."";

$res = mysqli_query($link, $sql );

$nome_lote = array(
	0 => 'Primeiro Lote',
	1 => 'Segundo Lote',
	2 => 'Terceiro Lote'
);

$situacao = 0;
$cont = 0;
$currentDate = strtotime(date ("Y-m-d"));

while ( $row = mysqli_fetch_assoc( $res ) ) {
	
	$initialDateSql = strtotime($row['dt_inicio']);
	$finalDateSql = strtotime($row['dt_termino']);

	if($finalDateSql < $currentDate){
		$situacao = -1;
	}else if( $currentDate >= $initialDateSql ){
		if($currentDate <= $finalDateSql){
			$situacao = 1;
		}
	}

	$lotes[] = array(
		'lote'		=> $cont,
		'nomeLote' 	=> $nome_lote[$cont],
		'inicial'	=> $row['dt_inicio'],
		'final'		=> $row['dt_termino'],
		'valor'		=> $row['vl_lote'],
		'situacao'	=> $situacao
	);

	$situacao = 0;
	$cont++;
}


?>