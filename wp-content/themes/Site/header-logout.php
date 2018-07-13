<!DOCTYPE html>
<html>
<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <? wp_head(); ?>

    <!-- Bootstrap -->
    <link href="<?php bloginfo('template_url');?>/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


    <body>

    <header>
    	<div class="nav-left hidden-xs">
    		<div class="container-logo">
    			<a class="logo-head" href="">
    				<img class="img-responsive" src="<? bloginfo('template_url') ?>/images/logo.jpg">
    			</a>
    		</div>
    	</div>
    	<div class="nav-right">
		    <nav class="navbar navbar-default">
			  <div class="container-fluid">
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			      <a class="navbar-brand hidden-sm hidden-md hidden-lg" href="#">
			      	<img class="img-responsive" src="<? bloginfo('template_url') ?>/images/logo.jpg">
			      </a>
			    </div>

			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			      <div class="login hidden-sm hidden-md hidden-lg">
			      	<span class="btn-login"></span>
			      	<a href="#" data-toggle="modal" data-target="#myModal"><p>Entre em sua conta</p></a>
			      	<a href="tel: "><span class="btn-tel"></span></a>
			      </div>
			      <div class="clear hidden-sm hidden-md hidden-lg"></div>
			      <ul class="nav navbar-nav">
			        <li><a class="ancora" href="#"><p>Home</p></a></li>
			        <li><a class="ancora" href="#"><p>Quem Somos</p></a></li>
			        <li><a class="ancora" href="#"><p>Serviços</p></a></li>
			        <li><a class="ancora" href="#"><p>Cursos</p></a></li>
			        <li><a class="ancora" href="#"><p>Inscreva-se</p></a></li>
			        <li><a class="ancora noborder" href="#"><p>Contatos</p></a></li>
			        <div class="right_buttons hidden-xs">
				        <li><span class="btn-tel"></span></li>
				        <li><span class="btn-login" data-toggle="modal" data-target="#myModal"></span></li>
			        </div>
			      </ul>
			    </div><!-- /.navbar-collapse -->
			  </div><!-- /.container-fluid -->
			</nav>
		</div>
	</header>

	<div class="clear space"></div>
