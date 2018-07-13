<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<?php
   if($_POST['email_'] != '')
   {
    ?>

    <script>
      // alert("Mensagem Enviada Com Sucesso!");
    </script>
<?php

   } 
   else 
   {
      require("class/phpmailer.php");
      include('connection.php');

      $form = (object) array(
        'nome'      => $_POST['nome'],
        'email'     => $_POST['email'],
        'mensagem'  => $_POST['mensagem'],
        'device'    => $_POST['device']
      );
       
      $data   = date("d/m/Y");
      $dataSql = date('Y-m-d');
      $hora = date('H:i');
 
      try{

        $stmt = $conn->prepare(" INSERT INTO tb_indicacao (nm_nome, nm_email, nm_mensagem, dt_registro, hr_registro, sg_device) VALUES (:nome, :email, :mensagem, :data, :hora, :device) ");

        $stmt->bindValue(':nome',$form->nome);
        $stmt->bindValue(':email',$form->email);
        $stmt->bindValue(':mensagem',$form->mensagem);
        $stmt->bindValue(':data',$dataSql);
        $stmt->bindValue(':hora',$hora);
        $stmt->bindValue(':device',$form->device);

        $stmt->execute();

        $gid = $conn->prepare(" SELECT MAX(id) FROM `tb_indicacao` ");
        $gid->execute();
        $getid = $gid->fetchColumn();

      }catch(PDOException $Exception ) {

        throw new MyDatabaseException( $Exception->getMessage( ) , $Exception->getCode( ) );
      }

    
      $msgToAdmin = "
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
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'><strong>Nome:</strong></font> 
                         </td>
                         <td colspan='6'>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>$form->nome</font>
                         </td>
                    </tr>
                    
                    <tr bgcolor='#F8F8F8'>
                         <td>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'><strong>Telefone:</strong></font>
                         </td>
                         <td colspan='6'>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>$form->telefone</font>
                         </td>
                    </tr>

                    <tr bgcolor='#F8F8F8'>
                         <td>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'><strong>E-mail:</strong></font>
                         </td>
                         <td colspan='6'>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>$form->email</font>
                         </td>
                    </tr>

                    <tr bgcolor='#F8F8F8'>
                         <td>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'><strong>CEP:</strong></font>
                         </td>
                         <td colspan='6'>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>$form->cep</font>
                         </td>
                    </tr>

                    <tr bgcolor='#F8F8F8'>
                         <td>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'><strong>Cidade:</strong></font>
                         </td>
                         <td colspan='6'>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>$form->cidade</font>
                         </td>
                    </tr>

                    <tr bgcolor='#F8F8F8'>
                         <td>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'><strong>Estado:</strong></font>
                         </td>
                         <td colspan='6'>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>$form->estado</font>
                         </td>
                    </tr>

                    <tr bgcolor='#F8F8F8'>
                         <td>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'><strong>Endereco:</strong></font>
                         </td>
                         <td colspan='6'>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>$form->endereco</font>
                         </td>
                    </tr>";

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
      
      $mail->AddAddress('treinamento@eslisieux.com.br', 'Grupo Lisieux');
      $mail->AddBCC('bcc@summercomunicacao.com.br', 'Summer Comunicacao');

      $mail->AddReplyTo($form->email, 'Reply to '.$form->nome.'');
      

      //Define os dados técnicos da Mensagem
      $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
      $mail->CharSet = 'UTF-8'; // Charset da mensagem (opcional)

      //Texto e Assunto
      $mail->Subject  = "".$form->device." | Treinamento Lisieux: Secretária Nº ".$getid." - Indicação do Curso"; // Assunto da mensagem
      $mail->Body = $msgToAdmin;
      $mail->AltBody  = "".$form->device." | Treinamento Lisieux: Secretária Nº ".$getid." - Indicação do Curso";

      //Envio da Mensagem
      $enviado = $mail->Send();

      //Limpa os destinatários e os anexos
      $mail->ClearAllRecipients();
      $mail->ClearAttachments();

      if($enviado){
           echo "Mensagem Enviada com Sucesso";
           
      }else{
           echo "Desculpe, ocorreu algum problema, tente mais tarde";
      }              
   }
?>