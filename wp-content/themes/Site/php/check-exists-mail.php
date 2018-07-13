<?php
require("connection.php");


$check = $_POST['email'];

$query = $conn->prepare("SELECT * FROM ci_aluno WHERE nm_email = :email ");
$query->bindValue(':email', $check);
$query->execute();


if($query->fetchColumn()){
	echo  "false";
}
else{
	echo "true";
}
?>