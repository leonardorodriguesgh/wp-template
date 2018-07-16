<div class="row cursos-info text-center">
	<div class="col-xs-12" id="tb-header">
		<div class="col-md-4 col-sm-12 yellow">
			<p style="padding-top:3.5vh;"><img src="<?php echo site_url('assets')?>/images/sistema/menu/alunos_bw.png" alt="" > <span class="info_descricao">ALUNOS MATRICULADOS ESTE MÊS:</span>  </p><strong><?= $alunoNum['num']?></strong>
		</div>
		<div class="col-md-4 col-sm-12 blue">
			<p style="padding-top:3.5vh;"><img src="<?php echo site_url('assets')?>/images/sistema/menu/certificado_bw.png" alt="" > <span class="info_descricao">CERIFICADOS EMITIDOS ESTE MES:</span>  </p><strong><?= $certificadoNum['num']?></strong>
		</div>
		<div class="col-md-4 col-sm-12 green">
			<p style="padding-top:2.5vh;"><img src="<?php echo site_url('assets')?>/images/sistema/menu/cursos_bw.png" alt="" > <span class="info_descricao">CURSOS ADICIONADOS ESTE MÊS:</span>  </p><strong><?= $cursoNum[0]['num']?></strong>
		</div>
	</div>
		
</div>

<div class="table-responsive">
	<table class="table" id="tbprimary">		
		<thead>
			<tr>
				<th colspan="8" class="tb-header text-center"><img class="img-responsive" src="<?php echo site_url('assets')?>/images/sistema/menu/cursos_ic.png" alt="" style="float:left;">Ultimos cursos adicionados</th>	
			</tr>
			
			<tr>
				
				<th scope="col">Curso</th>
				<th scope="col">Tipo</th>
				<th scope="col">Valor</th>
				<th scope="col">Detalhes</th>
		
			</tr>
		</thead>	
		
		<tbody>
			<?php foreach($query as $row): ?>
			<?php
				echo validation_errors('<div class="alert alert-danger">','</div>');
	        	echo form_open('administrador/curso/select_curso/'.$row->codigo);
			?>
			<tr>   
			    <td scope="row" name="<?php echo $row->codigo; ?>" style="display:none;"></td>
			    <td scope="row"><?php echo $row->nm_curso; ?></td>
			    <td scope="row"><?php echo $row->tipo; ?></td>
			    <td scope="row"> - - - - - </td>
			    <td scope="row"><button type="submit" name="det" style="background: transparent;border:none; outline:none;"><img src="<?php echo site_url('assets')?>/images/sistema/menu/detalhes.png" alt="Detalhes"></button></td>
			</tr>
			<?php 
				/*echo print_r($cursoNum);*/
				echo form_close();
			?>
			<?php endforeach; ?>
		</tbody>				
	</table>
</div>