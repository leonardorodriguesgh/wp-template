<?php

$remstr = array("(", ")", " ", "-", ".");

$telefone = str_replace($remstr, "", $_POST['telefone']);
$ddd = substr($telefone, 0, 2);
$telefone = substr($telefone, 2);

$client = (object) array(
	"usuario" 		=> $_POST['usuario'],
	"nome" 			=> $_POST['nome'],
	"cpf"			=> str_replace($remstr, "", $_POST['cpf']),
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

$payvalues = (object) array(
	"valor"		 	=> number_format($_POST['valor'], 2, '.', ''),
);

$product = (object) array(
	"id"			=> $_POST['id'],
	"nome"			=> $_POST['produto'],
	"desc"			=> $_POST['info'],
);

include 'gerarXml.php';
$xml = gerarXmlBoleto($product->id, $product->nome, $product->desc, $payvalues->valor, $client->usuario, $client->nome, $client->cpf, $client->ddd, $client->telefone, $client->email, $client->senderHash, $client->endereco, $client->numero, $client->complemento, $client->bairro, $client->cep, $client->cidade, $client->estado);

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
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml; charset=UTF-8'));

$data = curl_exec($ch);
$dataXML = simplexml_load_string($data);


if (empty($dataXML->paymentLink)) {
	header('Content-Type: application/json; charset=UTF-8');
	$errosOcorridos = array('erro' => '1');
	echo json_encode($dataXML);
} else {
	header('Content-Type: application/json; charset=UTF-8');
    echo json_encode($dataXML);
}
curl_close($ch);