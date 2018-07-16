<?php  /* Template Name: Autenticar */?>
<?php  /* Pública */ ?>
<?php 
$link = mysqli_connect("localhost", "root", "", "lisieux_treinamento");

mysqli_set_charset($link,"utf8");

require_once('php/jwt-test/vendor/autoload.php');
use Firebase\JWT\JWT;

$wp_session = WP_Session::get_instance();
print_r($wp_session['UserID']);
// if(!session_init()) : 
if($wp_session['UserID'] == null):
	// echo "Sessão Falhou";

	if($_POST['token']){
		// echo $_POST['token'];

    	$jwt = $_POST['token'];

    	$secretKey = base64_decode('teste');

    	$token = JWT::decode($jwt, $secretKey, array('HS512'));

    	$array = (array) $token;

    	$usuario = $array[0]->data->userName;
    	$typeUser = $array[0]->data->tipo;

    	// $_POST['user'] = $usuario;
    	// $_POST['typeUser'] = $typeUser;

	    if( $typeUser == "studant"){
	          $sql = "SELECT cd_aluno as id, nm_email as email, nm_aluno as nome, nm_url_foto_perfil as foto FROM ci_aluno WHERE nm_email = '".$usuario."' AND ic_ativo = 1";
	    }else{
	          $sql = "SELECT cd_patrocinador as id, nm_email as email, nm_patrocinador as nome, nm_url_foto_perfil as foto FROM ci_patrocinador WHERE nm_email = '".$usuario."' AND ic_ativo = 1";
	        }
	     $query = mysqli_query($link, $sql);

	     if (mysqli_num_rows($query) > 0) {
	          
	          $row = mysqli_fetch_assoc($query);
	          
	          $wp_session = WP_Session::get_instance();

	          	if(isset( $wp_session )){
	               	$wp_session['UserID'] = $row['id'];
	               	$wp_session['UserLogin'] = $row['email'];
	               	$wp_session['UserName'] = $row['nome'];
	               	$wp_session['UserFoto'] = $row['foto'];
	               	$wp_session['typeUser'] = $typeUser;
					$cookie_name = "token";
					$cookie_value = $_POST['token'];

					setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/",'http://cursos.lisieuxtreinamento.com.br/',true,true); // 86400 = 1 day
					$telaRedirect = $_POST['tela'];
					echo '<script> window.location.href = <?php php echo $telaRedirect; ?> </script>';

	          	}
	          return true;
	          
	    } else {
	          return "não houve resultado";
	    } 
	} else {
		if($_POST['email'] && $_POST['tipo']) {

	    	$usuario = $_POST['email'];
	    	$typeUser = $_POST['tipo'];
	    	
		    if( $typeUser == "studant")
		        $sql = "SELECT cd_aluno as id, nm_email as email, nm_aluno as nome, nm_url_foto_perfil as foto FROM ci_aluno WHERE nm_email = '".$usuario."' AND ic_ativo = 1"; 
		    else
		        $sql = "SELECT cd_patrocinador as id, nm_email as email, nm_patrocinador as nome, nm_url_foto_perfil as foto FROM ci_patrocinador WHERE nm_email = '".$usuario."' AND ic_ativo = 1";

		    $query = mysqli_query($link, $sql);

		    if (mysqli_num_rows($query) > 0) {
		          
		          $row = mysqli_fetch_assoc($query);
		          
		          $wp_session = WP_Session::get_instance();

		          	if(isset( $wp_session )){
		               	$wp_session['UserID'] = $row['id'];
		               	$wp_session['UserLogin'] = $row['email'];
		               	$wp_session['UserName'] = $row['nome'];
		               	$wp_session['UserFoto'] = $row['foto'];
		               	$wp_session['typeUser'] = $typeUser;
						$cookie_name = "token";
						$cookie_value = $_COOKIE['token'];
						setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/", NULL, 0); // 86400 = 1 day
						echo '<script> window.location.href = "'.$_POST['tela'].'" </script>';
		          	}
		          return true;
		          
		    } else {
		        return "não houve resultado";
		    } 
		} else {
			echo "erro";
		}
	}
else :
	$wp_session = WP_Session::get_instance();
	header("Location: /wordpress");

endif;

?>





