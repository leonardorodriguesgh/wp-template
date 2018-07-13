<?
require("connection.php");

$check = $_POST['cupomdesconto'];

$query = $conn->prepare("SELECT qt_desconto FROM tb_cupons WHERE nm_cupom = :cupom ");
$query->bindValue(':cupom', $check);
$query->execute();

$percent = $query->fetchColumn();

if($percent > 0)
	echo $percent;
else
	echo 0;


?>