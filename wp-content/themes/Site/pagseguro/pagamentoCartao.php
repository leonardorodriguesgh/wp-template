<?php


$remstr = array("(", ")", " ", "-", ".");

$telefone = str_replace($remstr, "", $_POST['telefone']);
$ddd = substr($telefone, 0, 2);
$telefone = substr($telefone, 2);


$client = (object) array(
	"usuario" 		=> $_POST['usuario'],
	"nome" 			=> $_POST['nome'],
	"ddd"			=> $ddd,
	"telefone" 		=> $telefone,
	"email" 		=> $_POST['email'],
	"cep" 			=> $_POST['cep'],
	"cidade" 		=> $_POST['cidade'],
	"estado" 		=> $_POST['estado'],
	"bairro" 		=> $_POST['bairro'],
	"endereco" 		=> $_POST['endereco'],
	"numero" 		=> $_POST['numero'],
	"complemento"	=> $_POST['complemento'],
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
	"cpf" 			=> str_replace($remstr, "", $_POST['cardCPF']),
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
	"nome"			=> $_POST['produto'],
);

include 'gerarXml.php';
$xml = gerarXmlCartao($product->id, $product->nome, $payvalues->total, $client->usuario, $client->nome, $card->cpf, $client->ddd, $client->telefone, $client->email, $client->senderHash, $client->endereco, $client->numero, $client->complemento, $client->bairro, $client->cep, $client->cidade, $client->estado, $payment->endereco, $payment->numero, $payment->complemento, $payment->bairro, $payment->cep, $payment->cidade, $payment->estado, $card->token, $card->nome, $card->cpf, $card->nascimento, $card->ddd, $card->telefone, $payvalues->parcela, $payvalues->valor, $payvalues->max);

// echo $xml;
$urlPagseguro = "https://ws.pagseguro.uol.com.br/v2/"; 
$emailPagseguro = "leonardo.rodrigues@summercomunicacao.com.br";
$tokenPagseguro = "AC803C0ABCFE4D61B25D452F8FDC63B6";
/* SANDBOX  */
// $urlPagseguro = "https://ws.sandbox.pagseguro.uol.com.br/"; 
// $emailPagseguro = "contato@summercomunicacao.com.br";
// $tokenPagseguro = "43388955C35D45BDB52A6EC956A7D44F";


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $urlPagseguro . "transactions/?email=" . $emailPagseguro . "&token=" . $tokenPagseguro);
curl_setopt($ch, CURLOPT_POST, true );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml; charset=ISO-8859-1'));

$data = curl_exec($ch);
$dataXML = simplexml_load_string($data);

header('Content-Type: application/json; charset=UTF-8');
echo json_encode($dataXML);
 	
curl_close($ch);