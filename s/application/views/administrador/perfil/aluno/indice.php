<div class="row cursos-info text-center">
	<div class="col-md-12" id="tb-header">
		<div class="col-xs-4 yellow">
			<p style="padding-top:3.5vh;"><img src="<?php echo site_url('assets')?>/images/sistema/menu/alunos_bw.png" alt="" > <span class="info_descricao">ALUNOS MATRICULADOS ESTE MÊS:</span> </p><strong><?= $certificadoNum['num']?></strong>
		</div>
		<div class="col-xs-4 blue">
			<p style="padding-top:3.5vh;"><img src="<?php echo site_url('assets')?>/images/sistema/menu/certificado_bw.png" alt="" > <span class="info_descricao">CERIFICADOS EMITIDOS ESTE MES:</span> </p><strong><?= $certificadoNum['num']?></strong>
		</div>
		<div class="col-xs-4 green">
			<p style="padding-top:2.5vh;"><img src="<?php echo site_url('assets')?>/images/sistema/menu/cursos_bw.png" alt="" > <span class="info_descricao">CURSOS ADICIONADOS ESTE MÊS:</span> </p><strong><?= $cursoNum[0]['num']?></strong>
		</div>
	</div>
		
</div>
<?php 
	//echo form_open('/Curso/listar_cursos_index/');
?>
<form class="form-group" id="form" method="post">
	<input type="text" name="alunoSearch" id="cursoSearch" class="form-control" placeholder="Digite o nome do aluno que você está buscando"/>
</form>
<?php 
	//echo form_close();
	//echo var_dump($query);
?>	

<div class="table-responsive">
	<table class="table" id="tbprimary">
		
		
		<thead>
			<tr>
				<th colspan="8" class="tb-header text-center"><img class="img-responsive" src="<?php echo site_url('assets')?>/images/sistema/menu/pessoas_ic.png" alt="" style="float:left;">Ultimos alunos registrados</th>	
			</tr>
			
			<tr>
				<th scope="col">Nome</th>
				<th scope="col">CPF</th>
				<th scope="col">Patrocinador</th>
				<th scope="col">Status</th>
				<th scope="col">Detalhes</th>
		
			</tr>
		</thead>	
		
		<tbody>
			<?php  
			//var_dump($query[0]['nome']);
			if(isset($query)){
				//var_dump($query);
				$al = $query[0]['id_aluno'];
				//var_dump($al);
				foreach($query as $row):	
						
				echo validation_errors('<div class="alert alert-danger">','</div>');			
        		echo form_open('administrador/aluno/select_aluno/'.$al);
	        	/*echo var_dump($row);*/
	        	$string = $cpf;	        	
		        $s_string = trim(chunk_split($string, 3, '.'), '.');
		        $alunoCpf = $s_string;
		        $acpf = substr_replace ( $alunoCpf , '-' , 11 , 1 );
			?>	
			<tr class="text-center">   
			    <td scope="row" name="<?php echo $row['id_aluno']; ?>" style="display:none;"></td>
			    <td scope="row"><?php echo $row['nome'];?></td>
			    <td scope="row"><?php echo $acpf;?></td>
			    <td scope="row"> - - - - - </td>
			    <td scope="row"><?php if($row['ativo'] == 1){echo "Ativo";}elseif($row['ativo'] == 0){echo "<p style='color:red;'>Bloqueado</p>";}?></td>
			    <td scope="row"><button type="submit" name="det" style="background: transparent;border:none;outline:none;"><img src="<?php echo site_url('assets')?>/images/sistema/menu/detalhes.png" alt="Detalhes"></button></td>
			</tr>
			<?php 

				echo form_close();
			
				endforeach;
				}
				if(isset($message)){
					echo $message;
				}
			?>
		</tbody>				
	</table>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
	function doneTyping () {
	  $('#form').submit();
	}
	var search = $('#cursoSearch').val();
	var doneTypingInterval = 1000; // wait 3 seconds    
    var timer;
    $('#alunoSearch').on('keyup', function (){  
 		
  		clearTimeout(timer);
  		if($('#alunoSearch').val()){
  			timer = setTimeout(doneTyping, doneTypingInterval);
  		}
      	$.ajax({            
            url: "<?php echo base_url('aluno'); ?>",
            type: 'post',
            data: '',
            success: function () {
            }
      	});
      	return false;
    });

    
</script>