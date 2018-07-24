<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            <?php
                global $page, $paged;
                wp_title( '-', true, 'right' );
            ?>
        </title>
       
        <meta name="keywords" content="<?php echo get_post_meta(get_the_ID(), 'keywords', true); ?>">
        <meta name="theme-color" content="#339966">

        <!-- Bootstrap -->
        <link href="<?php bloginfo('template_url');?>/css/bootstrap.min.css" rel="stylesheet">

        <!-- Facebook Pixel Code -->
        <script>
            !function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '151800318956499');
            fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=151800318956499&ev=PageView&noscript=1"/></noscript>
        <!-- End Facebook Pixel Code -->
         <?php wp_head(); ?>
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/style.css">
        <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
        <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/animate.css">
        <link rel="stylesheet" type="text/css" href="http://localhost/wordpress/wp-content/themes/Site/css/owl.carousel.css">
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/css/owl.theme.css">
    </head>
    <body>
    <header>
    	<div class="nav-left hidden-xs">
    		<div class="container-logo">
    			<a class="logo-head" href="">
    				<img class="img-responsive" src="<?php bloginfo("url") ?>/wp-content/themes/Site/images/logo.jpg">
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
			      	<img class="img-responsive" src="<?php bloginfo('template_url') ?>/images/logo.jpg">
			      </a>
			    </div>
                
			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			      <div class="login hidden-sm hidden-md hidden-lg">
			      	<span class="btn-login"></span>
			      	<a href="#" data-toggle="modal" data-target="#myModal"><p>Entre em sua conta</p></a>
			      	<!-- <a href="tel: "><span class="btn-tel"></span></a> -->
			      </div>
			      <div class="clear hidden-sm hidden-md hidden-lg"></div>
			      <ul class="nav navbar-nav">
			        <li><a class="ancora" href="<?php bloginfo('url') ?>/"><p>Home</p></a></li>
			        <li><a class="ancora" href="<?php bloginfo('url') ?>/quem-somos/"><p>Quem Somos</p></a></li>
			        <li><a class="ancora" href="<?php bloginfo('url') ?>/servicos/"><p>Serviços</p></a></li>
			        <li><a class="ancora" href="<?php bloginfo('url') ?>/cursos-e-consultoria/"><p>Cursos</p></a></li>
			        <li><a class="ancora" href="<?php bloginfo('url') ?>/inscreva-se/"><p>Inscreva-se</p></a></li>
			        <li><a class="ancora noborder" href="<?php bloginfo('url') ?>/contato/"><p>Contatos</p></a></li>
			        <div class="right_buttons hidden-xs">
				        <!-- <a href="<?php //bloginfo('url') ?>/contato/"><li><span class="btn-tel"></span></li></a> -->
				        <?php
                            // if(!session_init()) : 
                            //     echo "Sessão Falhou";
                            // else :
                            //     $wp_session = WP_Session::get_instance();
                            //     echo '<script> window.location.href = "http://cursos.lisieuxtreinamento.com.br/" </script>';
                            // endif;  

                            $wp_session = WP_Session::get_instance();
                            if($wp_session['UserID'] == null) :
                                echo '<li><span class="btn-login" data-toggle="modal" data-target="#myModal"></span></li>';
                            else:
                                echo '<li><a href="#" id="go-painel" data-tipo="'.$wp_session['typeUser'].'" data-email="'.$wp_session['UserLogin'].'"><span class="btn-login" style="background: url('.$wp_session['UserFoto'].')"></span></a></li>';
                                echo '<li><a href="http://localhost/wordpress/logout"><span class="btn-login"></span></a></li>';
                                //echo '<li><a href="http://localhost/wordpress/meus-cursos/"><span  class="ancora">Meus Cursos</span></a></li>';
                            endif;


                        ?>
			        </div>
			      </ul>
			    </div><!-- /.navbar-collapse -->
			  </div><!-- /.container-fluid -->
			</nav>
		</div>
	</header>

	<div class="clear space"></div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ACESSE SUA CONTA</h4>
      </div>
      <div class="modal-body">
        <div class="group_butts">
        	<button class="btn-cadastro">Não tenho cadastro</button>
        	<button class="btn-entrar">Entrar</button>
        	<!-- <div class="login-facebook">
                <div id="fb-root"></div>
                    <script>(function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.10&appId=851503088238961"; fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'facebook-jssdk'));
                    </script>
                <div class="fb-login-button" data-width="214" data-max-rows="1" data-size="large" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false"></div>    
            </div> -->
        </div>
        <div class="enter-login">
            <form class="enter-login">
                <div class="box_login">
                    <div class="inpt col-md-12">
                        <label for="log_email" class="lbl col-md-4">E-mail</label>
                        <input class="col-md-8" type="text" name="log_email">
                    </div>
                    <div class="inpt col-md-12">
                        <label for="log_senha" class="lbl col-md-4">Senha</label>
                        <input class="col-md-8" type="password" name="log_senha">
                    </div>
                    <a href="#" data-toggle="modal" data-target="#myModal3"><p class="btn-recuperar">Esqueci minha senha</p></a>
                    <input type="hidden" name="telaInicial" id="telaInicial" value="">
                    <input type="submit" class="submitLogin" value="ENTRAR">
                </div>
            </form>
        </div>
        <div class="singUp">
        	<form class="singUp">
        		<div class="inpt col-xs-12 col-md-6">
        			<label for="nome" class="lbl col-md-3">Nome</label>
        			<input class="col-md-8" type="text" name="nome">
        		</div>
                <div class="inpt col-xs-12 col-md-6">
                    <label for="telefone" class="lbl col-md-3">Telefone</label>
                    <input class="col-md-9" type="text" name="telefone" onkeypress="return MascaraTel(this, '(99) 999999999', event);" maxlength="14">
                </div>
        		<div class="inpt col-xs-12 col-md-6">
        			<label for="email" class="lbl col-md-3">E-mail</label>
        			<input class="col-md-9" type="text" id="verifyEmail" name="email">
                    <input type="hidden" name="email_">
        		</div>
        		<div class="inpt col-xs-12 col-md-6">
        			<label for="confirmaEmail" class="lbl col-md-5">Confirme seu e-mail</label>
        			<input class="col-md-7" type="text" name="confirmaEmail">
        		</div>
                <div class="inpt col-xs-12 col-md-6">
                    <label for="cpf" class="lbl col-md-3">CPF</label>
                    <input type="text" name="cpf" onkeypress="return MascaraTel(this, '999.999.999-99', event);" required="required" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="Digite o CPF no formato xxx.xxx.xxx-xx" maxlength="14">
                </div>
        		<div class="inpt col-xs-12 col-md-6">
        			<label for="dataNascimento" class="lbl col-md-5">Data de Nascimento</label>
        			<input class="col-md-7" type="text" name="dataNascimento" onkeypress="return MascaraTel(this, '99/99/9999', event);" maxlength="10">
        		</div>
                <div class="inpt col-xs-12 col-md-6">
                    <label for="genero" class="lbl col-md-3">Gênero</label>
                    <select class="col-md-8" name="genero">
                        <option value=""></option>
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                    </select>
                </div>
                <div class="inpt col-xs-12 col-md-6">
                    <label for="cep" class="lbl col-md-3">CEP</label>
                    <input type="text" class="cep col-md-9" name="cep" onkeypress="return MascaraTel(this, '99999-999', event);" required="required" pattern="\d{5}-\d{3}" title="Digite o CEP no formato xxxxx-xxx" maxlength="9" required>
                </div>
                <div class="inpt col-xs-12 col-md-6">
                    <label for="estado" class="lbl col-md-3">Estado</label>
                    <input type="text" class="estado col-md-9" name="estado" required> 
                    <!-- <select class="estado" class="estado" name="estado" required>
                        <option default> Estado</option>
                        <option value="SP">SP</option>
                    </select> -->
                </div>
                <div class="inpt col-xs-12 col-md-6">
                    <label for="cidade" class="lbl col-md-3">Cidade</label>
                    <input type="text" class="cidade col-md-9" name="cidade" required> 
                </div>
                <div class="inpt col-xs-12 col-md-6">
                    <label for="bairro" class="lbl col-md-3">Bairro</label>
                    <input type="text" class="bairro col-md-9" name="bairro" required>
                </div>
                <div class="inpt col-xs-12 col-md-6">
                    <label for="endereco" class="lbl col-md-3">Endereco</label>
                    <input type="text" class="endereco col-md-9" name="endereco" required>
                </div>
                <div class="inpt col-xs-12 col-md-6">
                    <label for="numero" class="lbl col-md-3">Numero</label>
                    <input type="text" class="numero col-md-9" name="numero" required>
                </div>
                <div class="inpt col-xs-12 col-md-6">
                    <label for="complemento" class="lbl col-md-4">Complemento</label>
                    <input type="text" class="complemento col-md-8" name="complemento">
                </div>
                
        		<div class="inpt col-xs-12 col-md-6">
        			<label for="senha" class="lbl col-md-3">Senha</label>
        			<input class="col-md-8" type="password" id="senha" name="senha">
        		</div>
        		<div class="inpt col-xs-12 col-md-6">
        			<label for="confirmaSenha" class="lbl col-md-5">Confirmar sua senha</label>
        			<input class="col-md-7" type="password" name="confirmaSenha">
        		</div>
                <input type="submit" class="submitSingUp" value="REGISTRAR">
                
                <!-- Ualaaaaaaaaaaaaa  -->
        	</form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<button class="noneview btn-modal-final" data-toggle="modal" data-target="#myModal2"></button>
<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content final-mail">
      <div class="modal-body">
        <h1 class="final-title">SEU CADASTRO ESTÁ<br><strong>QUASE CONLUÍDO</strong></h1>
        <p class="final-text">Acesse seu e-mail para finalizar o cadastro</p>
        <img class="img-responsive" src="<?php bloginfo('template_url') ?>/images/mail.jpg">
        <a href="<?php bloginfo('url') ?>/">
            <span class="btn-voltar">VOLTAR</span>
        </a>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<button class="noneview btn-modal-final" data-toggle="modal" data-target="#myModal4"></button>
<div id="myModal4" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Visualização de boleto</h4>
      </div>
      <div class="modal-body">
        <div class="box_boleto">
 
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<button class="noneview btn-modal-final" data-toggle="modal" data-target="#myModal3"></button>
<div id="myModal3" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">RECUPERAÇÃO DE SENHA</h4>
      </div>
      <div class="modal-body">
        <div class="box_login">
            <p class="txt_rec">Recupere sua senha de forma simples e rápida</p>
            <form class="recuperar-senha">
                <div class="inpt col-md-12">
                    <label for="rec_email" class="lbl col-md-4">E-mail</label>
                    <input class="col-md-8" type="text" name="rec_email">
                </div>
                <input type="submit" class="submitRec" value="ENVIAR">  
            </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php

$wp_session = WP_Session::get_instance();

?>
