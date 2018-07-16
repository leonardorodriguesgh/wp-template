<div class="row cursos-info text-center">
	<div class="col-md-12" id="tb-header">
		<div class="col-md-4 green">
			<p style="padding-top:2.5vh;"><img src="<?php echo site_url('assets')?>/images/sistema/menu/cursos_bw.png" alt=""><span class="info_descricao">CURSOS ADICIONADOS ESTE MÊS:</span>  </p><strong><?= $cursoNum[0]['num']?></strong>
		</div>
		<div class="col-md-4 blue">
			<p style="padding-top:3.5vh;">
				<img src="<?php echo site_url('assets')?>/images/sistema/menu/certificado_bw.png" alt="">
				<span class="info_descricao">CERTIFICADOS EMITIDOS ESTE MÊS:</span>  
			</p><strong><?= $certificadoNum['num']?></strong>
		</div>
				
		<a href="#">
			<div class="addThing">			
				<img src="<?php echo site_url('assets')?>/images/sistema/menu/add_turma.png" alt="Adicionar cursos">
			</div>
		</a>				
	
	</div>
		
</div>
<?php 
	//echo form_open('/Curso/listar_cursos_index/');
	//var_dump($turmaDados);
?>
<form class="form-group" id="form" method="post">
	<input type="text" name="turmaSearch" id="turmaSearch" class="form-control" placeholder="Digite o nome da turma que você está buscando"/>
</form>
<?php 
	//echo form_close();
	//echo var_dump($query);
?>	

<div class="table-responsive">
	<table class="table" id="tbprimary">
		
		
		<thead>
			<tr>
				<th colspan="8" class="tb-header text-center"><img class="img-responsive" src="<?php echo site_url('assets')?>/images/sistema/menu/cursos_ic.png" alt="" style="float:left;">Ultimas turmas adicionados</th>	
			</tr>
			
			<tr>
				<th scope="col">Turma</th>
				<th scope="col">Data de inicio</th>
				<th scope="col">Data de término</th>
				<th scope="col">Detalhes</th>
		
			</tr>
		</thead>	
		
		<tbody>
			<?php  
			//var_dump($turma);
			if(!empty($turma)){
				//var_dump($query);
				foreach($turma as $row): 			
				echo validation_errors('<div class="alert alert-danger">','</div>');			
        		echo form_open('administrador/turma/select_turma/'. $row['id_turma']);
	        	
	        	$inic = $row['dt_inicio'];
	        	$ter = $row['dt_termino'];
	        	$inicio = str_replace("-", "/", $inic);
	        	$termino = str_replace("-", "/", $ter);
		        
			?>	
			<tr>   
			    <td scope="row" name=" - - - - - " style="display:none;"></td>
			    <td scope="row"><?php echo $row['nm_turma'];?></td>
			    <td scope="row"><?php echo date("d/m/Y", strtotime($inicio));?></td>
			    <td scope="row"><?php echo date("d/m/Y", strtotime($termino));?></td>
			    <td scope="row"><button type="submit" style="background: transparent;border:none;outline: none;"><img src="<?php echo site_url('assets')?>/images/sistema/menu/detalhes.png" alt="Detalhes"></button></td>
			</tr>
			<?php 
				echo form_close();
			?>
			<?php 
				
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
	var search = $('#turmaSearch').val();
	var doneTypingInterval = 1000; // wait 3 seconds    
    var timer;
    $('#turmaSearch').on('keyup', function (){  
 		
  		clearTimeout(timer);
  		if($('#turmaSearch').val()){
  			timer = setTimeout(doneTyping, doneTypingInterval);
  		}
      	$.ajax({            
            url: "<?php echo base_url('Curso/listar_cursos_index'); ?>",
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