<?php /*Template Name: Confirmacao - Aluno */ ?>
<?php get_header(); ?>

<?php 

$key = base64_decode(substr(($wp_query->query_vars['cod']."=="), 32));

$query = mysql_query("SELECT cd_aluno, nm_aluno FROM ci_aluno WHERE cd_aluno = $key");

while($row = mysql_fetch_assoc($query)){
	
	$insert = mysql_query("UPDATE ci_aluno SET ic_ativo = 1 WHERE cd_aluno = ".$row['cd_aluno']."") or die(mysql_error());
}

?>

<section class="content_confirmacao">
	<div class="container">
		<div class="box_confirmacao">

			<h1>CADASTRO <strong>REALIZADO COM SUCESSO</strong></h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor idunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
			<h3 class="txt_timer" id="my-timer">
				Página será Redirecionada em <b id="currentSeconds">5</b> segundos.
			</h3>
		</div>
	</div>
</section>

<style type="text/css">.footer{position: absolute; bottom: 0;}</style>
<script src="<?php bloginfo('template_url') ?>/js/timer.js"></script>

<?php get_footer(); ?>