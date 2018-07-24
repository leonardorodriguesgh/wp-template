<?php
    require('connection.php');
    /*$host_name = "localhost";
    $database = "lisieux_treinamento";
    $user 	  = "root";
    $password = "";
    try{

	    $conn = new PDO('mysql:host='.$host_name.';dbname='.$database,$user,$password);

	
    }catch(PDOException $e){
        print "Error: ".$e->getMessage()."<br/>";
    }*/
    

    $teste = $_POST['teste'];
    var_dump($conn);

    $email_pagseguro = 'polonio@eslisieux.com.br'; 
	$token_pagseguro = 'AC803C0ABCFE4D61B25D452F8FDC63B6';
    $qtd = 0;

    try{
        $stmt = $conn->prepare('SELECT id_status_pag , cd_transacao FROM tb_pagamento');
        $stmt->execute();
        
        while($row = $stmt->fetch()){
            var_dump($row);
           // $requisicao[$qtd]['code'] = $row['code']; //código da transação
            $code = '5BD44ADC-8AEE-4FFA-B989-8776274748FA';//id da transação
        }
    }catch(PDOException $Exception){
        throw new MyDatabaseException($Exception->getMessage(), $Exception->getCode());
    }

    //foreach ($requisicao as $parcela) {

        $url = 'https://ws.pagseguro.uol.com.br/v2/transactions/'.$code.'?email='.$email_pagseguro.'&token='.$token_pagseguro;

        $_h = curl_init();
        curl_setopt($_h, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($_h, CURLOPT_HTTPGET, 1);
        curl_setopt($_h, CURLOPT_URL, $url );
        curl_setopt($_h, CURLOPT_SSL_VERIFYPEER, TRUE);
        curl_setopt($_h, CURLOPT_SSL_VERIFYHOST,  2);
        //curl_setopt($_h, CURLOPT_DNS_USE_GLOBAL_CACHE, false );
        curl_setopt($_h, CURLOPT_DNS_CACHE_TIMEOUT, 2 );
        curl_setopt($_h, CURLOPT_HTTPHEADER, Array("Content-Type: application/xml; charset=ISO-8859-1"));
        $output = curl_exec($_h); //retorno vem como STRING

        $transaction = simplexml_load_string($output); //configura retorno com XML

        $status_compra = $transaction->status; //Pega somente a área STATUS do xml

        try{
            //vou até o banco dar update com o id que eu tenho em $parcela
            $stmt->execute();
            //var_dump($parcela);
            /*while($row = $stmt->fetch()){
                $requisicao[$qtd]['code'] = $row['code']; //código da transação
                $requisicao[$qtd]['id'] = $row['id']; //id da transação
            }*/
        }catch(PDOException $Exception){
            throw new MyDatabaseException($Exception->getMessage(), $Exception->getCode());
        }


    //}