<div class="d-green text-left border-bot"><h1 id="print">LOREM IPSUM LOREM IPSUM   <button type="submit" class="btn btn-success" style="float:right; letter-spacing: .1em; padding: 8px 15px;"> IMPRIMIR </button></h1></div>
<div class="col-md-12" id="info-aluno" style="border-bottom: 1px solid #ccc">
	<?php
		//Mascara CPF

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
			<strong> Sexo </strong>
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
			<p> - - - - - </p>
		</div>
		<div class="col-md-6">
			<strong> Endereco </strong>
			<p> - - - - - </p>
		</div>
	</div>
</div>


<div class="table-responsive text-center col-xs-12">
	<table class="table text-center">
		
		
		<thead style="border-bottom: 0px;">
						
			<tr>
				<th scope="col"><label>Curso</label></th>
				<th scope="col"><label>Forma de pagamento</label></th>
				<th scope="col"><label>Valor/parcela</label></th>
				<th scope="col"><label>Qnt. de parcelas</label></th>
				<th scope="col"><label>Pago</label></th>
				<th scope="col"><label>Valor Total</label></th>
		
			</tr>
		</thead>	
		
		<tbody>
			
			<tr>   
			    <td scope="row" name="" style="display:none;"></td>
			    <td scope="row"> - - - - - </td>
			    <td scope="row"> - - - - - </td>
			    <td scope="row"> - - - - - </td>
			    <td scope="row"> - - - - - </td>
			    <td scope="row"> - - - - - </td>
			    <td scope="row"> - - - - - </td>
			</tr>			
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
						<div class="col-md-6" >R$ - - - </div>
					</td>
					
				</tr>
				<tr scope="row">
					<td>
						<div class="col-md-6">A Pagar</div>
						<div class="col-md-6" >R$ - - - </div>
					</td>
					
				</tr>	
				<tr scope="row">
					<td style="background-color: #297f54;color: #fff;border-top: 0px">
						<div class="col-md-6" >Total</div>
						<div class="col-md-6">R$ - - - </div>
					</td>
				</tr>						
			</tbody>
		</table>		
	</div>
</div>

	
