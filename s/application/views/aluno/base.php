<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="pt-br">
	<head>
		
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">

		<title>LISIEUX</title>

    	<link href="<?php echo site_url('assets')?>/css/vendor/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo site_url('assets')?>/css/estilo.css" rel="stylesheet">

	    <script type="text/javascript" src="<?php echo site_url('assets') ?>/js/vendor/jquery-3.2.1.min.js"></script>
	 
	</head>
	<body>
		
		<header>
			

	
		</header>
	
		<main>
			
			<div class="hidden-xs hidden-sm col-md-1 col-lg-1">
			
				<?php 	
					echo '<a href="'.site_url().'" class="menu" data-toggle="tooltip" title="Home">';

						echo '<img src="'.site_url('assets').'/images/sistema/menu/menu-home'.( ( $ativo == 'home' )? '-hover':'' ).'.png" />';

					echo '</a>'; 
				?>

				<?php foreach ($this->session->userdata('menu') as $modulo => $nome): ?>

					<?php 
						echo '<a href="'.site_url().$this->session->userdata('prefixo').'/'.( ( $modulo == "avancado" )? 'agendamento/avancado' : $modulo ).'" class="menu" data-toggle="tooltip" title="'.( ( $modulo == "avancado" )? 'Agendamento Avançado' : $nome ).'">';

							echo '<img src="'.site_url('assets').'/images/sistema/menu/menu-'.$modulo.''.( ( $modulo == $ativo )? '-hover':'' ).'.png" />';

						echo '</a>'; 
					?>

				<?php endforeach ?>  

			</div>

			<div class="col-md-11 col-lg-11">

				
				<div class="alert alert-danger alert-dismissible fade in" role="alert"> 
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			    	<h4><b>Ah, não! Ocorreu um erro durante o processo!</b></h4> 
			    	<p> 
			    		<?php 

			    			if( validation_errors() != false ) 
								echo 'Algum campo obrigatório não foi preenchido corretamente';

							if ( $this->session->flashdata('erro') != "" ) 
          						echo $this->session->flashdata('erro'); 
          				
          				?>
          			 </p> 
			    </div>


			    <div class="alert alert-sucess alert-dismissible fade in" role="alert"> 
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			    	<h4><b>Sucesso!</b></h4> 
			    	<p>
				    	<?php 
				    		
				    		if ( $this->session->flashdata('sucesso') != "" ) 
              					echo $this->session->flashdata('sucesso');

              			?>
              		</p>
			    </div> 

				<?php if( isset( $pagina ) ) include( $pagina ) ?>

			</div>

		</main>

		<footer>



		</footer>

		<script type="text/javascript" src="<?php echo site_url('assets') ?>/js/vendor/bootstrap.min.js"></script> 
	   	<script type="text/javascript" src="<?php echo site_url('assets') ?>/js/vendor/hideShowPassword.min.js"></script> 
	    <script type="text/javascript" src="<?php echo site_url('assets') ?>/js/vendor/jquery.mask.min.js"></script>
	   	<script type="text/javascript" src="<?php echo site_url('assets') ?>/js/vendor/jquery.validate.min.js"></script> 
	   	<script type="text/javascript" src="<?php echo site_url('assets') ?>/js/vendor/jquery.maskMoney.min.js"></script> 
	
		<script type="text/javascript" src="<?php echo site_url('assets') ?>/js/vendor/moment.min.js"></script> 
	   	<script type="text/javascript" src="<?php echo site_url('assets') ?>/js/vendor/locales/moment.pt-br.js"></script> 

	   	<script type="text/javascript" src="<?php echo site_url('assets') ?>/js/scripts.js"></script>

		<script type="text/javascript"><?php 
				if(validation_errors() != false || $this->session->flashdata('erro') != "" )
					echo "$('.alert-danger').show();";

				if($this->session->flashdata('sucesso') != "" ) 
					echo "$('.alert-sucess').show();";
		?></script>  

	</body>
	
</html>	

