<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">		
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header text-center">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title" style="color:#297f54;"><strong> Criar Exercício </strong></h3>
			</div>
			<div class="modal-body">
				<?php //var_dump($tipoQuestao);?>
				<p style="margin: 0px 0px 20px 0px !important;color:#297f54;margin:0px;font-size:25px;"> Escolha o tipo de exercicio:</p>
				
				<!-- RADIO BUTTONS -->
		    
				<p>
					<input type="radio" id="dissertativa" name="radio_group">
					<label for="dissertativa"><?php echo($tipoQuestao[0]['ds_tipo'])?></label>							
				</p>
				<p>
					<input type="radio" id="multipla_escolha" name="radio_group">
					<label for="multipla_escolha"><?php echo($tipoQuestao[1]['ds_tipo'])?></label>					
				</p>
				<p>
					<input type="radio" id="verdadeiro_ou_falso" name="radio_group">
					<label for="verdadeiro_ou_falso"><?php echo($tipoQuestao[2]['ds_tipo'])?></label>					
				</p>
			
				<!-- /RADIO BUTTONS -->
				<div id="exercicio">
					
				</div>

				<div class="modal-footer row">
					<div class="col-md-6 text-right">
						<a href="<?= site_url('administrador/material/exercicios')?>"><button type="button" class="btn btn-default" style="padding: 3% 14%;margin-bottom: 0px;color: #555;" data-dismiss="modal"> CANCELAR </button></a>
					</div>
				
					<div class="col-md-6 text-left">
						<input type="submit" class="btn btn-success lead" id="criaExerc" style="padding: 3%;min-width: 50%" name="criaExercicio" data-dismiss="modal" value=" CRIAR ">
					</div>
					
				</div>
				
			</div>	
		</div>
	</div>
</div>
<script>


