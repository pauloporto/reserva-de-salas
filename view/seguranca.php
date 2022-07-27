<?php

session_start();

if(!isset($_SESSION['user_id'])){
	header("Location: login.php");
	exit;
}else{
	//se estiver tudo certo com a sessão adiciona config.  
	require_once("config.php");
}

?>