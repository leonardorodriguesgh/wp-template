	<div class="alert alert-danger alert-dismissible fade in text-center" role="alert"> 
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 
		<?php 
			if(validation_errors() != false)
				echo '<h4><b>Algum campo obrigatório não foi preenchido corretamente</b></h4>';

			if ( $this->session->flashdata('suspenso') != "" ) 
				echo '<h4><b>'.$this->session->flashdata('suspenso').'</b></h4>'; 

			if ( $this->session->flashdata('erro') != "" ) 
				echo '<h4><b>'.$this->session->flashdata('erro').'</b></h4>'; 
		?>
    </div>
	<div class="white text-center">
		<div class="toolbar">
			<img src="<?= base_url('assets/images/sistema/login/logo.png')?>" alt="">
		</div>
	    

		<?php echo form_open('login',  array('id' => 'login')); ?>						
		<div class="form-group">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<label class="text-center input-group">
						<input type="email" class="fields form-control" name="email" placeholder="E-mail" /> 	
					</label>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12">
					<label class="text-center input-group">
						<input type="password" class="fields form-control" name="senha" placeholder="Senha"  />	
					</label>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div id="request-field">
						<input type="submit" class="btn btn-success lead" value="ENTRAR" />	
					</div>	
				</div>
			</div>			
		</div>		

		<?php echo form_close(); ?>		
		<div class="row">
			<div class="col-xs-11 col-sm-11 col-md-11 text-left" id="recuperar_senha">
				<a role="button" href="#" data-toggle="modal" data-target="#myModal">Esqueceu sua <span> senha? </span></a>
			</div>			
		</div>		

	    <script type="text/javascript" src="<?php echo site_url('assets') ?>/js/vendor/jquery-3.2.1.min.js"></script>
	    <script type="text/javascript" src="<?php echo site_url('assets') ?>/js/vendor/bootstrap.min.js"></script> 
	   	<script type="text/javascript" src="<?php echo site_url('assets') ?>/js/vendor/jquery.validate.min.js"></script> 
	   	<script type="text/javascript" src="<?php echo site_url('assets')?>/js/login.js"></script> 
		
		<script type="text/javascript"><?php 
			if( validation_errors() != false || $this->session->flashdata('erro') != "" || $this->session->flashdata('suspenso') != "" )
				echo "$('.alert-danger').css('display','block');";

			if( $this->session->flashdata('sucesso') != "" )
				echo "$('.alert-sucess').css('display','block');";?>
					
		</script> 
	</div>
