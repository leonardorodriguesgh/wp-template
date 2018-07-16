<?php echo form_open('administrador/material/cadastra_exercicio/'.$aulaDados[0]['id_aula']);	
?>
<div class="container-fluid">
	<div class="row">
		<div class=" col-md-12 d-green text-left">
			<h1 class="border-bot" style="margin-right: 0px;"><?php if(isset($aulaDados[0]['titulo'])) echo $aulaDados[0]['titulo'];?><img src="<?php echo site_url('assets/images/sistema/menu/edit.png')?>" alt="" style="float:right;"></h1>
			<h3>Descrição:</h3>
			<textarea type="text" id="desc" class="editor" name="desc"></textarea>
			<div class="border-bot"></div>
			<h2 class="text-center" style="color:#297f54;">Questões</h2>
		</div>
	</div>	
</div>
<input type="number" id="counter" name="counter" value="0" style="display:none;" readonly/>
<input type="text" id="id_questao_atual" name="id_questao_atual" style="display:none;" readonly/>
<div class="exerc">
	
</div>

<div class="text-left">
	<button type="button" class="btn btn-create-ex" data-toggle="modal" data-target="#myModal" style="display: inline-block;margin-top: 20px;margin-left: 0px;color:#fff;">
		 ACRESCENTAR QUESTAO 
	</button>
</div>			
<div class="text-center">
	<input type="submit" class="btn btn-success" name="salvar" value=" SALVAR " id="salvar-exercicio" style="padding:15px 50px">
</div>


<?php echo form_close();
	if(isset($_SESSION['message'])){
	    echo $_SESSION['message']; // display the message
	    unset($_SESSION['message']); // clear the value so that it doesn't display again
	}
?>
<script>
	$('#send').attr('disabled', true);
	jQuery("input#desktop").change(function (e) {
	    //alert(jQuery(this).val());
	    e.preventDefault();
	    if($('#desktop').val() != ""){
			$('#send').attr('disabled', false);
		}
		return true;
	});
	$(".editor").jqte();	
</script>