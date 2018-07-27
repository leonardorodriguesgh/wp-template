<div class="row cursos-info text-center">
	<div class="col-md-12" id="tb-header">
		<div class="col-xs-4 yellow">
			<p style="padding-top:3.5vh;"><img src="<?php echo site_url('assets')?>/images/sistema/menu/alunos_bw.png" alt="" > <span class="info_descricao">ALUNOS MATRICULADOS ESTE MÊS:</span> </p><strong><?= $alunoNum['num']?></strong>
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
	
	// echo $query[0]['id_aluno'];
?>	

<div class="table-responsive">
	<table class="table" id="tbprimary">
		
		
		<thead>
			<tr>
				<th colspan="8" class="tb-header text-center"><img class="img-responsive" src="<?php echo site_url('assets')?>/images/sistema/menu/pessoas_ic.png" alt="" style="float:left;">Ultimos alunos adicionados</th>	
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
				// var_dump($query);
				foreach($query as $studant):
				
				echo validation_errors('<div class="alert alert-danger">','</div>');			
        		echo form_open('administrador/desempenho/select_aluno_desempenho/'.$studant['id_aluno']);
	        	
	        	$string = $cpf;	        	
		        $s_string = trim(chunk_split($string, 3, '.'), '.');
		        $alunoCpf = $s_string;
		        $acpf = substr_replace ( $alunoCpf , '-' , 11 , 1 )
			?>	
			<tr class="text-center">   
			    <td scope="row" name="<?= $studant['id_aluno']; ?>" style="display:none;"></td>
			    <td scope="row"><?= $studant['nome'];?></td>
			    <td scope="row"><?= $acpf;?></td>
			    <td scope="row"> - - - - - </td>
			    <td scope="row"><?php if($studant['ativo'] == 1){echo "Ativo";}elseif($studant['ativo'] == 0){echo "<p style='color:red;'>Bloqueado</p>";}?></td>
			    <td scope="row"><button type="submit" name="det" style="background: transparent;border:none;outline:none;"><img src="<?= site_url('assets')?>/images/sistema/menu/detalhes.png" alt="Detalhes"></button></td>
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
<ul id="pageNav" class="pagination"></ul>	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
	function doneTyping () {
	  $('#form').submit();
	}
	var search = $('#alunoSearch').val();
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

	/* ----------------------------------- PAGINAÇÃO --------------------------------------------------->*/

    var pager = new Pager('tbprimary', 6);
    pager.init(); 
    pager.showPageNav('pager', 'pageNav');
    pager.showPage(1);
    function Pager(tableName, itemsPerPage) {
		this.tableName = tableName;
		this.itemsPerPage = itemsPerPage;
		this.currentPage = 1;
		this.pages = 0;
		this.inited = false;

		this.showRecords = function(from, to) {
			var rows = document.getElementById(tableName).rows;
			// i starts from 1 to skip table header row
			for (var i = 1; i < rows.length; i++) {
			if (i < from || i > to)
			rows[i].style.display = 'none';
			else
			rows[i].style.display = '';
			}
		}

		this.showPage = function(pageNumber) {
			if (! this.inited) {
			alert("not inited");
			return;
			}

			var oldPageAnchor = document.getElementById('pg'+this.currentPage);
			oldPageAnchor.className = 'pg-normal';

			this.currentPage = pageNumber;
			var newPageAnchor = document.getElementById('pg'+this.currentPage);
			newPageAnchor.className = 'pg-selected';

			var from = (pageNumber - 1) * itemsPerPage + 1;
			var to = from + itemsPerPage - 1;
			this.showRecords(from, to);
		}

		this.prev = function() {
			if (this.currentPage > 1)
			this.showPage(this.currentPage - 1);
			}

		this.next = function() {
			if (this.currentPage < this.pages) {
			this.showPage(this.currentPage + 1);
			}
		}

		this.init = function() {
			var rows = document.getElementById(tableName).rows;
			var records = (rows.length - 1);
			this.pages = Math.ceil(records / itemsPerPage);
			this.inited = true;
		}

		this.showPageNav = function(pagerName, positionId) {
			if (! this.inited) {
			alert("not inited");
			return;
			}
			var element = document.getElementById(positionId);

			var pagerHtml = '<li><a href="#" onclick="' + pagerName + '.prev();"> &#171 </a></li>';
			for (var page = 1; page <= this.pages; page++)
			pagerHtml += '<li><a href="#" id="pg' + page + '" onclick="' + pagerName + '.showPage(' + page + ');">' + page + '</a></li>';
			pagerHtml += '<li><a href="#" onclick="'+pagerName+'.next();"> » </a></li>';

			element.innerHTML = pagerHtml;
		}
	}

    
</script>