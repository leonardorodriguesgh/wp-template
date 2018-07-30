<?php

//$urlPagseguro = "https://ws.pagseguro.uol.com.br/v2/"; 
$emailPagseguro = "contato@summercomunicacao.com.br";
//$tokenPagseguro = "AC803C0ABCFE4D61B25D452F8FDC63B6";
/* SANDBOX  */
$urlPagseguro = "https://ws.sandbox.pagseguro.uol.com.br/"; 
// $emailPagseguro = "contato@summercomunicacao.com.br";
$tokenPagseguro = "3665C3642B364E5493A7051C3E2942E6";

// $emailPagseguro = "polonio@eslisieux.com.br";
// $urlPagseguro = "https://ws.sandbox.pagseguro.uol.com.br/"; 
// $tokenPagseguro = "43388955C35D45BDB52A6EC956A7D44F";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $urlPagseguro . 'sessions?email=' . $emailPagseguro . '&token=' . $tokenPagseguro);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, true);

$xml = curl_exec($ch);

if($xml == 'Unauthorized'){
  echo "Unauthorized";
  exit();
}

curl_close($ch);

$json = json_decode(json_encode(simplexml_load_string($xml)));
$sessionCode = $json->id;

echo $sessionCode;

?>