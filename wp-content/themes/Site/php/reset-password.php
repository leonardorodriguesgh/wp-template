<?php
require("connection.php");

$user = (object) array(
	'password'	=> md5($_POST['red_senha']),
	'id'		=> $_POST['code']
);

$query = $conn->prepare("UPDATE ci_aluno SET cd_senha_usuario = :password WHERE cd_aluno = :id");
$query->bindValue(':id', $user->id);
$query->bindValue(':password', $user->password);
$query->execute();

if($query->fetchColumn())
	echo  "false";
else
	echo "true";

?>