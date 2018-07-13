<?

require("connection.php");

$array = array();

if(isset($_POST['email'])) {
	$email = $_POST['email'];

	$busca_user = $conn->prepare("SELECT * FROM ci_aluno WHERE nm_email = :email AND ic_ativo = 1");
	$busca_user->bindValue(':email', $email);
	$busca_user->execute();	
 	
 	if($busca_user->rowCount() > 0):
		while($row = $busca_user->fetch(PDO::FETCH_ASSOC)){

			$array[] = array(
				"codigo"		=> $row['cd_aluno'],
				"nome" 			=> $row['nm_aluno'],
				"email"			=> $row['nm_email'],
				"telefone"		=> $row['cd_telefone'],
				"cpf"			=> $row['cd_cpf'],
				"cidade"		=> $row['nm_cidade'],
				"cep"			=> $row['cd_cep'],
				"endereco"		=> $row['nm_endereco'],
				"estado"		=> $row['nm_estado'],
				"bairro"		=> "Teste",
				"numero"		=> "123",
				"complemento"	=> "Complemento",
				// "foto_perfil"	=> $row['nm_url_foto_perfil']

			);
		}
		echo json_encode($array);
 	else:
 	// 	$busca_patrocinador = $conn->prepare("SELECT * FROM ci_patrocinador WHERE nm_email = :email AND ic_ativo = 1");
		// $busca_patrocinador->bindValue(':email', $email);
		// $busca_patrocinador->execute();		
 	// 	while($row = $busca_patrocinador->fetch(PDO::FETCH_ASSOC)){

		// 	$array[] = array(
		// 		"id"   		=> $row['cd_patrocinador'],
		// 		"nome" 		=> $row['nm_patrocinador'],
		// 	);
		// }
		// echo json_encode($array);
 	endif;
} 	
	
?>


