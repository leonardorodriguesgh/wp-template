
<?php 
	echo form_open_multipart('administrador/turma/cadastrarMaterial/'.$turmaDados['id_turma']);
?>

<div class="row">
	<div class="col-md-3">
		<div class="text-left">
			<img src="<?php echo site_url('assets')?>/images/sistema/menu/material_pic.png" alt="">
		</div>				
		
	</div>
	<div class="col-md-9 d-green text-left">

		<h1 class="border-bot">Cadastrar Material <img src="<?php echo site_url('assets')?>/images/sistema/menu/edit.png" class="becomeCad" alt="Editar" style="float:right;"></h1>
		<?php //var_dump($turmaDados['id_turma'])?>
		
	</div>
		
	<div class="col-md-4 a-info d-green text-left"><br>
		<strong>Nome do Material: </strong>
		<p class="imp" id="nm_mat" style="margin:0;"><p class="cad"></p></p>		
		
	</div>
	<div class="col-md-5 a-info d-green text-left"><br>
		<strong id="numero"><p id="n_aulas">N° de Aulas: </p></strong>
		<p id="nAula" class="imp"><p class="cad"></p></p>
		
			
	</div>
</div>
<div class="d-green text-center" id="createForm">		
	<div class="col-md-12" style="margin-top:15px;padding:0px;">
		<div >
			<div class="col-md-12 text-left border-bot" style="padding:0px;">
				<h1><p>Conteúdo: </p><small><p class="imp" id="conteudo" style="margin:0;"></p></small>				
					<img src="<?php echo site_url('assets')?>/images/sistema/menu/edit.png" class="becomeCad" alt="" style="float:right;">
				</h1>				

			</div>				
		</div>
		
	</div>
	<?php 	foreach ($aulaDados as $row) :
	?>
	<div class="row dupField">			
		
		<div class="col-md-12 text-left duplicate">
			<?php 
			if(isset($message)){
				echo $message;
			} //var_dump($turmaDados);
			//echo $materialDados[0]['nm_material_apoio'];
		
			?>
			<h3><strong class="text-left" style="display:inline;">Aula: </strong><?php if(isset($row['titulo'])) echo $row['titulo']?></h3><br>
			<div class="row aula">
				<?php //if(isset($row['id_aula'])) echo $row['id_aula']?>
				<select name="video" id="video" class="video col-md-3 col-sm-12 col-xs-12" placeholder="Video: Escolha o arquivo">
					<option value=" Video " disabled selected> Video </option>
					<?php foreach ($materialDados as $material): ?>
						<option value="<?php echo $material['url']?>"><img src="<?php echo site_url('assets/images/sistema/menu/video_input.png');?>" alt=""><?php echo $material['nm_material_apoio']?></option>
					<?php endforeach ?>
					
				</select>
			
				<select name="video" id="texto" class="video col-md-3 col-sm-12 col-xs-12" placeholder="Video: Escolha o arquivo">
					<option value=" Texto " disabled selected > Texto </option>
					<?php foreach ($materialDados as $material): ?>
						<option value="<?php echo $material['url']?>"><img src="<?php echo site_url('assets/images/sistema/menu/video_input.png');?>" alt=""><?php echo $material['nm_material_apoio']?></option>
					<?php endforeach ?>
				</select>
				
				
				<!--<button type="button" class="dupBtn btn" style="background: transparent;border:1px dashed #ccc;"> + </button>-->
				<label for="files" class="btn btn-success"> SUBIR ARQUIVOS 
					<input type="file" id="files" name="materialFiles" class="submit-mat" style="display:none"/>
				</label>
			</div>
			<div class="row">
				
				<select name="video" id="exercicio" class="video col-md-3 col-sm-12 col-xs-12" placeholder="Video: Escolha o arquivo">
					<option value=" Exercicio " disabled selected > Exercicio </option>
					<?php foreach ($materialDados as $material): ?>
						<option value="<?php echo $material['url']?>"><img src="<?php echo site_url('assets/images/sistema/menu/video_input.png');?>" alt=""><?php echo $material['nm_material_apoio']?></option>
					<?php endforeach ?>
				</select>	
				
				<a href="<?php echo site_url('administrador/material/exercicios/'.$row['id_aula']);?>"><button type="button" class="btn btn-create-ex"> CRIAR EXERCICIO </button></a>
			</div>			
		</div>		
	
	</div>
	<?php endforeach;?>		
	<button type="button" class="cancel" >
		X 
	</button><br>
	<input type="submit" class="btn text-center" id="success-cad-mat" value="CADASTRAR"/>

</div>	
<?php 
echo form_close();?>		
<script>
	$(document).ready(function(){

		$('.becomeCad').click(function(){

			$( ".cad" ).toggle();
			if($('.cad').is(":hidden")){		 		
		 		$('#nm_mat').append('<input type="text" name="nm_mat" id="mat" placeholder="Digite o nome do material" style="border:0px 0px 1px 0px;outline:none;"/>');
		 		$('#conteudo').append('<input type="text" name="descricao" id="desc" class="text-left" placeholder="Digite uma descricao" style="border:0;outline:none;" />');
		 	}else{		 		
		 		$('#mat').remove();
		 		$('#desc').remove();		
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
		
