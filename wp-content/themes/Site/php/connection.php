<?php

$host_name = "localhost";
$database = "lisieux_treinamento";
$user 	  = "root";
$password = "";

try{

	$conn = new PDO('mysql:host='.$host_name.';dbname='.$database,$user,$password);

	
}catch(PDOException $e){
	print "Error: ".$e->getMessage()."<br/>";
}

?>