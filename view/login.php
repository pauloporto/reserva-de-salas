<?php

$error = '';

if(isset($_POST['entrar'])){
	if($_POST['login'] == "teste" && $_POST['password'] == "teste"){
		session_start();

		$_SESSION['user_id'] = 1;

		header("Location: index.php");
		exit;
	}
}


?>

<!DOCTYPE html>
<html>
	<head>
		<title>LOGIN</title>
	</head>
	<body>
		<h2>Logue para entrar no site!</h2>
		<form action="login.php" method="post">
			<?= $error ?><br>
			<input type="text" name="login">
			<input type="password" name="password">

			<input type="submit" value="Entrar!" name="entrar">
		</form>
	</body>
</html>
