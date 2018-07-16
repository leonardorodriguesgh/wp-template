<?php

/*if(!isset($_SESSION)) 
    { 	
    	session_start();
    	header('Cache-Control: no cache');
    	session_cache_limiter('private_no_expire');
        echo "nao tem";
    	
    }*/
defined('BASEPATH') OR exit('No direct script access allowed');
	

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $titulo; ?></title>
	<script src="<?php echo site_url('assets')?>/js/vendor/jquery-3.2.1.min.js"></script>
	<script src="<?php echo site_url('assets')?>/js/vendor/bootstrap.min.js"></script>
	<link href="<?php echo site_url('assets')?>/css/vendor/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo site_url('assets')?>/css/login.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-te/1.4.0/jquery-te.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-te/1.4.0/jquery-te.css" rel="stylesheet">
	<script>
		$(document).ready(function(e){
			$('#validateForm > form').submit(function(){
				this.preventDefault()
			});		

		})
		
	</script>

</head>
<body>
		




