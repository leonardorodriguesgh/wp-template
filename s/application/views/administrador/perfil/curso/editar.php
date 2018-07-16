
<div id="validateForm">
	
	<?php //var_dump($bannerDados);
	$attributes = array('id' => 'myform');
	echo form_open('administrador/curso/editar_curso/'.$cursoDados['codigo'], $attributes);
	?>
	<div class="row text-left" id="id_data">
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
					
					<h1 class="text-left border-bot" id="nm_curso" class="cadastrar"><p class="cad" id="cadNome"><?php echo $cursoDados['nm_curso'];?></p>
						<a href="#">
							<img src="<?php echo site_url('assets')?>/images/sistema/menu/edit.png" class="becomeCad" alt="Editar" style="float:right; margin-top: 4px;">
						</a>
					</h1>
					<div class="underline"></div>
				</div>
			</div>
			<div class="row d-green ">
				
				<div class="col-md-6 ">
					    
				    <h3>Tipo: </h3><p id="ds_tipo" ><p class="cad" id="tipo"><?php echo $cursoDados['tipo'];?></p></p>
				</div>
				<div class="col-md-6">
			
			  		<h3>Sigla: </h3><p id="sg_curso"><p class="cad" id="sigla"><?php echo $cursoDados['sigla_curso'];?></p></p>
				
				</div>	
				<div class="row" style="height: auto">						
					<div class="col-md-12">			
						<div class="col-md-6">
							<h3>Situação: </h3><p id="ds_sit"><p class="cad" id="situacao"><?php echo $cursoDados['situacao'];?></p></p>
						</div>
						<div class="col-md-6">
							<h3>(Des)Ativar: </h3><p id="ativo"><p class="cad" id="activate"><?php if($cursoDados['ativo'] == 1){echo "ativo";}else{echo "bloqueado";}?></p></p>
						</div>							  
					</div>
					<div class="col-md-12" style="padding-right: 35px;padding-left: 0px;border-right-width: 0px;margin-right: 0px;">
						<h3>Descrição: </h3><br><p id="descricao"><p class="cad" id="desc"><?php echo $cursoDados['ds_curso'];?></p></p><br>  
					</div>						
				</div>		
			</div>	
		</div>					
	</div>
	<?php echo form_close();?>	
	<?php 	
	//echo form_close();
	
	if (isset($_POST['editar'])) {			
		echo $message;
	}else{
		echo "";
		/*echo var_dump($cursoDados);*/
	}
		
	?>
</div>
<div class="row text-center">
	<div class="img-responsive display-banner" >
		<img src="<?php if($bannerDados['url_banner']){echo site_url($bannerDados['url_banner']);}else{echo "";}?>" alt="">
	</div>		
	<?php $url = $cursoDados['codigo'];
	echo form_open_multipart("administrador/curso/editBanner/".$url);?>
		<div class="upload-btn row">
			
			<label class="col-xs-6" for="desktop" id="deskLabel" ><input class="btn" type="file" name="desktop" id="desktop"/>DESKTOP</label>
			<label class="col-xs-6" for="mobile" id="mobLabel"><input class="btn" type="file" name="desktop" id="mobile"/>MOBILE</label>
			
		</div>
		
		<input type="submit" class="btn btn-success" name="submit" id="send" value="EDITAR BANNER"/>
	
	<?php echo form_close();?>
</div>
<script>
	$('.becomeCad').click(function(){

		$( ".cad" ).toggle();
		if($('.cad').is(":hidden")){		
			$('#id_data .col-md-4').append('<div id="codigo" style="display:none">Numero: <input type="text" name="codigo" value="<?php echo $cursoDados['codigo']?>" readonly/></div>');
	 		$('#nm_curso').append('<input type="text" name="nome" id="nome" placeholder="Digite o nome do curso" style="width:70%; border:0;outline:none;"/>');
	 		$('#ds_tipo').append('<select id="tipo_curso" name="tipo" style="width:100%;padding:5px 45px;"><option value="presencial">Presencial</option><option value="distancia" selected>A Distancia</option></select>');
	 		$('#sg_curso').append('<input type="text" name="sigla" id="sg" class="text-center" placeholder="Digite a sigla do curso" maxlength="2" style="width:100%;padding:5px 45px;"/>');
	 		$('#ds_sit').append('<select id="ds_situacao" name="situacao" style="width:100%;padding:5px 45px;"><option value="em progresso">Em progresso</option><option value="desativado" selected>Desativado</option></select>');
	 		$('#ativo').append('<select id="enable" name="ativo" style="width:100%;padding:5px 45px;"><option value="0">Bloqueado</option><option value="1" selected>Desbloqueado</option></select>');
	 		$('#descricao').append('<textarea name="ds_curso" class="editor" id="ds_curso"></textarea>');
	 		$(".editor").jqte(); 
	 		$('#curso-data').append('<input type="submit" class="btn btn-success text-center" value="EDITAR CURSO" name="editar" id="editar"/>');
	 		
	 	}else{		 		
	 		$('#nome').remove();
	 		$('#tipo_curso').remove();
	 		$('#sg').remove();
	 		$('#ds_situacao').remove();
	 		$(".editor").jqte().remove(); 
	 		$('#ds_curso').remove();
	 		$('#codigo').remove();	 		
	 		$('#enable').remove();
	 		$('#editar').remove();

	 	}

	});		

	$('#send').attr('disabled', true);
	jQuery("input#desktop").change(function (e) {
	    //alert(jQuery(this).val());
	    e.preventDefault();
	    if($('#desktop').val() != ""){
			$('#send').attr('disabled', false);
		}
		return true;
	});
</script>