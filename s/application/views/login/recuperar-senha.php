

		<!--<div class="alert alert-danger alert-dismissible fade in" role="alert"> 
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 
			<?php 

    			/*if(validation_errors() != false)
					echo '<h4><b>Algum campo obrigatório não foi preenchido corretamente</b></h4>';

				if ( $this->session->flashdata('suspenso') != "" ) 
					echo '<h4><b>'.$this->session->flashdata('suspenso').'</b></h4>'; 

				if ( $this->session->flashdata('erro') != "" ) 
					echo '<h4><b>'.$this->session->flashdata('erro').'</b></h4>'; */
			
			?>
	    </div>-->

		<?php echo form_open('recuperar-senha',  array('id' => 'recurepar_senha')); ?>

			<!-- Modal -->
			<div id="myModal" class="modal fade" role="dialog">
				<div class="modal-dialog modal-lg">

					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header text-center">
							<button type="button" class="close" id="modal_close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title"><strong>RECUPERAÇÃO DE SENHA</strong></h4>
						</div>
						<div class="modal-body text-center">				
							<p>Recupere sua senha de forma simple e facil</p>
							<p class="lead" style="margin: 0px; display:inline"><strong>E-mail</strong></p>
							<input type="email" name="email_recup"/>
							
							<div class="modal-footer row">
								<div class="col-md-6 text-right">
									<button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true" style="padding: 3% 14%;margin-bottom: 0px">Cancelar</button>
								</div>
								
								<div class="col-md-6 text-left">
									<input type="submit" class="btn btn-success" name="envia_recup" style="padding: 3% 14%;margin: 0px" value="ENVIAR"/>
								</div>
							
							</div>
						</div>	
					</div>
				</div>
			</div>

		<?php echo form_close(); ?>

	    <script type="text/javascript" src="<?php echo site_url('assets') ?>/js/vendor/jquery-3.2.1.min.js"></script>
	    <script type="text/javascript" src="<?php echo site_url('assets') ?>/js/vendor/bootstrap.min.js"></script> 
	   	<script type="text/javascript" src="<?php echo site_url('assets') ?>/js/vendor/jquery.validate.min.js"></script> 
	   	<script type="text/javascript" src="<?php echo site_url('assets')?>/js/login.js"></script> 
		
		<!--<script type="text/javascript"><?php 
			//	if(validation_errors() != false || $this->session->flashdata('erro') != "" || $this->session->flashdata('suspenso') != "" )
			//		echo "$('.alert-danger').css('display','table');";?>

			   	/*$(window).on('load',function(){
			        $('#myModal').modal('show');
			    });*/
		</script>--> 
