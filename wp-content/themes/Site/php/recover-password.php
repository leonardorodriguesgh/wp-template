<?php

$keys = array(
	"f0ddc89a0df4cebcb5ea7c895e7de31c",
	"5a84c18130e3f3a79802e06dcafd7157",
	"e00660bca1f427003adb991931322c6d",
	"8277e0910d750195b448797616e091ad",
	"270615bc06456123844b82c9e6be8e38",
	"2d02e669731cbade6a64b58d602cf2a4",
);
	
require("connection.php");
require ("PHPMailer/PHPMailerAutoload.php");


$gid = $conn->prepare(" SELECT cd_aluno FROM ci_aluno WHERE nm_email = :email ");
$gid->bindValue(":email", $_POST['rec_email']);
$gid->execute();
$cod = $gid->fetchColumn();

$array = array_slice($keys, 0, 3);
$encode = base64_encode($cod);
$sorteio= mt_rand(0,5);
$maskEncode = $keys[$sorteio]."".$encode;

$mensageClient = "Recuperação de Senha - Treinamentos Lisieux<br>";
$mensageClient .= $form->nome.", Seja Bem Vindo(a)<br>";
$mensageClient .= "
       Clique ou copie o link abaixo para recuperar sua senha<br>
       <a href='http://lisieuxtreinamento.com.br/recuperacao-senha/aluno/$maskEncode'>
       		http://lisieuxtreinamento.com.br/recuperacao-senha/aluno/$maskEncode
       </a>
  ";

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host = "smtp.gmail.com:587";
$mail->SMTPAuth = TRUE; // Autenticação
$mail->Username = 'tecnologia@summercomunicacao.com.br';
$mail->Password = 'tecepw5828';
$mail->SMTPSecure = "tls";
$mail->ClearAllRecipients();
$mail->ClearAttachments();
$mail->IsHTML(true);
$mail->CharSet = 'UTF-8';
$mail->From = "tecnologia@summercomunicacao.com.br"; 
$mail->FromName = "Grupo Lisiuex";
$mail->AddAddress(''.$_POST['rec_email'].'', 'Aluno Lisiuex');
$mail->Subject  = "Recuperação de senha - Treinamentos Lisieux";
$mail->Body = $mensageClient;
$mail->AltBody  = "Recuperação de senha - Treinamentos Lisieux";

if (!$mail->Send()) {
	echo $mail->ErrorInfo;
}else{
	echo "true";
}

?>