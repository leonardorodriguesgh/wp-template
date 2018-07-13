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

      $useragent = $_SERVER['HTTP_USER_AGENT'];
      $device  = ( preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))? 'M': 'C';


      require("class/phpmailer.php");
      include('connection.php');

      $form = (object) array(
        'nome'      => $_POST['txt_nome'],
        'telefone'  => $_POST['txt_telefone'],
        'email'     => $_POST['txt_email'],
        'assunto'   => $_POST['txt_assunto'],
        'mensagem'  => $_POST['txt_mensagem']
      );
       
      $data   = date("d/m/Y");
      $dataSql = date('Y-m-d');
      $hora = date('H:i');
 
      try{

        $stmt = $conn->prepare(" INSERT INTO tb_contato (nm_nome, cd_telefone, nm_email, nm_assunto, ds_mensagem, dt_registro, hr_registro, sg_device) VALUES (:nome, :telefone, :email, :assunto, :mensagem, :data, :hora, :device) ");

        $stmt->bindValue(':nome',$form->nome);
        $stmt->bindValue(':telefone',$form->telefone);
        $stmt->bindValue(':email',$form->email);
        $stmt->bindValue(':assunto',$form->asusnto);
        $stmt->bindValue(':mensagem',$form->mensagem);
        $stmt->bindValue(':data',$dataSql);
        $stmt->bindValue(':hora',$hora);
        $stmt->bindValue(':device',$device);

        $stmt->execute();

        $gid = $conn->prepare(" SELECT MAX(id) FROM `tb_contato` ");
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
                                        <strong>Formulário de contato</strong>
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
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'><strong>Assunto:</strong></font>
                         </td>
                         <td colspan='6'>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>$form->assunto</font>
                         </td>
                    </tr>

                    <tr bgcolor='#F8F8F8'>
                         <td>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'><strong>Mensagem:</strong></font>
                         </td>
                         <td colspan='6'>
                              <font face='Verdana, Arial, Helvetica, sans-serif' size='2'>$form->mensagem</font>
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
      
      // $mail->AddAddress('fernando.gomes@summercomunicacao.com.br', 'Grupo Lisieux');
      // $mail->AddCC('polonio@eslisieux.com.br', 'Polonio Lisieux');
      $mail->AddAddress('treinamento@eslisieux.com.br', 'Grupo Lisieux');
      $mail->AddBCC('bcc@summercomunicacao.com.br', 'Summer Comunicacao');

      $mail->AddReplyTo($form->email, 'Reply to '.$form->nome.'');
      

      //Define os dados técnicos da Mensagem
      $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
      $mail->CharSet = 'UTF-8'; // Charset da mensagem (opcional)

      //Texto e Assunto
      $mail->Subject  = "".$device." | Treinamento Lisieux: Contato Nº ".$getid." "; // Assunto da mensagem
      $mail->Body = $msgToAdmin;
      $mail->AltBody  = "".$device." | Treinamento Lisieux: Contato Nº ".$getid." ";

      //Envio da Mensagem
      $enviado = $mail->Send();

      //Limpa os destinatários e os anexos
      $mail->ClearAllRecipients();
      $mail->ClearAttachments();

      if($enviado){
           echo "1";
           
      }else{
           echo "0";
      }              
   }
?>