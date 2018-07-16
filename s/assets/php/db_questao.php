<?php
	
	$host_name = "localhost";
	$database = "lisieux_treinamento";
	$user = "root";
	$password = "";

	$conn = new PDO('mysql:host='.$host_name.';dbname='.$database, $user, $password);
	$conn->exec("set names utf8");

	/*if(isset($_POST['idLabelRes'])){$busca = $_POST['idLabelRes'];}*/
	
	$tipo = $_POST['tipo'];	
	//$query = $conn->prepare('SELECT MAX(id_questao) FROM tb_questao');    

	try{
		$stmt = $conn->prepare("INSERT INTO tb_questao 
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
		$tipo,
		NULL,
		NULL,
		0,
		NULL,
		1)");

		$stmt->execute();
		
		//echo "1";
		
		$stmtll = $conn->prepare("SELECT MAX(id_questao) FROM tb_questao");
	    $stmtll->execute();
	    echo $stmtll->fetchColumn();
	    
	}catch (PDOException $Exception){
		throw new MyDatabaseException($Exception->getMessage(), $Exception->getCode());
	}//Mostrar os erros*/
