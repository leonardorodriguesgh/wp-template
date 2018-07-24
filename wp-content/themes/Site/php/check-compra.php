<?php
require("connection.php");

header('Access-Control-Allow-Origin: *');

if(isset($_GET['delta'])){
    if($_GET['delta'] == 'comandodelta'){ 
        /* 
        Bloco de código para verificação de situação da compra com o PagSeguro

        Obs.: Para consultar algum valor que foi retornado pelo XML do PagSeguro, basta seguir a lógica de:
            ---> $XML->ItemPai->ItemFilho (caso precise)
        */

        // Email da conta oficial do PS
        $emailPagseguro = "@MAIL";

        /* PRODUÇÃO */
        $urlPagseguro = "https://ws.pagseguro.uol.com.br/v2/"; 
        $tokenPagseguro = "@TOKEN";

        /* SANDBOX  */
        // $urlPagseguro = "https://ws.sandbox.pagseguro.uol.com.br/v2/"; 
        // $tokenPagseguro = "43388955C35D45BDB52A6EC956A7D44F";

        /* Código de verificação */
        // $codigoVerificacao = $_POST['codigo'];

        // Consulta para busca de código de compra e status no banco
        $buscaStatus = $conn->prepare("SELECT P.id_pagamento as pagamento, P.id_status_pag as status, T.id_curso as curso, 
        P.id_inscricao as inscricao, I.id_turma as turma 
        FROM tb_pagamento P
        INNER JOIN tb_inscricao I ON P.id_inscricao = I.id_inscricao
        INNER JOIN tb_turma T ON I.id_turma = T.id_turma
        INNER JOIN tb_curso C ON T.id_curso = C.codigo");
        $buscaStatus->execute();

        // Percorre todos os dados do banco para pegar os códigos e status cadastrados
        while($row = $buscaStatus->fetch()) {

            $codigoVerificacao     = $row['pagamento'];
            $status_atual          = $row['status'];
            $curso                 = $row['curso'];
            $pagamento_inscricao   = $row['inscricao'];
            /*$responsavel_inscricao = $row['cd_responsavel_inscricao'];*/
            $turma_curso           = $row['turma'];
            $data                  = date('Y-m-d');

            if($codigoVerificacao != '' || $codigoVerificacao != NULL):
              
            // Define acesso
            header("access-control-allow-origin: https://ws.pagseguro.uol.com.br/v2/");

            // Monta url de requisição ao Paseguro (Rota - Codigo da compra - Email da conta - Token da conta)
            $url = $urlPagseguro.'transactions/'.$codigoVerificacao.'?email='.$emailPagseguro.'&token='.$tokenPagseguro;

            // Inicia a tarefa do curl para buscar xml de retorno do pagseguro
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/xml; charset=UTF-8'));
            $transaction = curl_exec($curl);
            curl_close($curl);

            // Verificar se o acesso retornou "ok"
            if($transaction == 'Unauthorized'){
                //Caso o token ou e-mail não sejam validados pelo PagSeguro.
                echo 'Unauthorized'; 
                exit;
            }

            // Inicia a conversão do xml retornado pelo pagseguro
            $transaction = simplexml_load_string($transaction);
            // https://ws.pagseguro.uol.com.br/v2/transactions/B31DAE6B-E409-4454-9468-E82B1F1F15D2?email=polonio@eslisieux.com.br&token=AC803C0ABCFE4D61B25D452F8FDC63B6
            // echo $url;

            // echo $transaction; exit;
            // $transaction = simplexml_load_string($transaction);

            // Confere se o código é valido
            if($transaction->code !== 0) {
            $transaction_id = $transaction->code;
            $client_id = $transaction->reference;
                // Verifica o tipo de compra que foi realizada
                $payment_type = $transaction->paymentMethod->type;
                if($payment_type == 1){ 
                    $payment_method = "Cartão de crédito";
                } elseif($payment_type == 2){ 
                    $payment_method = "Boleto";
                } elseif($payment_type == 3){ 
                    $payment_method = "Débito online (TEF)"; 
                } else { 
                    $payment_method = "Outro"; 
                }
                // O metódo de compra do produto
                $payment_type_method = $transaction->type;
                if($payment_type_method == 1){ 
                    $payment_method_transiction = "Pagamento";
                } elseif($payment_type_method == 11){ 
                    $payment_method_transiction = "Assinatura";
                } else { 
                    $payment_method_transiction = "Outro"; 
                }

                // Verifica se foi parcelado e em quantas vezes
                $parceled = $transaction->installmentCount;
                $parceled_value = $transaction->installmentFeeAmount;

                $product = $transaction->items->item->id;
                $product_value = $transaction->items->item->amount;

                $transaction_date = date('d/m/Y', strtotime($transaction->date));
                $transaction_date_last = date('d/m/Y', strtotime($transaction->lastEventDate));

                // Pega o status da compra para verificar a situação atual dela. Caso aja um retorno válido, ele faz a atualização das informações no banco

                // Fica a critério escolher o texto que sera cadastrado no banco.
                if($transaction->status == 1){
                    $transaction_status = 'Aguardando pagamento';
                    $status = 1; 
                } elseif($transaction->status == 2){
                    $transaction_status = 'Em análise';
                    $status = 2;
                } elseif($transaction->status == 3){
                    $transaction_status = 'Paga';
                    $status = 3;
                } elseif($transaction->status == 4){
                    $transaction_status = 'Disponível';
                    $status = 4;
                } elseif($transaction->status == 5){
                    $transaction_status = 'Em disputa';
                    $status = 5;
                } elseif($transaction->status == 6){
                    $transaction_status = 'Devolvida';
                    $status = 6;
                } elseif($transaction->status == 7){
                    $transaction_status = 'Cancelada';
                    $status = 7;
                }   
                // Pega o nome do cliente para qual foi feita a compra do produto/serviço para utilizar no cadastro do banco
                $client_name = $transaction->sender->name;

                // Verifica se o status é diferente
                if($codigoVerificacao == $transaction_id) {
                    if($status_atual != $status) {
                        // Faz a inserção no BD com os valores atualizados sobre a compra
                        $update = $conn->prepare("UPDATE `ci_pagamento_inscricao` SET `cd_status_pagamento`= $status WHERE `cd_compra` = '$codigoVerificacao'");
                        $update->execute();

                        if ($update) {
                            echo "[ATT] <br> <b> Cliente Atualizado </b> <br>";
                            echo "Nome: ".$client_name."<br>";
                            echo "Codigo: ".$codigoVerificacao."<br>";
                            echo "Status antigo: ".$status_atual." > Status do PagSseguro: ".$status;
                            if($status == 3){

                                $busca = $conn->prepare("SELECT MAX(id_inscricao) FROM tb_inscricao");
                                $busca->execute();
                                $codigo = $busca->fetchColumn(0);
                                $codigo = $codigo + 1;

                                $productQuery = $conn->prepare("SELECT qtd_horas, qtd_aulas FROM tb_turma WHERE id_curso = ".$product."");
                                $productQuery->execute();
                                while($rows = $productQuery->fetch()) {
                                    $aulas =  $rows['qtd_aulas'];/**/
                                    $horas = $rows['qtd_horas'] * 3600;/* */
                                    /* Se o status da compra estiver concluída, cadastra o aluno no curso e na turma */
                                    $cadastraAluno = $conn->prepare("INSERT INTO `tb_inscricao`(
                                        `id_inscricao`,/**/
                                        `id_aluno`,/**/
                                        `cd_status_conclusao`,
                                        `id_turma`,/**/
                                        `cd_situacao_aluno`,
                                        `cd_responsavel_inscricao`,
                                        `dt_inscricao`,
                                        /*qt_faltas`,*/
                                        `qtd_horas`,/**/
                                        `qtd_aulas`/**/
                                    ) VALUES (
                                        '$codigo',
                                        '$responsavel_inscricao',
                                        '1',
                                        '$turma_curso',
                                        '1',
                                        '$pagamento_inscricao',
                                        '$data',
                                        '0',
                                        '$horas',
                                        '$aulas'
                                    )");
                                    $cadastraAluno->execute();
                                    
                                }
                                
                            }
                            echo "<hr>";
                        } else {
                            echo "ID: ".$client_id;
                            echo "Não atualizou valor <br>";
                        } 
                    } else {
                        echo "[EQUAL] <br> <b> Cliente nao atualizado </b> <br>";
                        echo "Nome: ".$client_name."<br>";
                        echo "Codigo: ".$codigoVerificacao."<br>";
                        echo "Status banco: ".$status_atual." > Status do PagSseguro: ".$status;
                        echo "<hr>";
                    }
                } else {

                }

            } else {
                // Caso o acesso seja inválidado, retorna o código para verificar se ele está correto ou não
                echo $transaction->code;
            }
            endif;
        }


        // function getUserIP()
        // {
        //     $client  = @$_SERVER['HTTP_CLIENT_IP'];
        //     $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        //     $remote  = $_SERVER['REMOTE_ADDR'];

        //     if(filter_var($client, FILTER_VALIDATE_IP))
        //     {
        //         $ip = $client;
        //     }
        //     elseif(filter_var($forward, FILTER_VALIDATE_IP))
        //     {
        //         $ip = $forward;
        //     }
        //     else
        //     {
        //         $ip = $remote;
        //     }

        //     return $ip;
        // }

        // $user_ip = getUserIP();

        //echo "IP do usuário: ".$user_ip; // Output IP address [Ex: 177.87.193.134]
    } else {
        echo "recebeu outro valor";
    }
} else {
    echo "nao recebeu nada";
}
?>
