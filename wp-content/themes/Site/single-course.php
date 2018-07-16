<?php 

$link = mysqli_connect("localhost", "root", "", "lisieux_treinamento");

mysqli_set_charset($link,"utf8");

$info_cursos = array();

$nome_lote = array(
	1 => 'Primeiro Lote',
	2 => 'Segundo Lote',
	3 => 'Terceiro Lote'
);

$sql ="
		SELECT 
D.nm_dia_semana, ID.hr_inicio, ID.hr_termino ,T.nm_tipo_curso, TUR.qt_vaga_disponivel, TUR.dt_inicio_turma, TUR.dt_final_turma, C.dt_inicio_curso, 
C.dt_termino_curso, C.nm_url_capa_curso, C.nm_url_capa_mobile_curso, C.nm_titulo_curso,C.ds_chamada_curso, C.nm_chamada_curso, 
C.ds_informacao_curso, C.qt_numero_aulas, C.qt_total_horas, C.tag_curso, C.cd_curso, C.nm_url_landing_page, C.nm_url_pdf, C.nm_sigla
FROM ci_curso as C 
INNER JOIN ci_tipo_curso as T ON C.cd_tipo_curso = T.cd_tipo_curso 
INNER JOIN ci_turma_curso as TUR ON TUR.cd_curso = C.cd_curso
INNER JOIN item_dia_semana_curso as ID ON ID.cd_curso = C.cd_curso
INNER JOIN ci_dia_semana as D ON ID.cd_dia_semana = D.cd_dia_semana
";

$sql .= ( isset($wp_query->query_vars['name']) ) ? " WHERE C.tag_curso = '".$wp_query->query_vars['name']."'" : " ";


$query = mysqli_query($link, $sql);

while($row = mysqli_fetch_assoc($query)){
	$id_curso = $row['cd_curso'];
	$queryVagas = "SELECT T.qt_vaga_disponivel - count(I.cd_turma_curso)  as Disponiveis  FROM `ci_turma_curso` as T
	INNER JOIN ci_inscricao_curso_aluno as I ON T.cd_turma_curso = I.cd_turma_curso
	WHERE T.cd_curso = ".$id_curso;

	$queryVagasDisponiveis = mysqli_query($link, $queryVagas);

	while($vagas = mysqli_fetch_assoc($queryVagasDisponiveis)){
		$vagasDisponiveis = $vagas['Disponiveis'];
	}

	if (isset($wp_query->query_vars['name'])){
		$info_curso = (object) array(
			'id' 			=> $row['cd_curso'],
			'dia_semana'	=> $row['nm_dia_semana'],
			'hr_inicio'		=> $row['hr_inicio'],
			'hr_termino'	=> $row['hr_termino'],
			'dt_inicio'		=> date("d/m/Y", strtotime($row['dt_inicio_curso'])),
			'dt_termino'	=> date("d/m/Y", strtotime($row['dt_termino_curso'])),
			'tipo'			=> $row['nm_tipo_curso'],
			'vagas'			=> $row['qt_vaga_disponivel'],
			'disponiveis'	=> $vagasDisponiveis,
			'image' 		=> $row['nm_url_capa_curso'],
			'image_mob'		=> $row['nm_url_capa_mobile_curso'],
			'titulo'		=> $row['nm_titulo_curso'],
			'chamada' 		=> ($row['ds_chamada_curso'] == "") ? $row['nm_chamada_curso'] : $row['ds_chamada_curso'],
			'descricao' 	=> $row['ds_informacao_curso'],
			'aulas' 		=> $row['qt_numero_aulas'],
			'horas' 		=> $row['qt_total_horas'],
			'tag' 			=> $row['tag_curso'],
			'link'			=> $row['nm_url_landing_page'],
			'pdf'			=> $row['nm_url_pdf'],
			'init_turma'	=> date("d/m/Y", strtotime($row['dt_inicio_turma'])),
			'final_turma'	=> date("d/m/Y", strtotime($row['dt_final_turma'])),
			'sigla'			=> $row['nm_sigla']
		);
	}else{

		$LoteSql = "
			SELECT L.vl_lote_curso, L.dt_inicio_lote, L.dt_termino_lote, L.nr_lote
			FROM ci_lote L
			INNER JOIN ci_curso C ON L.cd_curso = C.cd_curso
			WHERE L.dt_termino_lote >= NOW()
			AND L.dt_inicio_lote <= NOW()
			AND L.cd_curso = ".$row['cd_curso']."";

		$Lotequery = mysqli_query($link, $LoteSql);

		while($rowL = mysqli_fetch_assoc($Lotequery)){

			$info_cursos[] = array(
				'id' 			=> $row['cd_curso'],
				'dia_semana'	=> $row['nm_dia_semana'],
				'hr_inicio'		=> $row['hr_inicio'],
				'hr_termino'	=> $row['hr_termino'],
				'dt_inicio'		=> date("d/m/Y", strtotime($row['dt_inicio_curso'])),
				'dt_termino'	=> date("d/m/Y", strtotime($row['dt_termino_curso'])),
				'tipo'			=> $row['nm_tipo_curso'],
				'vagas'			=> $row['qt_vaga_disponivel'],
				'disponiveis'	=> $vagasDisponiveis,
				'image' 		=> $row['nm_url_capa_curso'],
				'image_mob'		=> $row['nm_url_capa_mobile_curso'],
				'titulo'		=> $row['nm_titulo_curso'],
				'chamada' 		=> ($row['ds_chamada_curso'] == "") ? $row['nm_chamada_curso'] : $row['ds_chamada_curso'],
				'descricao' 	=> $row['ds_informacao_curso'],
				'tag' 			=> $row['tag_curso'],
				'lote'			=> $nome_lote[$rowL['nr_lote']],
				'valor'			=> $rowL['vl_lote_curso'],
				'link'			=> $row['nm_url_landing_page'],
				'pdf'			=> $row['nm_url_pdf'],
				'sigla'			=> $row['nm_sigla']
			);
		}

	}
}

$course_id = $info_curso->id;

?>