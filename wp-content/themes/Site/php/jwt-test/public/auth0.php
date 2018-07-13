<?php
chdir(dirname(__DIR__));

require_once('vendor/autoload.php');

use Zend\Config\Config;
use Zend\Config\Factory;
use Zend\Http\PhpEnvironment\Request;
use Firebase\JWT\JWT;

$config = Factory::fromFile('config/config.php', true);

if($_POST['token']){
    /* Teste: Remover depois */
    $host_name = "mysql.lisieuxtreinamento.com.br";
    $database = "lisieuxtreinam";
    $user     = "lisieuxtreinam";
    $password = "fc219fb31";
    /* Teste: Remover depois */

    $conn = new PDO('mysql:host='.$host_name.';dbname='.$database,$user,$password);

    $jwt = $_POST['token'];

    $secretKey = base64_decode($config->get('jwt')->get('key'));

    $token = JWT::decode($jwt, $secretKey, array($config->get('jwt')->get('algorithm')));

    // header('Content-type: application/json');
    // echo json_encode($token);
    $array = (array) $token;
    // $array = json_decode($token, true);
    // echo "<pre>";
    // print_r($array);

    $usuario = $array[0]->data->userName;
    $typeUser = 'studant';

    session_teste($usuario, $typeUser);

    // if( $typeUser == "studant") {
    //     $sql = "SELECT cd_aluno as id, nm_email as email, nm_aluno as nome, nm_url_foto_perfil as foto FROM ci_aluno WHERE nm_email = '".$usuario."' AND ic_ativo = 1"; 
    // }
    // else {
    //     $sql = "SELECT cd_patrocinador as id, nm_email as email, nm_patrocinador as nome, nm_url_foto_perfil as foto FROM ci_patrocinador WHERE nm_email = '".$usuario."' AND ic_ativo = 1";
    // }

    // $select = $conn->prepare($sql);
    // $select->execute();
   
    // if($select->rowCount() > 0) {
    //     while($row = $select->fetch(PDO::FETCH_ASSOC)){
          
    //         $wp_session = WP_Session::get_instance();

    //         if(isset( $wp_session )){
    //             $wp_session['UserID'] = $row['id'];
    //             $wp_session['UserLogin'] = $row['email'];
    //             $wp_session['UserName'] = $row['nome'];
    //             $wp_session['UserFoto'] = $row['foto'];
    //             $wp_session['typeUser'] = $typeUser;
    //         }
    //         return true;
              
    //     } 
    // } else {
    //     return "não houve resultado";
    // } 

}





// $request = new Request();

// if ($request->isGet()) {
//     $authHeader = $request->getHeader('authorization');

//     if ($authHeader) {

//         list($jwt) = sscanf( $authHeader->toString(), 'Authorization: Bearer %s');

//         if ($jwt) {
//             try {
//                 $config = Factory::fromFile('config/config.php', true);

//                 $secretKey = base64_decode($config->get('jwt')->get('key'));
                
//                 $token = JWT::decode($jwt, $secretKey, array($config->get('jwt')->get('algorithm')));

//                 $auth = true;

                // header('Content-type: application/json');
                // echo json_encode($auth);

//             } catch (Exception $e) {
    
//                 header('HTTP/1.0 401 Unauthorized');
//             }
//         } else {
         
//             header('HTTP/1.0 400 Bad Request');
//         }
//     } else {
  
//         header('HTTP/1.0 400 Bad Request');
//         echo 'Token not found in request';
//     }
// } else {
//     header('HTTP/1.0 405 Method Not Allowed');
// }



// Guardar o token para verificar se ja existe um logado