
<?php echo form_open_multipart('administrador/material/cadastrar/');?>
<div class="row">
	<div class="col-md-3">
		<div class="">
			<img src="<?php echo site_url('assets')?>/images/sistema/menu/material_pic.png" alt="">
		</div>				
		
	</div>
	<div class="col-md-9 d-green text-left">

		<h1 class="border-bot">Cadastrar Material <img src="<?php echo site_url('assets')?>/images/sistema/menu/edit.png" class="becomeEdit" alt="Editar" style="float:right;"></h1>
		<?php //var_dump($materialDados)?>
		
	</div>
		
	<div class="col-md-4 a-info d-green text-left"><br>
		<strong id="nm_mat"><p id="mat_nm" class="cad">Nome do Material: </p></strong>
		<p class="imp"><input type="text" name="nomeMaterial" id="nomeMaterial" placeholder="Digite o nome do material de apoio"></p>		
		
	</div>
	<div class="col-md-5 a-info d-green text-left"><br>
		<strong id="numero"><p id="n_aulas" class="cad">N° de Aulas: </p></strong>
		<p id="nAula" class="imp"></p>
		
			
	</div>
</div>
<div class="d-green text-center" id="createForm">		
	<div class="col-md-12" style="margin-top:15px;padding:0px;">
		<div >
			<div class="col-md-12 text-left border-bot" style="padding:0px;">
				<h1 id="conteudo"><p class="cad">Conteúdo: </p><small><p class="imp"><input type="text" name="ds_mat" id="ds_mat" placeholder="Digite a descrição do material"/></p></small>				
					<img src="<?php echo site_url('assets')?>/images/sistema/menu/edit.png" class="becomeEdit" alt="" style="float:right;">
				</h1>				

			</div>				
		</div>
		
	</div>
	<div class="row dupField">			
		<div class="col-md-12 text-left duplicate">
			
			<h3><strong class="text-left">Aula:</strong></h3><br>
			<div class="row aula">
				<label for="video" class="col-md-3 col-sm-12 col-xs-12"><img src="<?php echo site_url('assets/images/sistema/menu/video_input.png')?>"> <p> Video:</p> Escolha o video
					<input type="file" name="video" id="video" class="video" placeholder="Video: Escolha o arquivo"/>
				</label>
				
				<label for="texto" class="col-md-3 col-sm-12 col-xs-12"><img src="<?php echo site_url('assets/images/sistema/menu/book_input.png')?>">  <p> Texto:</p> Escolha o texto
					<input type="file" name="texto" id="texto" class="texto" placeholder="Texto: Escolha o arquivo"/>
				</label>

				<button type="button" class="dupBtn btn" style="background: transparent;border:1px dashed #ccc;"> + </button>
				<button type="button" class="btn btn-success submit-mat"> SUBIR ARQUIVOS </button>
			</div>
			<div class="row">
				<label for="exercicio" class="col-md-3 col-sm-12 col-xs-12" ><img src="<?php echo site_url('assets/images/sistema/menu/ex_input.png')?>"> <p> Exercicio:</p> Lorem Ipsum
					<input type="file" name="exercicio" id="exercicio" class="exercicio" placeholder="Exercicio: "/>		
				</label>
				<button type="button" class="btn btn-create-ex"> CRIAR EXERCICIO </button>
			</div>
			
		</div>				
	</div>
	<button type="button" class="cancel" style="bottom:15vh;padding:1%;background: #c5581f; border:none; color: #fff; width: 10%;outline: none;"> X </button><br>
	<input type="submit" class="btn text-center" id="success-cad-mat" value="CADASTRAR"/>

</div>	
<?php echo form_close();?>		
<script>
	$(document).ready(function(){

		$('.becomeEdit').click(function(){

			$( ".cad" ).toggle();
			if($('.cad').is(":hidden")){		 		
		 		$('#nm_mat').append('<input type="text" name="nm_mat" id="material" placeholder="Digite o nome do material" style="width:70%; border:0;outline:none;"/>');
		 		$('#numero').append('<input type="number" name="qt_aulas" id="qt_aulas"/>');
		 		$('#conteudo').append('<input type="text" name="descricao" id="desc" class="text-center" placeholder="Digite uma descricao"/>');
		 		
		 		$('#createForm').append('<input type="submit" class="btn btn-success text-center" value="CADASTRAR MATERIAL" name="cadastrar" id="cadastrar" onclick="teste()"/>');
		 	}else{		 		
		 		$('#material').remove();
		 		$('#qt_aulas').remove();
		 		$('#desc').remove();		 		
		 		$('#cadastrar').remove();
		 	}

		});		


		$('#nAula').html($('.duplicate').length);
		
		$('.cancel').hide();
		$('.dupBtn').click(function(){	
			//cria um elemento posterior ao principal com a classe ".append"
			$('.dupField').append('<div class="append"></div>');
			//pega o ultimo elemento da classe ".duplicate" e faz uma copia
			var dup = $('.duplicate:last').clone(true);
			//deleta o botao de criação anterior
			$('.dupBtn:first').detach();
			//Implementa o elemento clonado a nova classe ".append"
			$('.append').last().append(dup);
			//escreve o numero de aulas atuais
			$('#nAula').html($('.duplicate').length);
			//se o elemento nao tiver clonagens, manter o botao de remoção escondido
			if($('.dupField .append').length > 0){
				$('.cancel').show();
			}else{
				$('.cancel').hide();
			}
			
							
		});

		$('.cancel').on('click', function(){
			if($('.dupField .append').length > 0){
				//remove o ultmo elemento ".append"
				$('.dupField .append').last().remove();
				//insere o botao de remover antes do "btn-success"
				$('.btn-success:last').last().before('<button type="button" class="dupBtn btn" style="background: transparent;border:1px dashed #ccc;"> + </button>');
				//escreve o numero de aulas atuais
				$('#nAula').html($('.duplicate').length);
				//refaz a duplicação do form
				//se o elemento nao tiver clonagens, manter o botao de remoção escondido
				if($('.dupField .append').length > 0){
					$('.cancel').show();
				}else{
					$('.cancel').hide();
				}		
				$('.dupBtn').click(function(){	
					
					$('.dupField').append('<div class="append"></div>');
					
					var dup = $('.duplicate:last').clone(true);
					$('.dupBtn:first').detach();

					$('.append').last().append(dup);	
					//escreve o numero de aulas atuais
					$('#nAula').html($('.duplicate').length);	
					if($('.dupField .append').length > 0){
						$('.cancel').show();
					}else{
						$('.cancel').hide();
				}		
					
				});					
			}
			
		});


		$('.submit-mat').on('submit', function (){    		
	      	$.ajax({            
	            url: "<?php echo base_url('administrador/material/cadastrarArquivos'); ?>",
	            type: 'post',
	            data: '',
	            success: function () {
	            	console.log('foi');
	            }
	      	});
	      	return false;
	    });	
	});
</script>
		
