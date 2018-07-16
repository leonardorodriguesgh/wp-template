<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cadastrar curso</title>
</head>
<body>
	<form action="<php base_url()?>curso/cadastrar_curso">
		nome<input type="text" name="nome">
		tipo<input type="text" name="tipo">
		sigla<input type="text" name="sigla">
		situacao<input type="text" name="situacao">
		descricao<input type="text" name="ds_curso">
		data-inicio<input type="date" name="inicio">
		data-fim<input type="date" name="termino">
	</form>
</body>
</html>