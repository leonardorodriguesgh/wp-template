<?php
require("connection.php");
require("class/phpmailer.php");

$info = (object) array(
	"inscricao"     => $_POST['inscricao'],
	"patrocinador"  => $_POST['patrocinador'],
	"status"        => $_POST['status'],
	"vl_parcelas"   => $_POST['vl_parcelas'],
	"qt_parcelas"   => $_POST['qt_parcelas'],
	"pago"      	=> $_POST['pago'],
	"total"   		=> $_POST['total'],
	"forma"			=> $_POST['forma'],
	"codigo"  		=> $_POST['codigo'],
	"info"   		=> $_POST['info'],
	"codProduto"    => $_POST['codProduto'],
	"usuario"    	=> $_POST['usuario'],
	"email"    		=> $_POST['email'],
	"nome"    		=> $_POST['nome'],
	"cpf"    		=> $_POST['cpf'],
	"telefone"    	=> $_POST['telefone'],
	"cep"    		=> $_POST['cep'],
	"endereco"    	=> $_POST['endereco'],
	"numero"    	=> $_POST['numero'],
	"complemento"   => $_POST['complemento'],
	"bairro"   		=> $_POST['bairro'],
	"cidade"   		=> $_POST['cidade'],
	"estado"   		=> $_POST['estado'],
	"pais"   		=> $_POST['pais'],
    "curso"         => $_POST['curso'],
	"turma"    		=> $_POST['turma']
);


$busca = $conn->prepare("SELECT MAX(id_pagamento) FROM tb_pagamento");
$busca->execute();
$codigo = $busca->fetchColumn(0);
$codigo = $codigo + 1;
// responsavel, patrocinador `vl_parcelas`, `qt_parcelas`, `vl_pago`, `cd_compra_info`, `cd_curso`, `cd_turma_curso`
$insert = $conn->prepare("INSERT INTO tb_pagamento( id_pagamento, id_inscricao, vl_inscricao, ds_forma_pag, id_status_pag, dt_ultima_alteracao, id_ultima_alteracao, ativo,
 vencimento, cd_transacao, total_transacao) 
VALUES (null, $info->inscricao,  $info->vl_parcelas, '$info->forma', $info->status, date('Y-m-d'), 1, 1, date('Y-m-d'), '$info->codigo', $info->codProduto)");

$insert->execute();



