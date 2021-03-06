<?php /* Template Name: Editar Perfil */ ?>

<?php 
$wp_session = WP_Session::get_instance(); 

if(!isset($wp_session['UserName'])) : 
	Redirect("login");
else : ?>
	<?php get_header() ?>	

		<div class="container ">
			
			<section class="container_intern">
				
					<div class="title_ancora">
						<h2>EDITAR<strong> PERFIL</strong></h2>
						<span></span>
					</div>
				<div class="col-md-6">	
					<div class="set-info-geral">
						<form class="form info-geral">
							<div class="col-xs-12 col-sm-12 col-md-12">
								<label class="inpt" for="nome">Nome</label>
								<input type="text" name="nome" value="">
								<span class="btn-edit"></span>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12">
								<label class="inpt" for="email">E-mail</label>
								<input type="text" name="email" value="">
								<span class="btn-edit"></span>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12">
								<label class="inpt" for="telefone">Telefone</label>
								<input type="text" name="telefone" value="">
								<span class="btn-edit"></span>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12">
								<label class="inpt" for="data">Data de Nascimento</label>
								<input type="text" name="data" value="">
								<span class="btn-edit"></span>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12">
								<label class="inpt" for="genero">Gênero</label>
								<input type="text" name="genero" value="">
								<span class="btn-edit"></span>
							</div>
							<input type="submit" style="background: #339966;color: white;border: none;padding: 15px;" value="SALVAR ALTERAÇÕES">
						</form>
					</div>
				</div>
				<div class="col-md-6">
				<div clas="set-info-senha">
					<form class="form info-senha">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<label class="inpt" for="senhaAtual">Senha atual</label>
							<input type="password" name="senhaAtual" value="">
							<span class="btn-edit"></span>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<label class="inpt" for="novaSenha">Nova senha</label>
							<input type="password" name="novaSenha" value="">
							<span class="btn-edit"></span>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<label class="inpt" for="confirmarSenha">Confirmar nova senha</label>
							<input type="password" name="confirmarSenha" value="">
							<span class="btn-edit"></span>
						</div>
						<input type="submit"  style="background: #339966;color: white;border: none;padding: 15px;" value="ALTERAR SENHA">
					</form>
				</div>
				</div>
			</section>
			
		</div>


	<?php get_footer() ?>
<?php endif; ?>
