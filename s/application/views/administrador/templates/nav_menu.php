<div class="container-fluid white text-center" role="main">
	<ul class="v-menu" role="navigation">
		<label for="#home">
			<li name="home">
				<a id="home" href="<?php echo site_url('/adm/painel')?>"><img src="<?php echo site_url('assets')?>/images/sistema/menu/home.png" alt="Home" class="img-responsive"></a>
			</li>
		</label>
		<label for="#pessoas">
			<li name="pessoas" >
				<a id="pessoas" href="<?php echo site_url('/adm/pessoas')?>"><img src="<?php echo site_url('assets')?>/images/sistema/menu/pessoas.png" alt="Pessoas" class="img-responsive"></a>
			</li>
		</label>	
		<label for="#curso">
			<li name="curso" id="curso">
				<a href="<?php echo site_url('/adm/cursos')?>"><img src="<?php echo site_url('assets')?>/images/sistema/menu/Cursos.png" alt="Cursos" class="img-responsive"></a>
			</li>
		</label>
		<label for="#material">
			<li name="material" id="material">
				<a href="<?php echo site_url('/adm/material')?>"><img src="<?php echo site_url('assets')?>/images/sistema/menu/material.png" alt="Material" class="img-responsive"></a>
			</li>
		</label>
		<label for="">
			<li name="" id="">
				<a href=""><img src="<?php echo site_url('assets')?>/images/sistema/menu/secretaria.png" alt="Secretaria" class="img-responsive"></a>
			</li>
		</label>
		<label for="">
			<li name="" id="">
				<a href="<?= base_url('adm/tesouraria')?>"><img src="<?php echo site_url('assets')?>/images/sistema/menu/tesouraria.png" alt="Tesouraria" class="img-responsive"></a>
			</li>
		</label>
		<label for="">
			<li name="" id="">
				<a href="<?php echo site_url('/adm/desempenho')?>"><img src="<?php echo site_url('assets')?>/images/sistema/menu/desempenho.png" alt="Desempenho" class="img-responsive"></a>
			</li>
		</label>
	</ul>