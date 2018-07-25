	
	
	<div id="validateForm">
		
		<?php 
		$attributes = array('id' => 'myform');
		echo form_open('Administrador/Curso/cadastrar_curso', $attributes);?>
					
		<div class="row text-left">
			<div class="col-md-4">
				<div class="photo">
					<img src="<?php echo site_url('assets')?>/images/sistema/menu/curso_photo.png" alt="Foto do curso">
				</div>			
				<!--<div class="col-md-12 blue" style="margin:15px 0px">
					<div class=" text-center ">
						<a href=""><img  src="<?php echo site_url('assets')?>/images/sistema/menu/picture.png" alt="Trocar foto" class="img-responsive"> TROCAR FOTO</a>	
					</div>	
				</div>-->
				<div class="col-xs-12 text-center" style="margin-top: 10px">
			    	<button class="btn btn-success" >CADASTRAR TURMA</button>
			    </div>
			</div>
			<div class="col-md-8 col-xs-12 text-center" id="curso-data">
				<div class="row">
					<div class="col-md-12 d-green">
						
						<h1 class="text-left" id="nm_curso" class="cadastrar" style="border-bottom: 1px solid #ccc;padding-bottom: 0px:"><p class="cad" id="cadNome"><?php echo $cursoDados['nm_curso'];?></p>
							<a href="#">
								<img src="<?php echo site_url('assets')?>/images/sistema/menu/edit.png" class="becomeCad" alt="Editar" style="float:right; top: 10px; position:absolute; right:10px">
							</a>
						</h1>
						<div class="underline"></div>
					</div>
				</div>
				<div class="row d-green ">
					
					<div class="col-md-6 ">
						    
					    <h3>Tipo: </h3><p id="ds_tipo" ><p class="cad" id="tipo"><?php echo $cursoDados['tipo'];?></p></p><br>
						
					</div>
					<div class="col-md-6">
				
				  		<h3>Sigla: </h3><p id="sg_curso"><p class="cad" id="sigla"><?php echo $cursoDados['sigla_curso'];?></p></p>
					
					</div>	
									
						<div class="col-md-6">						
						    <h3>Situação: </h3><p id="ds_sit"><p class="cad" id="situacao"><?php echo $cursoDados['situacao'];?></p></p><br>
						    
						</div>
						<div class="col-md-6" style="border-right-width: 0px;margin-right: 0px;">
							<h3>Descrição: </h3><div id="descricao"><div class="cad" id="desc"><?php echo $cursoDados['ds_curso'];?></div></div><br>  
						</div>						
						
				</div>	
			</div>				
		</div>

		<?php		
			
		echo form_close();

		if (!empty($_POST['cadastrar'])) {
			echo $message;
		}else{
			echo "";
			/*echo var_dump($cursoDados);*/
		}
		?>
	</div>
	<div class="row text-center">

		<div class="img-responsive display-banner" style="border-top:1px solid #cecece; padding-top: 15px; margin-top: 10px">
			
		</div>
		<?php
		
		$url = $cursoDados['codigo'];
		echo form_open_multipart("Administrador/Curso/cadBanner/".$url);
		// echo var_dump($cursoDados);
		?>
		
			<div class="upload-btn row">
				
				<label class="col-xs-6" for="desktop" id="deskLabel" ><input class="btn" type="file" name="desktop" id="desktop"/>DESKTOP</label>
				<label class="col-xs-6" for="mobile" id="mobLabel"><input class="btn" type="file" name="mobile" id="mobile"/>MOBILE</label>
				
			</div>
			
			<input type="submit" class="btn btn-success" name="submit" id="send" value="CADASTRAR BANNER"/>
		<?php echo form_close();
			if(!empty($caminho)){
				echo $caminho;
			}
			if(!empty($callback)){
				var_dump($callback);
			}else{
				echo "";
			}
		?>
	</div>		
	

	<script>
		$('.close').click(function(){
			$('.alert:last').remove();
			$('.close:last').remove();
		});


		$('.becomeCad').click(function(){

			$( ".cad" ).toggle();
			if($('.cad').is(":hidden")){	
				// $('#esconde_cont').css('display', 'none !important');	 		
		 		$('#nm_curso').append('<input type="text" name="nome" id="nome" placeholder="Digite o nome do curso" style="width:70%; border:0;outline:none;"/>');
		 		$('#ds_tipo').append('<select id="tipo_curso" name="tipo" style="width:100%;padding:5px 45px;"><option value="presencial">Presencial</option><option value="distancia" selected>A Distancia</option></select>');
		 		$('#sg_curso').append('<input type="text" name="sigla" id="sg" class="text-center" placeholder="Digite a sigla do curso" maxlength="2" style="width:100%;padding:5px 45px"/>');
		 		$('#ds_sit').append('<select id="ds_situacao" name="situacao" style="width:100%;padding:5px 45px"><option value="em_progresso">Em progresso</option><option value="desativado" selected>Desativado</option></select>');
		 		$('#descricao').append('<textarea name="ds_curso" class="editor" id="ds_curso"></textarea>');
		 		$(".editor").jqte(); 
		 		$('#curso-data').append('<input type="submit" class="btn btn-success text-center" value="CADASTRAR CURSO" name="cadastrar" id="cadastrar" onclick="teste()"/>');
		 		$('#descricao').parent().removeClass('col-md-6');
		 		$('#descricao').parent().addClass('col-md-12');
		 	}else{		 		
		 		$('#nome').remove();
		 		$('#tipo_curso').remove();
		 		$('#sg').remove();
		 		$('#ds_situacao').remove();
		 		$(".editor").jqte().remove(); 
		 		$('#ds_curso').remove();
		 		$('#cadastrar').remove();
		 		$('#descricao').parent().removeClass('col-md-12');
		 		$('#descricao').parent().addClass('col-md-6');
		 	}

		});		

		$(document).ready(function(){				
			$('#send').attr('disabled', true);	
			
			jQuery(":file").change(function (e){
			    //alert(jQuery(this).val());
			    e.preventDefault();
			    //console.log(e);
			    if($('#desktop').val() != "" || $('#mobile').val() != ""){

					$('#send').attr('disabled', false);
				}
				return true;
			});
		});
		
		/*on click edit input apears*/

		
		
	</script>