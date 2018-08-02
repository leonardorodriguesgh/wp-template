<?php
//header("access-control-allow-origin: https://sandbox.pagseguro.uol.com.br");

$link = mysqli_connect("localhost", "root", "", "lisieux_treinamento");
mysqli_set_charset($link,"utf8");

$id = $_POST['user_id'];

$sqlTel = "SELECT A.celular FROM tb_aluno A INNER JOIN tb_usuario U ON A.id_usuario = U.codigo WHERE U.codigo = ".$id;//ta pegando dos dois users

$query = mysqli_query($link, $sqlTel);
$tel = mysqli_fetch_assoc($query);
$telefone = $tel['celular'];
// $remstr = array("(", ")", " ", "-", ".");
// implode('', $remstr);
//$telefone = str_replace($remstr, "", $tel);
$ddd = trim(substr($telefone, 0, 2), ' ');
$telefone = trim(substr($telefone, 2), ' ');

$sqlEnd = "SELECT E.endereco, E.numero, E.complemento, E.bairro, E.cidade, E.estado, E.cep FROM tb_aluno_endereco E INNER JOIN tb_aluno A ON E.id_aluno = A.id_aluno INNER JOIN tb_usuario U ON A.id_usuario = U.codigo WHERE U.codigo = ".$id;
$end = mysqli_query($link, $sqlEnd);
$ender = mysqli_fetch_assoc($end);

$cidade = $ender['cidade'];
$estado = $ender['estado'];
$bairro = $ender['bairro'];
$endereco = $ender['endereco'];
$numero = $ender['numero'];
$cep = $ender['cep'];
$complemento = $ender['complemento'];



$client = (object) array(
	"usuario" 		=> $_POST['usuario'],
	"nome" 			=> $_POST['nome'],
	"ddd"			=> $ddd,
	"telefone" 		=> $telefone,
	"email" 		=> $_POST['email'],
	"cep" 			=> $cep,
	"cidade" 		=> $cidade,
	"estado" 		=> $estado,
	"bairro" 		=> $bairro,
	"endereco" 		=> $endereco,
	"numero" 		=> $numero,
	"complemento"	=> $complemento,
	"senderHash"    => $_POST['senderHash']
);

$payment = (object) array(
	"endereco" 		=> $_POST['enderecoPagamento'],
	"numero" 		=> $_POST['numeroPagamento'],
	"complemento" 	=> $_POST['complementoPagamento'],
	"bairro" 		=> $_POST['bairroPagamento'],
	"cep" 			=> $_POST['cepPagamento'],
	"cidade" 		=> $_POST['cidadePagamento'],
	"estado" 		=> $_POST['estadoPagamento']
);

$card = (object) array(
	"token" 		=> $_POST['cardToken'],
	"nome" 			=> $_POST['cardNome'],
	"nascimento" 	=> $_POST['cardNasc'],
	"cpf" 			=> $_POST['cardCPF'], //str_replace($remstr, "",) 
	"ddd"			=> $ddd,
	"telefone" 		=> $telefone
);

$payvalues = (object) array(
	"parcela" 		=> $_POST['numParcelas'],
	"valor"		 	=> number_format($_POST['valorParcelas'], 2, '.', ''),
	"total"			=> number_format($_POST['numParcelas'] * round($_POST['valorParcelas'], 3), 2, '.', ''),
	"max"			=> $_POST['maxQuantidadeParcelas']
);

$product = (object) array(
	"id"			=> $_POST['id'],
	"produto"			=> $_POST['produto'],
);
//var_dump( $_SERVER['REMOTE_ADDR']);

$urlPagseguro = "https://ws.sandbox.pagseguro.uol.com.br/"; 
$emailPagseguro = "contato@summercomunicacao.com.br";
$tokenPagseguro = "3665C3642B364E5493A7051C3E2942E6";

include 'gerarXml.php';
$xml = gerarXmlCartao($product->id, $product->produto, $payvalues->total, $client->usuario, $client->nome, $card->cpf, $client->ddd, $client->telefone, $client->email, $client->senderHash, $client->endereco, $client->numero, $client->complemento, $client->bairro, $client->cep, $client->cidade, $client->estado, $payment->endereco, $payment->numero, $payment->complemento, $payment->bairro, $payment->cep, $payment->cidade, $payment->estado, $card->token, $card->nome, $card->cpf, $card->nascimento, $card->ddd, $card->telefone, $payvalues->parcela, $payvalues->valor, $payvalues->max);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $urlPagseguro . "transactions/?email=" . $emailPagseguro . "&token=" . $tokenPagseguro);
curl_setopt($ch, CURLOPT_POST, true );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml; charset=ISO-8859-1'));


//header('Content-Type: application/json; charset=UTF-8');
$data = curl_exec($ch);
$dataXml = simplexml_load_string($data);//da erro aqui tambem
echo json_encode($dataXml);
curl_close($ch);
//  echo $xml;
// $urlPagseguro = "https://ws.sandbox.pagseguro.uol.com.br/"; 
// $emailPagseguro = "contato@summercomunicacao.com.br";
// $tokenPagseguro = "3665C3642B364E5493A7051C3E2942E6";
/* SANDBOX  */
// $urlPagseguro = "https://ws.sandbox.pagseguro.uol.com.br/"; 
// $emailPagseguro = "contato@summercomunicacao.com.br";
// $tokenPagseguro = "43388955C35D45BDB52A6EC956A7D44F";


// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, $urlPagseguro . "transactions/?email=" . $emailPagseguro . "&token=" . $tokenPagseguro);
// curl_setopt($ch, CURLOPT_POST, true );
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
// curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml; charset=ISO-8859-1'));

// $data = curl_exec($ch);
// $dataXML = simplexml_load_string($data);//da erro aqui tambem

// header('Content-Type: application/json; charset=UTF-8');
// echo json_encode($dataXML);
 	
// curl_close($ch);