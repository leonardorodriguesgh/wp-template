<?php
chdir(dirname(__DIR__));
require_once('vendor/autoload.php');

// Carrega o framework Zend para manipulação em cima do JWT
use Zend\Config\Factory;
use Zend\Http\PhpEnvironment\Request;
use Firebase\JWT\JWT;

// Cria um novo objeto de requisição
$request = new Request();

// Se a requisição exisitir e vier como post
if ($request->isPost()) {
    
    $config = Factory::fromFile('config/config.php', true);

    $codigo = $_POST['codigo'];
    $username = $_POST['username'];
    $tipo = $_POST['tipo'];
    

    if ($username && $codigo) {
        try {
            $tokenId    = base64_encode(openssl_random_pseudo_bytes(32));
            $issuedAt   = time();
            $notBefore  = $issuedAt + 10; 
            $expire     = $notBefore + 60; 
            $serverName = $config->get('serverName');
            
            $data[] = array(
                'iat'  => $issuedAt,         
                // 'jti'  => $tokenId,         
                // 'iss'  => $serverName,      
                // 'nbf'  => $notBefore,       
                // 'exp'  => $expire,          
                'data' => array(               
                    'userId'   => $codigo, 
                    'userName' => $username, 
                    'tipo' => $tipo, 
                )
            );
            
            header('Content-type: application/json');
            
            $secretKey = base64_decode($config->get('jwt')->get('key'));
            
            $algorithm = $config->get('jwt')->get('algorithm');
            
            $jwt = JWT::encode(
                $data,      
                $secretKey,
                $algorithm  
                );
            
            // Cadastra no banco o Token gerado
            try{
                $conn = new PDO('mysql:host='.$config->get('database')->get('host').';dbname='.$config->get('database')->get('name'),$config->get('database')->get('user'),$config->get('database')->get('password'));
                
                $select = $conn->prepare("SELECT `nm_token` FROM `ci_session_token` WHERE nm_token = '".$jwt."'");
                $select->execute();

                if($select->rowCount() > 0) {
                    echo false;
                } else {
                    $insert = $conn->prepare("INSERT INTO `ci_session_token`(`nm_token`) VALUES ('".$jwt."')");
                    $insert->execute();
                    echo json_encode($jwt);
                }                

            }catch(PDOException $e){
                print "Error: ".$e->getMessage()."<br/>";
            }
            
        } catch (Exception $e) {
            header('HTTP/1.0 500 Internal Server Error');
        }
    } else {
        header('HTTP/1.0 400 Bad Request');
    }
} else {
    header('HTTP/1.0 405 Method Not Allowed');
}