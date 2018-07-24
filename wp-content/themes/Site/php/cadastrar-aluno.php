<?php

if($_POST) :
	if ($_POST == '' || $_POST == null) :
		echo 'situacao 1';
	else :
		if($_POST['nome'] == '' || $_POST['email'] == '' || $_POST['cpf'] == '' || $_POST['cep'] == '' || $_POST['senha'] == '') :
			echo 'situacao 2';
		else :
			$useragent = $_SERVER['HTTP_USER_AGENT'];
			$device  = ( preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))? 'M': 'C';

			$keys = array(
				"6b1628b016dfF46e6fA35684be6aCC96",
				"9dddd5ce1b1375bc497feeb871842d4b",
				"59b1d31e35f630f8157153ad5a545f6a",
				"6bf629fcac0d6c3ee635915aafbd43f5",
				"31dfe57f7402fa4e9f73c4f30ab4b28A",
				"698dc19d489c4e4db73e28a713eab07B",
			);
			
			require("connection.php");
			require ("PHPMailer/PHPMailerAutoload.php");

			if( $_POST['email_'] == null ){

				$form = (object) array(
					'nome'				=> $_POST['nome'],
					'email'				=> $_POST['email'],
					'telefone'			=> $_POST['telefone'],
					'data'				=> $_POST['dataNascimento'],
					'genero'			=> $_POST['genero'],
					'senha'				=> md5($_POST['senha']),
					'cpf'				=> $_POST['cpf'],
					'cep'				=> $_POST['cep'],
					'cidade' 			=> $_POST['cidade'],
					'bairro'			=> $_POST['bairro'],
					'estado'			=> $_POST['estado'],
					'endereco'			=> $_POST['endereco'],
					'numero'			=> $_POST['numero']
				);
				
				try{
					// cd_telefone, dt_nascimento, dt_registro, nm_genero,cd_cpf, cd_cep, nm_cidade, nm_estado, nm_endereco
					$insertUser = $conn->prepare("INSERT INTO  tb_usuario (codigo, perfil, data_cadastro, ativo, nome, email, senha, suspenso, foto, data_modificacao, modificado_por ) 
					VALUES (null, 2, date('d/m/y'), 1, :nome, :email, :senha, 0, 'teste', date('d/m/y'), 1)");//insert aluno / usuario
					$insertUser->bindValue(":nome", $form->nome);
					$insertUser->bindValue(":email", $form->email);
					$insertUser->bindValue(":senha", $form->senha);
					
					if($insertUser->execute() === false){
						echo "<pre>";
						print_r($insertUser->errorInfo());
					}
					$id_usuario = $conn->lastInsertId();
					// Cadastro da data atual
					$insert = $conn->prepare("INSERT INTO  tb_aluno (id_aluno, id_usuario, telefone, dt_ultima_alteracao, id_ultima_alteracao, dt_nascimento, ds_sexo, ds_estado_civil, celular, ds_observacao, rg, cpf, naturalidade,
					 nacionalidade, ativo) 
					 VALUES 
					 (null, :id_usuario,:telefone, date('d/m/y'), 1, :dt_nascimento, :genero, 'solteiro', :telefone, 'teste', 111111111, :cpf, 'teste', 'br', 1)");//insert aluno / usuario
					//$now = new DateTime('America/Sao_Paulo');
					$insert->bindValue(":id_usuario", $id_usuario);
					//$dataRegistro = $now->format('Y-m-d');
					$dataNascimento = implode('-', array_reverse(explode('/', $form->data)));
					$insert->bindValue(":dt_nascimento", $dataNascimento );
					// $insert->bindValue(":dataR", $dataRegistro );
					$insert->bindValue(":genero", isset($form->genero) ? $form->genero  : null );
					$insert->bindValue(":telefone", $form->telefone);
					$insert->bindValue(":cpf", $form->cpf);
					// $insert->bindValue(":cep", $form->cep);
					// $insert->bindValue(":cidade", $form->cidade);
					// $insert->bindValue(":estado", $form->estado);
					// $insert->bindValue(":endereco", $form->endereco);
					//$insert->execute();

					if($insert->execute() === false){
					    echo "<pre>";
					    print_r($insert->errorInfo());
					}

					$id_aluno = lastInsertId();

					$insertUserEndereco = $conn->prepare("INSERT INTO  tb_aluno_endereco (id_aluno_endereco, id_aluno, ativo, cep, endereco, complemento, bairro, cidade, estado, dt_ultima_alteracao, id_ultima_alteracao) 
					VALUES (null, :id_aluno, 1, :cep, :endereco, :numero, :bairro, :cidade, :estado, date('d/m/y'), 1)");//insert aluno / endereco
					$insertUserEndereco->bindValue(":id_aluno", $id_aluno);
					$insertUserEndereco->bindValue(":cep", $form->cep);
					$insertUserEndereco->bindValue(":cidade", $form->cidade);
					$insertUserEndereco->bindValue(":estado", $form->estado);
					$insertUserEndereco->bindValue(":endereco", $form->endereco);
					$insertUserEndereco->bindValue(":bairro", $form->bairro);
					$insertUserEndereco->bindValue(":numero", $form->numero);
					
					if($insertUserEndereco->execute() === false){
						echo "<pre>";
						print_r($insertUser->errorInfo());
					}

				} catch(PDOException $Exception){
					throw new MyDatabaseException( $Exception->getMessage( ) , $Exception->getCode( ) );
				}

				$gid = $conn->prepare(" SELECT MAX(codigo) FROM tb_usuario ");
			    $gid->execute();
			    $cod = $gid->fetchColumn();

				$mensageMail = "<b>Cadastro de Alunos</b><br><br>";
				$mensageMail .= "<table border='0' cellspacing='7' cellpadding='7'>";
				$mensageMail .= "   <tr bgcolor='#F8F8F8'>
				                      
				                         <font face='Arial, Helvetica, sans-serif'>
				                            Dados do Cadastro
				                         </font>
				                      
				                       </tr>
				                  </table>";
				$mensageMail .= "<table border='0' cellspacing='7' cellpadding='7'>";
				$mensageMail .= "   <tr bgcolor='#F8F8F8'>
				                       <td>
				                         <font face='Arial, Helvetica, sans-serif'>
				                           <strong>Nome:</strong>
				                         </font>
				                       </td>
				                       <td>
				                         <font face='Arial, Helvetica, sans-serif'>".$form->nome."</font>
				                       </td>
				                  </tr>";
				$mensageMail .= "   <tr bgcolor='#F8F8F8'>
				                       <td>
				                         <font face='Arial, Helvetica, sans-serif'>
				                           <strong>Email:</strong>
				                         </font>
				                       </td>
				                       <td>
				                         <font face='Arial, Helvetica, sans-serif'>".$form->email."</font>
				                       </td>
				                  </tr>";   
				$mensageMail .= "   <tr bgcolor='#F8F8F8'>
				                       <td>
				                         <font face='Arial, Helvetica, sans-serif'>
				                           <strong>Telefone:</strong>
				                         </font>
				                       </td>
				                       <td>
				                         <font face='Arial, Helvetica, sans-serif'>".$form->telefone."</font>
				                       </td>
				                  </tr>";
				$mensageMail .= "<tr bgcolor='#F8F8F8'>
				                       <td>
				                         <font face='Arial, Helvetica, sans-serif'>
				                           <strong>Data:</strong>
				                         </font>
				                       </td>
				                       <td>
				                         <font face='Arial, Helvetica, sans-serif'>".$form->data."</font>
				                       </td>
				                  </tr>";
				$mensageMail .= "<tr bgcolor='#F8F8F8'>
				                       <td>
				                         <font face='Arial, Helvetica, sans-serif'>
				                           <strong>Gênero:</strong>
				                         </font>
				                       </td>
				                       <td>
				                         <font face='Arial, Helvetica, sans-serif'>".$form->genero."</font>
				                       </td>
				                  </tr>";
				$mensageMail .= "<tr bgcolor='#F8F8F8'>
				                       <td>
				                         <font face='Arial, Helvetica, sans-serif'>
				                           <strong>CPF:</strong>
				                         </font>
				                       </td>
				                       <td>
				                         <font face='Arial, Helvetica, sans-serif'>".$form->cpf."</font>
				                       </td>
				                  </tr>";
				$mensageMail .= "<tr bgcolor='#F8F8F8'>
				                       <td>
				                         <font face='Arial, Helvetica, sans-serif'>
				                           <strong>CEP:</strong>
				                         </font>
				                       </td>
				                       <td>
				                         <font face='Arial, Helvetica, sans-serif'>".$form->cep."</font>
				                       </td>
				                  </tr>";
				$mensageMail .= "<tr bgcolor='#F8F8F8'>
				                       <td>
				                         <font face='Arial, Helvetica, sans-serif'>
				                           <strong>CEP:</strong>
				                         </font>
				                       </td>
				                       <td>
				                         <font face='Arial, Helvetica, sans-serif'>".$form->cidade."</font>
				                       </td>
				                  </tr>";
				$mensageMail .= "<tr bgcolor='#F8F8F8'>
				                       <td>
				                         <font face='Arial, Helvetica, sans-serif'>
				                           <strong>Estado:</strong>
				                         </font>
				                       </td>
				                       <td>
				                         <font face='Arial, Helvetica, sans-serif'>".$form->estado."</font>
				                       </td>
				                  </tr>";
				$mensageMail .= "<tr bgcolor='#F8F8F8'>
				                       <td>
				                         <font face='Arial, Helvetica, sans-serif'>
				                           <strong>Endereco:</strong>
				                         </font>
				                       </td>
				                       <td>
				                         <font face='Arial, Helvetica, sans-serif'>".$form->endereco."</font>
				                       </td>
				                  </tr>";
				$mensageMail .= "</table>";

				$array = array_slice($keys, 0, 3);
				$encode = base64_encode($cod);
				$sorteio= mt_rand(0,5);
				$maskEncode = $keys[$sorteio]."".$encode;

				$mensageClient = "Confirmação Cadastro - Treinamentos Lisieux<br>";
				$mensageClient .= $form->nome.", Seja Bem Vindo(a)<br>";
				$mensageClient .= "
		               Clique ou copie o link abaixo para ativar seu Cadastro<br>
		               <a href='http://lisieuxtreinamento.com.br/confirmacao/aluno/$maskEncode'>
		               		http://lisieuxtreinamento.com.br/confirmacao/aluno/$maskEncode
		               </a>
		          ";

				$mail = new PHPMailer();
				$mail->IsSMTP();
				$mail->Host = "smtp.gmail.com:587";
				$mail->SMTPAuth = TRUE; // Autenticação
				$mail->Username = 'tecnologia@summercomunicacao.com.br';
				$mail->Password = 'tecepw5828';
				$mail->SMTPSecure = "tls";
				$mail->ClearAllRecipients();
				$mail->ClearAttachments();
				$mail->IsHTML(true);
				$mail->CharSet = 'UTF-8';
				$mail->From = "tecnologia@summercomunicacao.com.br"; 
				$mail->FromName = "Grupo Lisiuex";
				$mail->AddAddress('roberta.novaes@summercomunicacao.com.br', 'Grupo Lisieux');
      			// $mail->AddCC('polonio@eslisieux.com.br', 'Polonio Lisieux');
      			// $mail->AddBCC('bcc@summercomunicacao.com.br', 'Summer Comunicacao');
      			
				$mail->Subject  = $device." | Cadastro de Aluno Nº ".$cod." - Treinamentos Lisieux";
				$mail->Body = $mensageMail;
				$mail->AltBody  = $device." | Cadastro de Aluno Nº ".$cod." - Treinamentos Lisieux";

				if (!$mail->Send()) {
					echo $mail->ErrorInfo;
				}else{
					unset($mail);
					$mail = new PHPMailer();
					$mail->IsSMTP();
					$mail->Host = "smtp.gmail.com:587";
					$mail->SMTPAuth = TRUE;
					$mail->Username = 'tecnologia@summercomunicacao.com.br';
					$mail->Password = 'tecepw5828';
					$mail->SMTPSecure = "tls";
					$mail->ClearAllRecipients();
					$mail->ClearAttachments();
					$mail->IsHTML(true);
					$mail->CharSet = 'UTF-8';
					$mail->From = "tecnologia@summercomunicacao.com.br"; 
					$mail->FromName = "Grupo Lisiuex";
					$mail->AddAddress($form->email, 'Reply to '.$form->nome.'');
					$mail->Subject  = "Confirmação Cadastro Treinamentos Lisieux";
					$mail->Body = $mensageClient;
					$mail->AltBody  = "Confirmação Cadastro Treinamentos Lisieux";

					if (!$mail->Send()) {
						echo $mail->ErrorInfo;
					}
				}
				

			}
			echo $encode;
		endif;
	endif;
endif;


 ?>