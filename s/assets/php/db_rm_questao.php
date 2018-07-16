<?php
	
	$host_name = "localhost";
	$database = "lisieux_treinamento";
	$user = "root";
	$password = "";

	$conn = new PDO('mysql:host='.$host_name.';dbname='.$database, $user, $password);
	$conn->exec("set names utf8");

	/*if(isset($_POST['idLabelRes'])){$busca = $_POST['idLabelRes'];}*/
	
	$id = $_POST['first_id'];		
	$index = $_POST['index'];
	//$query = $conn->prepare('SELECT MAX(id_questao) FROM tb_questao');    

	/*try{
		$stmt = $conn->prepare("UPDATE tb_questao 
		SET 
		ativo = 0
		WHERE 
		id_questao = $id - $index;
		");

		$stmt->execute();
		

		
		$stmtll = $conn->prepare("SELECT MAX(id_questao) FROM tb_questao");
	    $stmtll->execute();
	    echo $stmtll->fetchColumn();
	    
	}catch (PDOException $Exception){
		throw new MyDatabaseException($Exception->getMessage(), $Exception->getCode());
	}//Mostrar os erros*/
