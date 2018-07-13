<?php /* Template Name: Cadastrar Usuário */ ?>
<?php 
if(isset($_POST)) :
		
		include('php/cadastrar-aluno.php');?>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="<?php bloginfo('template_url') ?>/js/jquery.redirect.js"></script>
		<script>	    
		 	$(document).ready(function () {
    			 window.setTimeout(function () {
				 	
				 	$.redirect("http://lisieuxtreinamento.com.br/autenticar/",
				    	{user: '<? echo $form->email ?>', permission : true, page: '<? echo $_GET['page'] ?>' }
				    );
				  
				}, 1000);
			});
		</script>
		 

<?php endif; ?>


