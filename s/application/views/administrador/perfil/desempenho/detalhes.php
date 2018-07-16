

<div class="container-fluid">
	<div class="row" style="border-bottom: 1px solid #ccc">
		<div class="col-md-3" style="padding: 0px 15px 15px 0px;">
			<div class="">
				<img src="<?= site_url('assets')?>/images/sistema/menu/aluno_foto_perfil.png" alt="">
			</div>
				
			<div class="aluno-detalhe-yellow col-md-12">
				<h4><img src="<?= site_url('assets')?>/images/sistema/menu/certificado_bw.png" alt=""> Cursos Concluidos</h4>
				<p class="lead">00</p>
			</div>			
		</div>
		<div class="col-md-9 d-green text-left">
			<h1 class="border-bot" style="margin-right: 0px;"><?= $alunoUsuario[0]['nome']?></h1>
			
		</div>
			
		<div class="col-md-3 a-info d-green"><br>
			<strong>Telefone:</strong>
			<p><?= $alunoUsuario[0]['telefone']?></p>		
			<strong>Data de nascimento:</strong>
			<p><?= $alunoUsuario[0]['dt_nascimento']?></p>
			<!--<strong>CEP:</strong>
			<p><?php //echo $alunoUsuario[0]['telefone']?></p>-->			

		</div>
		<div class="col-md-2 a-info d-green"><br>
			<strong>Celular:</strong>
			<p><?= $alunoUsuario[0]['celular']?></p>
			<strong>Sexo:</strong>
			<p><?= ($alunoUsuario[0]['ds_sexo'] = 'm') ? 'Masculino': "Feminino"; ?></p>
			<!--<strong>Endereco:</strong>
			<p><?php //echo $alunoUsuario[0]['nome']?></p>-->
				
		</div>
		<div class="col-md-2 a-info d-green"><br>
			<strong>Email:</strong>
			<p><?= $alunoUsuario[0]['email']?></p>
			<strong>CPF:</strong>
			<p><?= $alunoUsuario[0]['cpf']?></p>
			<strong>RG:</strong>
			<p><?= $alunoUsuario[0]['rg']?></p>		
		</div>
	</div>	
	<div class="row" style="border-bottom: 1px solid #ccc;padding-bottom: 20px">
		<div class="col-md-12 text-left"><h2 style="color: #777">Curso Lorem Ipsum Dolor Sit Amet</h2></div>
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-6"><p></p></div>
				<div class="col-md-6"><p></p></div>
			</div>
			<div class="row d-green">
				<div class="col-md-6"><strong>Ausencias</strong></div>
				<div class="col-md-6 lead">00</div>
			</div>
			<div class="row d-green">
				<div class="col-md-6"><strong>Nota avaliação 1</strong></div>
				<div class="col-md-6 lead">00</div>
			</div>
			<div class="row d-green">
				<div class="col-md-6"><strong>Nota avaliação 2</strong></div>
				<div class="col-md-6 lead">00</div>
			</div>
		</div>
		<div class="col-md-8 text-left d-green">
			<p><strong>Observações</strong></p>
			<p>lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum </p>
		</div>
	</div>
</div>
	
			
	