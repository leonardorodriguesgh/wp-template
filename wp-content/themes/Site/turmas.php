<?
$turmas = array();
$sql = "SELECT T.cd_turma_curso, T.dt_inicio_turma, T.dt_final_turma, T.qt_vaga_disponivel,T.ic_boleto, T.qt_cartao FROM ci_turma_curso T INNER JOIN ci_curso C ON T.cd_curso = C.cd_curso WHERE T.cd_curso = ".$course_id."";
$query = mysql_query($sql);
$count = 1;

while ( $row = mysql_fetch_assoc( $query ) ) {
	$turmas[] = array(
		'id'	 => $row['cd_turma_curso'],
		'numero' => $count++,
		'inicio' => $row['dt_inicio_turma'],
		'final'	 => $row['dt_final_turma'],
		'vagas'	 => $row['qt_vaga_disponivel'],
		'boleto' => $row['ic_boleto'],
		'cartao' => $row['qt_cartao']
	);
}
?>