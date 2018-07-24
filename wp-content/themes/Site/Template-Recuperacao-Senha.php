<?php /* Template Name: Recuperar Senha */ ?>
<?php get_header(); ?>

<?
	$key = base64_decode(substr(($wp_query->query_vars['cod']."=="), 32));

 ?>

 <section class="content_confirmacao">
	<div class="container">
		<div class="box_confirmacao">

			<h1>RECUPERAÇÃO <strong>DE SENHA</strong></h1>

			<div class="box_form">
				<form class="redefinir-senha">
	                <div class="inpt col-md-12">
	                    <label for="red_senha" class="lbl col-md-4">Nova senha:</label>
	                    <input class="col-md-8" type="password" id="red_senha" name="red_senha">
	                </div>
	                <div class="inpt col-md-12">
	                    <label for="red_confirmaSenha" class="lbl col-md-4">Confirme a senha:</label>
	                    <input class="col-md-8" type="password" name="red_confirmaSenha">
	                </div>
	                <input type="hidden" name="code" value="<?php echo $key; ?>">
	                <input type="submit" class="submitRec" value="ENVIAR">  
	            </form>
			</div>
			
		</div>
	</div>
</section>

<style type="text/css">.footer{position: absolute; bottom: 0;}</style>

<?php get_footer(); ?>