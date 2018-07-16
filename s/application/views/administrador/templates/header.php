<?php

if(!isset($_SESSION)) 
    { 	
    	session_start();
    	header('Cache-Control: no cache');
    	session_cache_limiter('private_no_expire');
        echo "nao tem";
    	
    }
defined('BASEPATH') OR exit('No direct script access allowed');
	

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta HTTP-EQUIV="Pragma" content="no-cache"> 
	<meta HTTP-EQUIV="Expires" content="-1">
	<title><?php echo $titulo; ?></title>
	
	<script src="<?php echo site_url('assets')?>/js/vendor/jquery-3.2.1.min.js"></script>
	<script src="<?php echo site_url('assets')?>/js/vendor/bootstrap.min.js"></script>
	<link href="<?php echo site_url('assets')?>/css/vendor/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-te/1.4.0/jquery-te.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-te/1.4.0/jquery-te.css" rel="stylesheet">	
	<link href="<?php echo site_url('assets')?>/css/adm_estilo.css" rel="stylesheet">	
	<script>
		$(document).ready(function(e){
			$('#validateForm > form').submit(function(){
				this.preventDefault()
			});		

		})
		
	</script>

</head>
<body>
	<div class="nav navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myCollapse" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo site_url('a/lista-de-cursos')?>"><img class="img-responsive" src="<?php echo site_url('assets')?>/images/sistema/menu/brand.png" alt="Logo" style="margin-top: -8%;margin-left: 5%;"></a>
			</div>

			<div class="collapse navbar-collapse" id="myCollapse">					
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#" style="padding: 5px 17px"><small>Seja bem vindo </small><strong style="margin-left: 5px;"><?php echo $_SESSION['usuario'];?></strong></a></li><!--IMPLEMENTAR NOME DO USUARIO-->
					<li><a href="#" style="border-left: 1px solid #666; padding: 5px 17px"> Notificações</a></li>
					<li><a href="#" style="padding: 5px 17px"><span class="glyphicon glyphicon-user"></span></a></li>
					<li><a href="<?php echo site_url('login/sair')?>" style="padding: 5px 17px"><span class="glyphicon glyphicon-log-in"></span></a></li>
					
				</ul>
	    	</div><!-- /.navbar-collapse -->
		</div>
	</div>			