if (!$insert->fetch()) {

	$data   = date("d/m/Y");
	$hora = date('H:i');

	$msgPagante = "
               <table border='0' cellspacing='7' cellpadding='7'>
                    <tr bgcolor='#F8F8F8'>
                         <td colspan='7'>
                              <center>
                                   <font face='Verdana, Arial, Helvetica, sans-serif' size='3'>
                                        <strong>Inscrição Online</strong>
                                   </font>
                              </center>
                         </td>
                    </tr>

                    <tr bgcolor='#F8F8F8'>
                         <td>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>
                                   <strong>Data:</strong>
                              </font> 
                         </td>
                         <td colspan='6'>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>$data</font>
                         </td>
                    </tr>

                    <tr bgcolor='#F8F8F8'>
                         <td>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>
                                   <strong>Hora:</strong>
                              </font> 
                         </td>
                         <td colspan='6'>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>$hora</font>
                         </td>
                    </tr>
                    
                    <tr bgcolor='#F8F8F8'>
                         <td>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>
                                   <strong>Curso:</strong>
                              </font> 
                         </td>
                         <td colspan='6'>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>$info->curso</font>
                         </td>
                    </tr>

                    <tr bgcolor='#F8F8F8'>
                         <td>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>
                                   <strong>Usuario:</strong>
                              </font> 
                         </td>
                         <td colspan='6'>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>$info->usuario</font>
                         </td>
                    </tr>

                    <tr bgcolor='#F8F8F8'>
                         <td>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>
                                   <strong>Email:</strong>
                              </font> 
                         </td>
                         <td colspan='6'>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>$info->email</font>
                         </td>
                    </tr>

                    <tr bgcolor='#F8F8F8'>
                         <td>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>
                                   <strong>Nome:</strong>
                              </font> 
                         </td>
                         <td colspan='6'>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>$info->nome</font>
                         </td>
                    </tr>

                    <tr bgcolor='#F8F8F8'>
                         <td>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>
                                   <strong>CPF:</strong>
                              </font> 
                         </td>
                         <td colspan='6'>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>$info->cpf</font>
                         </td>
                    </tr>

                    <tr bgcolor='#F8F8F8'>
                         <td>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>
                                   <strong>Telefone:</strong>
                              </font> 
                         </td>
                         <td colspan='6'>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>$info->telefone</font>
                         </td>
                    </tr>

                    <tr bgcolor='#F8F8F8'>
                         <td>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>
                                   <strong>Cep:</strong>
                              </font> 
                         </td>
                         <td colspan='6'>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>$info->cep</font>
                         </td>
                    </tr>

                    <tr bgcolor='#F8F8F8'>
                         <td>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>
                                   <strong>Endereco:</strong>
                              </font> 
                         </td>
                         <td colspan='6'>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>$info->endereco</font>
                         </td>
                    </tr>

                    <tr bgcolor='#F8F8F8'>
                         <td>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>
                                   <strong>Numero:</strong>
                              </font> 
                         </td>
                         <td colspan='6'>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>$info->numero</font>
                         </td>
                    </tr>

                    <tr bgcolor='#F8F8F8'>
                         <td>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>
                                   <strong>complemento:</strong>
                              </font> 
                         </td>
                         <td colspan='6'>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>$info->complemento</font>
                         </td>
                    </tr>

                    <tr bgcolor='#F8F8F8'>
                         <td>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>
                                   <strong>Bairro:</strong>
                              </font> 
                         </td>
                         <td colspan='6'>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>$info->bairro</font>
                         </td>
                    </tr>

                     <tr bgcolor='#F8F8F8'>
                         <td>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>
                                   <strong>Cidade:</strong>
                              </font> 
                         </td>
                         <td colspan='6'>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>$info->cidade</font>
                         </td>
                    </tr>

                    <tr bgcolor='#F8F8F8'>
                         <td>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>
                                   <strong>Estado:</strong>
                              </font> 
                         </td>
                         <td colspan='6'>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>$info->estado</font>
                         </td>
                    </tr>

                    <tr bgcolor='#F8F8F8'>
                         <td>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>
                                   <strong>Pais:</strong>
                              </font> 
                         </td>
                         <td colspan='6'>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>$info->pais</font>
                         </td>
                    </tr>

                </table>

               <p> Sua inscrição foi concluída, aguarde a confirmação do pagamento para mais informações.</p>
				";

		$mail = new PHPMailer();

      //Define os dados do servidor e tipo de conexão

      $mail->IsSMTP(); // Define que a mensagem será SMTP
      $mail->Host = "smtp.gmail.com:587"; // Endereço do servidor SMTP
      $mail->SMTPAuth = true; // Autenticação
      $mail->Username = 'tecnologia@summercomunicacao.com.br'; // Usuário do servidor SMTP
      $mail->Password = 'tecepw5828'; // Senha da caixa postal utilizada
      $mail->SMTPSecure = 'tls';    // SSL REQUERIDO pelo GMail

      //Define o remetente
      $mail->From = "tecnologia@summercomunicacao.com.br";
      $mail->FromName = "Grupo Lisieux";
      
      $mail->AddAddress('roberta.novaes@summercomunicacao.com.br', 'Grupo Lisieux');
      $mail->AddAddress($info->email, $info->nome);
      // $mail->AddBCC('bcc@summercomunicacao.com.br', 'Summer Comunicacao');

      $mail->AddReplyTo($info->email, 'Reply to '.$info->nome.'');


      //Define os dados técnicos da Mensagem
      $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
      $mail->CharSet = 'UTF-8'; // Charset da mensagem (opcional)

      //Texto e Assunto
      $mail->Subject  = "Treinamento Lisieux | Confirmação de Inscrição Nº".$codigo; // Assunto da mensagem
      $mail->Body = $msgPagante;
      $mail->AltBody  = "Treinamento Lisieux | Confirmação de Inscrição Nº".$codigo;

      //Envio da Mensagem
      $enviado = $mail->Send();

      //Limpa os destinatários e os anexos
      $mail->ClearAllRecipients();
      $mail->ClearAttachments();

      if($enviado){
           echo true;
           
      }else{
           echo false;
      }  

    echo true;
} else {
    echo false;
}

?>