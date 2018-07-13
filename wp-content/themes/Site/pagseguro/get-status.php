<?php

$urlPagseguro = "https://ws.pagseguro.uol.com.br/v2/"; 
$emailPagseguro = "polonio@eslisieux.com.br";
$tokenPagseguro = "AC803C0ABCFE4D61B25D452F8FDC63B6";
/* SANDBOX  */
// $urlPagseguro = "https://ws.sandbox.pagseguro.uol.com.br/"; 
// $tokenPagseguro = "43388955C35D45BDB52A6EC956A7D44F";

sleep(5);
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $urlPagseguro . "transactions/". $_POST['id'] . "?email=". $emailPagseguro . "&token=" . $tokenPagseguro);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml; charset=ISO-8859-1'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($ch);

$dataXML = simplexml_load_string($data);

header('Content-Type: application/json; charset=UTF-8');
$data = (json_encode($dataXML));

echo (json_decode($data)->status);
curl_close($ch);