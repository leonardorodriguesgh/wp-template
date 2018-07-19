<?php 

$link = mysqli_connect("localhost", "root", "", "lisieux_treinamento");

mysqli_set_charset($link,"utf8");

$info_cursos = array();

$nome_lote = array(
	1 => 'Primeiro Lote',
	2 => 'Segundo Lote',
	3 => 'Terceiro Lote'
);

// D.nm_dia_semana, ID.hr_inicio, ID.hr_termino ,T.nm_tipo_curso, TUR.qt_vaga_disponivel, TUR.dt_inicio_turma, TUR.dt_final_turma, C.dt_inicio_curso, 
// C.dt_termino_curso, C.nm_url_capa_curso, C.nm_url_capa_mobile_curso, C.nm_titulo_curso,C.ds_chamada_curso, C.nm_chamada_curso, 
// C.ds_informacao_curso, C.qt_numero_aulas, C.qt_total_horas, C.tag_curso, C.cd_curso, C.nm_url_landing_page, C.nm_url_pdf, C.nm_sigla
// FROM ci_curso as C 
// INNER JOIN ci_tipo_curso as T ON C.cd_tipo_curso = T.cd_tipo_curso 
// INNER JOIN ci_turma_curso as TUR ON TUR.cd_curso = C.cd_curso
// INNER JOIN item_dia_semana_curso as ID ON ID.cd_curso = C.cd_curso
// INNER JOIN ci_dia_semana as D ON ID.cd_dia_semana = D.cd_dia_semana

$sql ="
		SELECT 
C.tipo, T.dt_inicio, T.dt_termino, B.url_banner, C.nm_curso,
C.ds_curso, C.nm_curso, 
T.qtd_aulas, T.qtd_horas, C.tag_curso, C.codigo, C.sigla_curso
FROM tb_curso as C 
INNER JOIN tb_turma as T ON T.id_curso = C.codigo
INNER JOIN tb_banner_curso as B ON C.codigo = B.id_curso
";

//$sql .= ( $wp_query->query_vars['curso'] != null) ? " WHERE C.tag_curso = '".$wp_query->query_vars['curso']."'" : "";
 //var_dump($wp_query->query_vars['curso']);
// var_dump($wp_query->query_vars['name']);
$query = mysqli_query($link, $sql);


while($row = mysqli_fetch_assoc($query)){
	$id_curso = $row['codigo'];
	$queryVagas = "SELECT T.qtd_vagas - count(I.id_turma)  as Disponiveis  FROM `tb_turma` as T
	INNER JOIN tb_inscricao as I ON T.id_curso = I.id_turma
	WHERE T.id_curso = ".$id_curso;
	

	$queryVagasDisponiveis = mysqli_query($link, $queryVagas);

	while($vagas = mysqli_fetch_assoc($queryVagasDisponiveis)){
		$vagasDisponiveis = $vagas['Disponiveis'];
	}

	// if ($wp_query->query_vars['name'] == '' || $wp_query->query_vars['curso'] == ''){
	// 	$info_curso = (object) array(
	// 		'id' 			=> $row['codigo'],
	// 		/*'dia_semana'	=> $row['nm_dia_semana'],
	// 		'hr_inicio'		=> $row['hr_inicio'],
	// 		'hr_termino'	=> $row['hr_termino'],*/
	// 		'dt_inicio'		=> date("d/m/Y", strtotime($row['dt_inicio'])),
	// 		'dt_termino'	=> date("d/m/Y", strtotime($row['dt_termino'])),
	// 		'tipo'			=> $row['tipo'],
	// 		'vagas'			=> $row['qtd_vagas'],
	// 		'disponiveis'	=> $vagasDisponiveis,
	// 		'image' 		=> $row['url_banner'],
	// 		//'image_mob'		=> $row['nm_url_capa_mobile_curso'],
	// 		'titulo'		=> $row['nm_curso'],
	// 		'chamada' 		=> ($row['ds_curso'] == "") ? $row['nm_curso'] : $row['ds_curso'],
	// 		//'descricao' 	=> $row['ds_informacao_curso'],
	// 		'aulas' 		=> $row['qtd_aulas'],
	// 		'horas' 		=> $row['qtd_horas'],
	// 		'tag' 			=> $row['tag_curso'],
	// 		//'link'			=> $row['nm_url_landing_page'],
	// 		//'pdf'			=> $row['nm_url_pdf'],
	// 		// 'init_turma'	=> date("d/m/Y", strtotime($row['dt_inicio'])),
	// 		// 'final_turma'	=> date("d/m/Y", strtotime($row['dt_termino'])),
	// 		'sigla'			=> $row['sigla_curso']
	// 	);

	// 	// var_dump($row);
	// }else{

	// 	$LoteSql = "
	// 		SELECT L.vl_lote, L.dt_inicio, L.dt_termino
	// 		FROM tb_lote L
	// 		INNER JOIN tb_curso C ON L.id_turma = C.codigo
	// 		WHERE L.dt_termino >= NOW()
	// 		AND L.dt_inicio <= NOW()
	// 		AND L.id_turma = ".$row['codigo']."";

	// 	$Lotequery = mysqli_query($link, $LoteSql);

	// 	while($rowL = mysqli_fetch_assoc($Lotequery)){

	// 		$info_cursos[] = array(
	// 			'id' 			=> $row['codigo'],
	// 			//'dia_semana'	=> $row['nm_dia_semana'],
	// 			//'hr_inicio'		=> $row['hr_inicio'],
	// 			//'hr_termino'	=> $row['hr_termino'],
	// 			'dt_inicio'		=> date("d/m/Y", strtotime($row['dt_inicio'])),
	// 			'dt_termino'	=> date("d/m/Y", strtotime($row['dt_termino'])),
	// 			'tipo'			=> $row['tipo'],
	// 			'vagas'			=> $row['qtd_vagas'],
	// 			'disponiveis'	=> $vagasDisponiveis,
	// 			'image' 		=> $row['url_banner'],
	// 			//'image_mob'		=> $row['nm_url_capa_mobile_curso'],
	// 			'titulo'		=> $row['nm_curso'],
	// 			'chamada' 		=> ($row['ds_curso'] == "") ? $row['nm_curso'] : $row['ds_curso'],
	// 			'descricao' 	=> $row['ds_curso'],
	// 			'tag' 			=> $row['tag_curso'],
	// 			//'lote'			=> $nome_lote[$rowL['nr_lote']],
	// 			'valor'			=> $rowL['vl_lote'],
	// 			// 'link'			=> $row['nm_url_landing_page'],
	// 			// 'pdf'			=> $row['nm_url_pdf'],
	// 			'sigla'			=> $row['sigla_curso']
	// 		);
	// 	}

//	}
return $id_curso = $row['codigo'];
	
}



?>