/*------------------------------------------------------------------ QUESTOES ----------------------------------------------------------------------*/
	var count_alt = 0;
	var counter = 0;
	$('#criaExerc').click(function(){
		var arrayAlt = ['A','B','C','D','E'];
		var i = $('.alt .duplicate').length;		
		
		counter += 1;
		/*precisa arrumar as duplicações*/
		//alert(counter);
		$('#counter').val(parseInt(counter));
		var count = $('#counter').val();
		//alert(count);
		/*----------------------------------------------- CRIACAO DAS QUESTOES ---------------------------------------------------------------*/
		/*--------------------DISSERTATIVA--------------------*/
		if ($('#dissertativa').is(':checked'))
		{		

			var qstMain ='qstMain'+count;
			var close = 'btn-close'+count;
			var idQuestao = 'qst'+count;
			$('<div id="'+idQuestao+'" name="dissertativa"><p id="'+close+'" class="text-right"> X </p></div>').appendTo('.exerc');
		  	$(".editor").jqte(); 
		  	$('#'+idQuestao).append('<h3 style="color:#297f54;">Dissertativa: <br></h3><br><textarea name="quest[]" class="editor"></textarea>');		 	 
	 	 	$(".editor").jqte(); 

	 	 	/*close*/
  			$('#'+close).click(function(){
  				$('#'+idQuestao).remove();
  			});
	  		/*/close*/
	  		var tipo = "<?php echo $tipoQuestao[0]['id_tipo']?>";
	  		/*--------------------------------------------- Ajax ---------------------------------------------*/

			$.post("<?= base_url("")?>/sistema/assets/php/db_questao.php",{			
				tipo: tipo
			},
			function(resposta){				
				console.log(resposta);		
				$('#id_questao_atual').val(0);		
				$('#id_questao_atual').val(resposta);			
			}
			);
	 	/*------------------- /DISSERTATIVA --------------------*/	
	 	/*------------------- MULTIPLA - ESCOLHA --------------------*/	
		}else if($('#multipla_escolha').is(':checked'))
		{
			
	  		i = 0;
	  		/*Vai pegar o value do input hidden e adicionar a classe, ao criar, o value será = value ++*/
	  		//count = parseInt(count)+parseInt(1);
	  		var qstMain ='qstMain'+count;//contador da questao 	
	  		var idSelect = 'select'+count;//contador pro select
	  		count_alt += 1;
			var idAltern = count_alt;		
	  		var close = 'btn-close'+count;
	  		var idQuestao = 'qst'+count;

	  		
	  		$('<div id="'+idQuestao+'" name="multipla_escolha"><div id='+qstMain+'><p id="'+close+'" class="text-right"> X </p></div></div>').appendTo('.exerc');
	  		$('#'+qstMain).before().append('<input type="text" id="enunciado" name="quest[]" class="form-control" placeholder="Digite o enunciado"/>');
	  		
	  		/*TEMPLATE*/
	  		
	  	
			var altern = '<div class="altern"><div id="dup" class="duplicate"><strong></strong><textarea name="qAlt" class="editor"></textarea>';
			/*/*/	  		
			$('.editor').jqte(); 
			$('#'+qstMain).append(altern);
			$('.editor').jqte();
			$('#'+idQuestao).last().append('<button type="button" class="btn btn-create-ex" style="display:inline;margin-left:0;min-width:30%;margin-bottom:15px;margin-top:15px;"> ACRESCENTAR ALTERNATIVA </button></div><div><strong style="color:#339966;">Alternativa correta</strong><br><select class="'+idSelect+'"></select></div></div>');
			/*<button type="button" class="cancel" style="margin-left:55%;"> X </button></div>*/
			$('.'+idSelect).append('<option value='+idAltern+'> Alternativa '+arrayAlt[i]+'</option>');//Select para a resposta correta
			$('#'+qstMain+' .duplicate strong').after().html(arrayAlt[0]);


			var tipo = "<?php echo $tipoQuestao[1]['id_tipo']?>";
			/*close*/
  			$('#'+close).click(function(){
  				//alert(count);
  				/*---------------------------------------- Ajax RM ---------------------------------------------*/
  				/*first_id = $('#id_questao_atual').val();
  				index = $('#counter').val();
				$.post("http://localhost/lisieuxtreinamentos/sistema/assets/php/db_rm_questao.php",{						
					first_id: first_id,
					index: index
				},
				function(resposta){
					console.log(resposta);
					
				}
				);*/
	  			$('#'+idQuestao).remove();
  			});
	  		/*/close*/				
	  		/*--------------------------------------------- Ajax ---------------------------------------------*/

			$.post("<?= base_url("")?>/assets/php/db_questao.php",{						
				tipo: tipo
			},
			function(resposta){
				console.log(resposta);
				$('#id_questao_atual').val(0);		
				$('#id_questao_atual').val(resposta);	
			}
			);
		/*--------------- DUPLICACAO DO FORMULÁRIO 1 ------------------*/
		
			$('#'+qstMain+' + .btn-create-ex').click(function(){			

				var i = $('#'+qstMain+' .duplicate').length;
				if($('#'+qstMain+' .duplicate').length < 5){	
					//countador das alternativas
					var alternativa = '<div class="alt"><div id="dup" class="duplicate"><strong></strong><textarea name="qAlt" class="editor"></textarea>';
					count_alt += 1;
					var idAltern = count_alt;				
					$('.'+idSelect).append('<option value='+idAltern+'> Alternativa '+arrayAlt[i]+'</option>');
					console.log($('#'+qstMain+' .duplicate').length);
					$('.editor').jqte(); 			
					$('#'+qstMain).last().append(alternativa);				
					$('.editor').jqte(); 				

					$('#'+qstMain+' .duplicate strong').last().after().html(arrayAlt[i]);	
					/*--------------------------------------------- Ajax ---------------------------------------------*/

					$.post("<?= base_url("")?>/assets/php/db_alternativa.php",{
						tipo: tipo	
					},
					function(resposta){
						console.log(resposta);
					}
					);					
				}else{
					$('#'+qstMain+' + .btn-create-ex:first').remove();
					alert("Limite de alternativas excedido");//perguntar pro andre se é necessario uma limitação de alternativas
					return false;
				}
				
			});	
		/*--------------- /DUPLICACAO DO FORMULARIO 1 ----------------------*/
		/*------------------ /MULTIPLA - ESCOLHA --------------------*/			

		/*------------------- VERDADEIRO - OU - FALSO --------------------*/		
		}else if($('#verdadeiro_ou_falso').is(':checked'))
		{
			i=0;
			
			var qstMain ='qstMain'+count;
			count_alt += 1; 
			var idLabel = 'lbl'+count_alt;
			var count_label = count_alt;
			var val = 'val'+count_alt;
			var close = 'btn-close'+count;
			var idQuestao = 'qst'+count;

	  		$('<div id="'+idQuestao+'" class="text-left" name="verdadeiro_falso"><div  id="'+qstMain+'"><p id="'+close+'" class="text-right" > X </p></div></div>').appendTo('.exerc');	  		

			var alter = '<br><div class="alt"><div id="dup" class="duplicate"><div class="text-center"><strong></strong></div><div id="'+val+'"><input type="text" name="quest[]" placeholder="Digite a alternativa " style="width:70%;height:4vh;"/><input type="checkbox" class="checkbox" id="'+idLabel+'" name="cb"/><label class="'+count_label+'" style=" float:right;" for="'+idLabel+'"></label><span class="valor" style="color:#000;position:relative;margin: 10px 30px; float:right;"></span></div>';			
			$('.editor').jqte(); 
			$('#'+qstMain).append(alter);
			$('.editor').jqte(); 

			/*Change On-Off*/
			if ($('#'+val+' #'+idLabel).is(':checked')){
				$('#'+val+' .valor').html('Verdadeiro')
			}else{
				$('#'+val+' .valor').html('Falso');
			}
			/**/
			$('#'+idQuestao).last().append('<div class="text-center"><button type="button" class="btn btn-create-ex text-center" style="display:inline;margin-left:0;min-width:30%;margin-bottom:15px;margin-top:15px;"> ACRESCENTAR ALTERNATIVA </button></div></div></div>');
			$('#'+qstMain+' .duplicate strong').after().html(arrayAlt[0]);

			/*close*/
  			$('#'+close).click(function(){

  				$('#'+idQuestao).remove();
  			});
	  		/*/close*/
			var idLabelRes = $('#'+idLabel).prop("checked");
			var tipo = "<?php echo $tipoQuestao[2]['id_tipo']?>";
	  		/*--------------------------------------------- Ajax ---------------------------------------------*/

			$.post("<?= base_url("")?>/assets/php/db_questao.php",{
				idLabelRes: idLabelRes,		
				tipo: tipo
			},
			function(resposta){
				console.log(resposta);
				$('#id_questao_atual').val(0);		
				$('#id_questao_atual').val(resposta);	
			}
			);


			/*--------------- DUPLICACAO DO FORMULÁRIO 2 ------------------*/
			$('#'+idQuestao+' .btn-create-ex').click(function(event){	
				//Desabilita checkbox ao criar uma nova alternativa 				
				/*$('#'+idLabel).last().on('click', function(event) {					
				    event.preventDefault();
				    event.stopPropagation();				    
				    return false;				  
				});*/
				//------ /Desabilita checkbox -------
				var i = $('#'+qstMain+' .duplicate').length;
				if($('#'+qstMain+' .duplicate').length < 5){	
					count_alt += 1; 
					var idLabel = count_alt;
					var count_label = count_alt;				
					var val = 'val'+count_alt;
					//alert(idLabel);				

					var alternativa = '<div class="alt"><div id="dup" class="duplicate"><div class="text-center"><strong></strong></div><div id="'+val+'"><input type="text" name="vf-alt" placeholder="Digite a alternativa " style="width:70%;height:4vh;"/><input type="checkbox" class="checkbox" id="'+idLabel+'"/><label class="'+count_label+'" style=" float:right;" for="'+idLabel+'"></label><span class="valor" style="color:#000;position:relative;margin: 10px 30px; float:right;"></span>';
					$('#'+qstMain).append(alternativa);								
					
					/*Change On-Off*/
					if ($('#'+val+' #'+idLabel).is(':checked')){
						$('#'+val+' .valor').html('Verdadeiro').css('color', '#5cb85c');
					}else{
						$('#'+val+' .valor').html('Falso').css('color', '#d9534f');
					}
					$('#'+val+' #'+idLabel+' + .'+count_label).click(function(){
				  		//alert($('.checkbox').val());
				  		$('#'+val+' #'+idLabel).change(function(){
							if ($('#'+val+' #'+idLabel).is(':checked')){
								$('#'+val+' .valor').html('Verdadeiro').css('color', '#5cb85c');
							}else{
								$('#'+val+' .valor').html('Falso').css('color', '#d9534f');
							}
						});
					});	
					var idLabelRes = $('#'+idLabel).prop("checked");
					
			  		/*--------------------------------------------- Ajax ---------------------------------------------*/

					$.post("<?= base_url("")?>/assets/php/db_alternativa.php",{
						tipo: tipo			
					},
					function(resposta){
						console.log(resposta);
					}
					);
					$('#'+qstMain+' .duplicate strong').last().after().html(arrayAlt[i]);			
				}else{
					$('#'+qstMain+' + .btn-create-ex:first').remove();
					alert("Limite de alternativas excedido");//perguntar pro andre se é necessario uma limitação de alternativas
					return false;
				}


			});	
			/*--------------- /DUPLICACAO DO FORMULARIO 2 ----------------------*/
		  	/*------------------ /VERDADEIRO - OU - FALSO --------------------*/		
		}else{
			alert('Nenhuma opção selecionada')
			return false;
		}
		/*Validações */
		/*$('.cancel').last().on('click', function(){
 			$('.cancel:last').each(function(){
				$('.questao').last().detach();
				$('.questao .text-left').before().append('<button type="button" class="cancel" style="margin-left:55%;"> X </button>');		
				remove_questao();
 			});	
 		});
 		function remove_questao(){	
	 		$('.cancel').on('click', function(){
	 			$('.cancel:last').each(function(){
					$('.questao').last().detach();
					$('.questao .text-left').before().append('<button type="button" class="cancel" style="margin-left:55%;"> X </button>');		
					remove_questao();
	 			});	
	 		});
		}*/

		
 		
				
 	 	$('#'+close).css({'cursor': 'pointer', 'background': '#bd2130', 'color': '#fff', 'margin-right': '4px', 'padding': '5px 15px', 'float': 'right', 'border-radius': '4px'});
		
		
		/*Change On-Off*/
		if ($('#'+val+' #'+idLabel).is(':checked')){
			$('#'+val+' .valor').html('Verdadeiro').css('color', '#5cb85c');
			$('#'+idLabel).val($(this).is(':checked'));
		}else{
			$('#'+val+' .valor').html('Falso').css('color', '#d9534f');
			//console.log('not checked');
		}
		/**/
	  	$('#'+val+' .'+count_label).click(function(){
	  		$('#'+val+' #'+idLabel).change(function(){
				if ($('#'+val+' #'+idLabel).is(':checked')){
					$('#'+val+' .valor').html('Verdadeiro').css('color', '#5cb85c');
				}else{
					$('#'+val+' .valor').html('Falso').css('color', '#d9534f');
				}
				//console.log($('#'+idLabel).prop("checked"));
			});
	  		
		});
		/*----------------------------------------------- /CRIACAO DAS QUESTOES -----------------------------------------------------------------*/
		/*TEMPLATE*/		
		var alternativa = '<div class="alt"><div id="dup" class="duplicate"><strong></strong><textarea name="qAlt" class="editor"></textarea>';
		/*/*/
		var arrayAlt = ['A','B','C','D','E'];
		var i = $('.alt .duplicate').length;
		$('.editor').jqte(); 
		var alternativa = '<div class="alt"><div id="dup" class="duplicate"><strong></strong><textarea name="qAlt" class="editor"></textarea>';
		$('.editor').jqte();


	});	
</script>
