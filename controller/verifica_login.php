<?php 
//iniciando a sessão
if (!isset($_SESSION)){
	session_start();
}

if (!$_SESSION['idusuario']) {
	header('Location: index.php');
	exit();
}
?>