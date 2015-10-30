<?php

require("seguranca.php");


$msg = "";
if(isset($_POST['cadastrar'])){

		
	require($cfg->fileroot."controller/cidade_controller.php");
	
	$controller = new Cidade_controller();

	if(is_numeric($controller->salvar($_POST))){
		$msg = "Sucesso!";
	}
	
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Cadastro de Cidade</title>
	</head>
	<body>
		<h2>Cadastre uma Nova Cidade!</h2>
		<form target="_self" method="post">
			<input type="text" name="nome">
			<input type="submit" value="Cadastrar!" name="cadastrar">
		</form><br>
		<?= $msg ?> <br>
		
		<a href="index.php">Início</a>
	</body>
</html>