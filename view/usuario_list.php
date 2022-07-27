<?php

require_once "seguranca.php";
require "../controller/usuarioController.php";

$usuarioController = new UsuarioController();
$lista = $usuarioController->listarcontroller();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
     <script src="js/jquery.js"></script>
	 <script src="js/jquery.datetimepicker.full.js"></script>
     <script src="js/dateformat.js"></script>
        
     <link rel="stylesheet" type="text/css" href="css/estilo.css">
     <link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css">

  	 <script src="js/lib.js"></script>
     
     </head>
     <title>Cadastro de usuários</title>
     <body>

<!-- form -->
<div class="form">

</div>


<!-- menu esquerdo -->
<?php include "menu_esquerdo.php"; ?>

<!-- conteudo -->

<div class="corpo">

<h3> Cadastro de Usuários </h3>

<input type="button" name="novo" value="novo" class="btn1" onclick="abre('usuario_form.php')" />

<table class="lista_comum" cellpadding="4" cellspacing="4">
<thead>
    <tr>
        <th> id </th>
        <th> Nome </th>
        <th> E-mail </th>
    </tr>
</thead>

<tbody>

<?= $lista ?>

</tbody>

</table>

</div>

</body>
</html>