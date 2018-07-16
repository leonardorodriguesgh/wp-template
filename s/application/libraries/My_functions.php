<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_functions {

	function generate_pwd($intQtdCaracter = 10){
		$token = "";            
	    for($x=0;$x<($intQtdCaracter+1);$x++){
	       $numAleatorio = rand(0,2);
	       if($numAleatorio == 1){
	        $token .= chr(rand(65,90));
	       }
	       elseif($numAleatorio == 2){
	        $token .= chr(rand(97,122));
	       }
	       else{
	       $token .= rand(0,10);
	        }
	       }
	    return $token;
	}

	function limpa_str($str){
	    $c = array('Ç', 'ç');
	    $a = array('Á', 'À', 'Ä', 'Â', 'Ã', 'á', 'à', 'ä', 'â', 'â', 'ã');
	    $e = array('Ë', 'É', 'Ê', 'ë', 'é', 'ê' , '&');
	    $i = array('Ï', 'Í', 'ï', 'í');
	    $o = array('Ö', 'Ó', 'Ô', 'Õ', 'ö', 'ó', 'ô', 'õ');
	    $u = array('Ü', 'Ú', 'ü', 'ú');
	    return str_replace('(', '', str_replace(')', '', str_replace('/', '', str_replace($c, 'c', str_replace($a, 'a', str_replace($e, 'e', str_replace($i, 'i', str_replace($o, 'o', str_replace($u, 'u', str_replace(' ', '-', $str))))))))));
 	}

 	function formatar_data($data){
 		return ( $data == '' )? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', strtotime( str_replace("/", "-", $data ) ) );
 	}

 	function formatar_cpf($cpf){
 		return  str_replace(".", "",str_replace("-", "", $cpf ) );
 	}

 	function formatar_moeda($moeda){
 		return  str_replace(",", ".",str_replace(".", "",str_replace("R$", "", $moeda ) ) );
 	}

	function formatar_celular( $celular ){
		return '55'.str_replace("(", "",str_replace(")", "",str_replace(".", "",str_replace(" ", "", $celular ) ) ) );
	}

	function checktime($horario) {

		$horario = str_split($horario, 2);
		
	    if ( !array_key_exists( 0, $horario ) || $horario[0] < 0 || $horario[0] > 23 || !is_numeric($horario[0])) {
	        return false;
	    }
	    if ( !array_key_exists( 1, $horario ) || $horario[1] < 0 || $horario[1] > 59 || !is_numeric($horario[1])) {
	        return false;
	    }
	    return true;

	}
 
	function retorna_dias($dia){
		switch ($dia) {
			case 'Mon':
				return 'SEGUNDA';
				break;

			case 'Tue':
				return 'TERÇA';
				break;

			case 'Wed':
				return 'QUARTA';
				break;

			case 'Thu':
				return 'QUINTA';
				break;

			case 'Fri':
				return 'SEXTA';
				break;

			case 'Sat':
				return 'SÁBADO';
				break;
			
			default:
				return 'DOMINGO';
				break;
		}
 	}

 	function validar_cpf($cpf = null) {
 	
 		$cpf = str_replace(".", "", $cpf );
 		$cpf = str_replace("-", "", $cpf );

	    // Verifiva se o número digitado contém todos os digitos
	    $cpf = str_pad(preg_replace('/[^0-9]/', '', $cpf), 11, '0', STR_PAD_LEFT);
	 
	    // Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
	    if (strlen($cpf) != 11 ||
	        $cpf == '00000000000' ||
	        $cpf == '11111111111' ||
	        $cpf == '22222222222' ||
	        $cpf == '33333333333' ||
	        $cpf == '44444444444' ||
	        $cpf == '55555555555' ||
	        $cpf == '66666666666' ||
	        $cpf == '77777777777' ||
	        $cpf == '88888888888' ||
	        $cpf == '99999999999') {
	        return FALSE;
	    } else {
	        // Calcula os números para verificar se o CPF é verdadeiro
	        for ($t = 9; $t < 11; $t++) {
	            for ($d = 0, $c = 0; $c < $t; $c++) {
	                $d += $cpf{$c} * (($t + 1) - $c);
	            }
	 
	            $d = ((10 * $d) % 11) % 10;
	            if ($cpf{$c} != $d) {
	                return FALSE;
	            }
	        }
	        return TRUE;
	    }

	}

	function enviar_email( $configuracao ) {

		require_once('PHPMailer/PHPMailerAutoload.php');

		$mail = new PHPMailer();

		//Define os dados do servidor e tipo de conexão

		$mail->IsSMTP(); // Define que a mensagem será SMTP
		$mail->Host = "smtp.gmail.com:587"; // Endereço do servidor SMTP
		$mail->SMTPAuth = TRUE; // Autenticação
		$mail->Username = GMAIL_ACCOUNT; // Usuário do servidor SMTP
		$mail->Password = GMAIL_PASSWPRD; // Senha da caixa postal utilizada
		$mail->SMTPSecure = "tls";

		//Define os replay to)
		foreach ($configuracao['replayto'] as $k => $v) {
			$mail->AddReplyTo( $v['email'] , $v['nome'] );
		}

		//Define o remetente
		$mail->From = $configuracao['remetente']['email']; 
		$mail->FromName = $configuracao['remetente']['nome']; 

		//Define os destinatário(s)
		foreach ($configuracao['destinatarios'] as $k => $v) {
			$mail->AddAddress( $v['email'] , $v['nome'] );
		}
		
		//Define os dados técnicos da Mensagem
		$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
		$mail->CharSet = 'UTF-8'; // Charset da mensagem (opcional)

		$msg  = "<table border='0' cellspacing='7' cellpadding='7'>"; 
		$msg .= "<tr bgcolor='#F8F8F8'><td colspan='2'>".$configuracao['titulo']."</td></tr>"; 

			foreach ( $configuracao['dados'] as $k => $v ) {
				
				$msg .= "<tr bgcolor='#F8F8F8'>	<td> <font face='Arial, Helvetica, sans-serif'> <strong>".$k."</strong>	</font>	</td> <td> <font face='Arial, Helvetica, sans-serif'>".$v."</font> </td> </tr>";
				
			}

		$msg .= "</table>";
	    

	    //Texto e Assunto
		$mail->Subject = $configuracao['assunto']; // Assunto da mensagem
		$mail->Body = $msg;

		//Envio da Mensagem
		$enviado = $mail->Send();

		//Limpa os destinatários e os anexos
		$mail->ClearAllRecipients();
		$mail->ClearAttachments();

	}

	function enviar_imagem( $sistema, $caminho, $arquivo, $largura, $altura) {

		include('Canvas.php');	

		$config['upload_path']   = $_SERVER['DOCUMENT_ROOT'].$sistema.$caminho;
		$config['allowed_types'] = '*';	
		$config['encrypt_name']  = TRUE;

		$CI =& get_instance();
		$CI->load->library('upload', $config);

		$res = array();

		$_FILES['userfile']['name']     = $arquivo['file']['name']; 
	    $_FILES['userfile']['type']     = $arquivo['file']['type'];
	    $_FILES['userfile']['tmp_name'] = $arquivo['file']['tmp_name'];
	    $_FILES['userfile']['error']    = $arquivo['file']['error'];
	    $_FILES['userfile']['size']     = $arquivo['file']['size'];   

		if ( ! $CI->upload->do_upload() )
		{
		    $res[] = $CI->upload->display_errors('', '');
			//$res = array();
		}
		else
		{
		
			$upload_data = $CI->upload->data(); 

			//para montar os thumbs 
			
			if( $arquivo['file']['type'] == 'png|jpg'){
				$img = new Canvas();
				$img->hexa( '#FFFFFF' )
					->novaImagem( $largura, $altura )
					->marca( $config['upload_path'] .'/'. $upload_data['file_name'], 'meio', 'centro' )
				    ->grava( substr($config['upload_path'] .'/'. $upload_data['file_name'] , 0, -4) .  '_thumb.jpg' );
	
				$img = null;    				
			}
			$res = array('url' => $caminho.'/'.$upload_data['file_name'] , 'image' => substr($upload_data['file_name'] , 0, -4) );
		}

		return $res;

	}

}