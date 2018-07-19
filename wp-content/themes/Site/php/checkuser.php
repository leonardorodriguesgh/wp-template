<?php
require("connection.php");

$user = (object) array(
	'email'		=> $_POST['log_email'],
	'password'	=> md5($_POST['log_senha'])
);

$query = $conn->prepare("SELECT * FROM tb_usuario WHERE email = :email and senhao  = :senha AND ativo = 1");
$query->bindValue(':email', $user->email);
$query->bindValue(':senha', $user->password);
$query->execute();

if($query->rowCount() > 0) {
	while($row = $query->fetch(PDO::FETCH_ASSOC)){
		$data = array( "return" => "true", "type" => "studant", "codigo" => $row['codigo'] );//aluno / usuario normal
	}

} else{
	
	$query2 = $conn->prepare("SELECT * FROM  tb_usuario WHERE email = :email AND senha = :senha AND ativo = 1 ");//patrocinador
	$query2->bindValue(':email', $user->email);
	$query2->bindValue(':senha', $user->password);
	$query2->execute();

	if($query2->rowCount() > 0) {
		while($row = $query2->fetch(PDO::FETCH_ASSOC)){
			$data = array( "return" => "true", "type" => "sponsor", "codigo" => $row['cd_patrocinador'] );
		}

	} else {
		$data = array("return" => "false", "type" => "none");
	}
}

echo json_encode($data);

?>