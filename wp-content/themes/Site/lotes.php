<?
$lotes = array();

$sql = "SELECT vl_lote_curso, dt_inicio_lote, dt_termino_lote FROM ci_lote L INNER JOIN ci_curso C ON L.cd_curso = C.cd_curso WHERE L.cd_curso = ".$course_id."";

$res = mysql_query( $sql );

$nome_lote = array(
	0 => 'Primeiro Lote',
	1 => 'Segundo Lote',
	2 => 'Terceiro Lote'
);

$situacao = 0;
$cont = 0;
$currentDate = strtotime(date ("Y-m-d"));

while ( $row = mysql_fetch_assoc( $res ) ) {
	
	$initialDateSql = strtotime($row['dt_inicio_lote']);
	$finalDateSql = strtotime($row['dt_termino_lote']);

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
		'inicial'	=> $row['dt_inicio_lote'],
		'final'		=> $row['dt_termino_lote'],
		'valor'		=> $row['vl_lote_curso'],
		'situacao'	=> $situacao
	);

	$situacao = 0;
	$cont++;
}


?>