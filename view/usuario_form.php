<?php

require_once "seguranca.php";
require_once "../controller/usuarioController.php";

$usuarioController = new UsuarioController();

$usuario = $usuarioController->excluir();
$usuario = $usuarioController->salvar();
$usuario = $usuarioController->abrir();
if(isset($usuario[0]))
extract($usuario[0]);

if(!isset($id))
{
	$nome = '';
	$email = '';
	$senha = '';
	$id = 0;
	
}

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

<!-- menu esquerdo -->
<?php include "menu_esquerdo.php"; ?>

<!-- conteudo -->

<div class="corpo">

<h3> Cadastro de Usuários </h3>

<form name="form1" method="post" target="_self">

<input type="hidden" name="id" value="<?= $id ?>" />

<table class="tabela_comum" cellpadding="4" cellspacing="4">

<tr>
    <td width="100"> Nome </td>
    <td><input type="text" name="nome" value="<?= $nome ?>" /> </td>
    <td width="30"></td>
    <td width="100"> E-mail</td>
    <td > <input type="text" name="email" value="<?= $email?>" /></td>
</tr>

<tr>
    <td width="100"> Senha </td>
    <td><input type="password" name="senha" value="<?= $senha ?>" /> </td>
    <td width="30"></td>
    <td width="100"> </td>
    <td ></td>
</tr>

</table>

<input type="submit" name="salvar" value="Salvar" class="btn1" />

<input type="submit" name="excluir" value="Excluir" class="btn1" />

</form>

</div>

</body>
</html>