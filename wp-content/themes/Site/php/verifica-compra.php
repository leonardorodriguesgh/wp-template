<? 

/* 

Verificar se a compra ja foi efetua antes

*/

if($_POST['codUsuario'] && $_POST['codProduto'] && $_POST['codTurma']):
	
	$usuario = $_POST['codUsuario'];
	$produto = $_POST['codProduto'];
	$turma 	 = $_POST['codTurma'];
	buscaCompra($usuario, $produto, $turma);

else:
	echo 0;
endif;


/* Verificar se há uma compra em andamento */

function buscaCompra($codUsuario,$codProduto,$codTurma) {
	require("connection.php");
	/* Monta query para buscar se existe uma compra criada no banco */
	$queryBusca = "SELECT cd_pagamento_inscricao as inscricao, cd_status_pagamento as status FROM `ci_pagamento_inscricao` WHERE cd_responsavel_inscricao = ".$codUsuario." AND cd_curso = ".$codProduto." AND cd_turma_curso = ".$codTurma;

	$buscaResul = $conn->prepare($queryBusca);
	$buscaResul->execute();
	$resultado = $buscaResul->fetchAll(0);

	if($resultado == 0 || $resultado == null):
		/* Não existe compra em andamento para esse usuário nesta turma e neste curso */
		echo "false";
	else:
		/* Exite uma compra em andamento */
		$status = $resultado[0]['status'];
		echo $status;
		// switch ($status) {
		//     case 1:
		//         echo "Aguardando pagamento";
		//         break;
		//     case 2:
		//         echo "Em análise";
		//         break;
		//     case 3:
		//         echo "Pagamento concluído";
		//         break;
		//     case 7:
		//         echo "Compra cancelada";
		//         break;
		// }
	endif;

}

?>