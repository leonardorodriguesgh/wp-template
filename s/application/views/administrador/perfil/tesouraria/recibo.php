<script>
window.onload = function(){
	$.post("<?= base_url("")?>/assets/php/verifica_pagamento.php", {
		teste: "teste"
	},
	function(data){
		console.log(data);
	});
}

</script>
<?= form_open(base_url('').'administrador/tesouraria/gerar_recibo/'.$alunoUsuario[0]['id_aluno']);?>
<div class="d-green text-left border-bot"><h1 id="print"><?= $alunoUsuario[0]['nome']?><button type="submit" class="btn btn-success" style="float:right; letter-spacing: .1em; padding: 8px 15px;"> IMPRIMIR </button></h1></div>
<?= form_close();?>
<div class="col-md-12" id="info-aluno" style="border-bottom: 1px solid #ccc">
	<?php
		//Mascara CPF
		// var_dump($infoPagamento);
		$string = $cpf;	        	
        $s_string = trim(chunk_split($string, 3, '.'), '.');
        $alunoCpf = $s_string;
        $acpf = substr_replace ( $alunoCpf , '-' , 11 , 1 );

        //Mascara Rg

        $str = $rg;	        	
        
        $rep = substr_replace($str, '.', 2, 0);
        $s_str = $rep;
        $s_str = trim(chunk_split($rep, 3, '.'), '.');
        $alunoRg = $s_str;
        $rg = substr_replace ( $alunoRg , '' , 3 , 1 );
        $arg = substr_replace ( $rg , '-' , 10, 1 );

	?>
	<div class="row text-left">
		<div class="col-md-2">
			<strong> TELEFONE </strong>
			<p><?= $alunoUsuario[0]['telefone']?></p>
		</div>
		<div class="col-md-2">
			<strong> CELULAR </strong>
			<p><?= $alunoUsuario[0]['celular']?></p>
		</div>
		<div class="col-md-3">
			<strong> EMAIL </strong>
			<p><?= $alunoUsuario[0]['email']?></p>
		</div>
	</div>
	<div class="row text-left">
		<div class="col-md-2">
			<strong> Data de nascimento</strong>
			<p><?= $alunoUsuario[0]['dt_nascimento']?></p>
		</div>
		<div class="col-md-2">
			<strong> GENERO </strong>
			<p><?= ($alunoUsuario[0]['ds_sexo'] = 'm') ? 'Masculino': "Feminino"; ?></p>
		</div>
		<div class="col-md-2">
			<strong> CPF </strong>
			<p><?= $acpf;?></p>
		</div>
		<div class="col-md-2">
			<strong> RG </strong>
			<p><?= $arg?></p>
		</div>
	</div>
	<div class="row text-left">
		<div class="col-md-2">
			<strong> CEP </strong>
			<p><?php echo $alunoUsuario[0]['cep']?></p>
		</div>
		<div class="col-md-6">
			<strong> Endereco </strong>
			<p><?php echo $alunoUsuario[0]['endereco'].', '.$alunoUsuario[0]['numero']?></p>
		</div>
	</div>
</div>


<div class="table-responsive text-center col-xs-12">
	<table class="table text-center">
		
		
		<thead style="border-bottom: 0px;">
						
			<tr>
				<th scope="col" class="text-center"><label>Curso</label></th>
				<th scope="col" class="text-center"><label>Forma de pagamento</label></th>
				<th scope="col" class="text-center"><label>Valor/parcela</label></th>
				<th scope="col" class="text-center"><label>Qnt. de parcelas</label></th>
				<th scope="col" class="text-center"><label>Pago</label></th>
				<th scope="col" class="text-center"><label>Valor Total</label></th>
		
			</tr>
		</thead>	
		
		<tbody>
			<?php $vl_total = 0;
			$pago = 0;
			foreach($infoPagamento as $row):
			$vl_total += $row['vl_inscricao'];	
			($row['id_status_pag'] == 3) ? $pago += $row['vl_inscricao'] : $pago += 0 ;	
			?>
			<tr>   
			    <td scope="row" name="" style="display:none;"></td>
			    <td scope="row" style="width:250px"><?= $row['nm_curso']?></td>
			    <td scope="row"><?= $row['ds_forma_pag']?></td>
			    <td scope="row"><?= $row['vl_inscricao']?></td>
			    <td scope="row">1</td>
			    <td scope="row"><?= $row['nm_status']?></td>
			    <td scope="row"><?= $row['vl_inscricao']?></td>
			</tr>	
			<?php endforeach;?>		
		</tbody>	
	</table>
</div>
<div class="col-md-12 row">
	<div class="col-md-3" style="float:right;right: 2.2%">
		<table class="table" id="sub_tb_recibo">			
			<thead>
				<tr>
					<th>
						<div class="col-md-12 text-center">
							<strong style="color:#666;font-size: 16px; border-bottom: 0px;font-weight: bold">Investimento total</strong>
						</div>						
					</th>
				</tr>
			</thead>
			<tbody>				
				<tr scope="row" style="border-top: 0px;">
					<td>
						<div class="col-md-6">Pago</div>
						<div class="col-md-6" >R$ <?= $pago?></div>
					</td>
					
				</tr>
				<tr scope="row">
					<td>
						<div class="col-md-6">A Pagar</div>
						<div class="col-md-6" >R$ <?= $vl_total - $pago?></div>
					</td>
					
				</tr>	
				<tr scope="row">
					<td style="background-color: #297f54;color: #fff;border-top: 0px">
						<div class="col-md-6" >Total</div>
						<div class="col-md-6">R$ <?= $vl_total?></div>
					</td>
				</tr>						
			</tbody>
		</table>		
	</div>
</div>

	
