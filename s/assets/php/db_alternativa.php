<?php
	
	$host_name = "localhost";
	$database = "lisieux_treinamento";
	$user = "root";
	$password = "";

	$conn = new PDO('mysql:host='.$host_name.';dbname='.$database, $user, $password);
	$conn->exec("set names utf8");

	if(isset($_POST['idLabelRes'])){$busca = $_POST['idLabelRes'];}
	$tipo = $_POST['tipo'];
	if(isset($busca)){var_dump($busca);}
	var_dump($tipo);

	try{
		$stmt = $conn->prepare("INSERT INTO tb_alternativa
		(id_questao,
		ds_enunciado,
		id_tipo,
		dt_ultima_modificacao,
		id_ultima_modificacao,
		ativo,
		nm_questao,
		id_exercicio)
		VALUES
		(NULL,
		 NULL,
		 NULL,
		 NULL,
		 NULL,
		 NULL,
		 NULL,
		 1)");
//OS : SÃO PARA DECLARAR OS MARCADORES
		/*$stmt->bindValue(':id_questao', NULL);
		$stmt->bindValue(':ds_enunciado', NULL);
		$stmt->bindValue(':id_tipo', NULL);
		$stmt->bindValue(':dt_ultima_modificacao', NULL);
		$stmt->bindValue(':id_ultima_modificacao', NULL);
		$stmt->bindValue(':ativo', NULL);
		$stmt->bindValue(':nm_questao', NULL);
		$stmt->bindValue(':id_exercicio', NULL);
		$stmt->execute();

		echo "1";*/

	}catch (PDOException $Exception){
		throw new MyDatabaseException($Exception->getMessage(), $Exception->getCode());
	}//Mostrar os erros
