<?php
if (isset($_GET['pagina']) && $pagina = trim($_GET['pagina'])) {
	$filename = 'view/' . $pagina . '.php';
	//Verificando se a pagina chamada existe
	if (file_exists($filename)) {

		if (estaLogado()) {

			switch ($pagina) {
				case 'cadastro-usuario':
					$nivel = array(1);
					break;
				case 'cadastro-bens':
				case 'cadastro-setor':
				case 'cadastro-classificacao':
				case 'cadastro-local':
				case 'presta-contas':
					$nivel = array(1, 2);
					break;
				default:
					$nivel = array(1, 2, 3);
					break;
			}
			if (in_array($_SESSION['nivel'], $nivel))
				include_once $filename;
			else
				include_once 'view/erro403.php';
		} else if ($pagina == '')
			header('Location: painel.php');
		else
			include_once 'view/erro403.php';
	} else {
		//Se o arquivo não existir, o usuário é redirecionado para pagina de 'error404.php'
		include_once 'view/error404.php';
	}
} else {
	//Se nenhuma pagina for passada, o usuário é redirecionado para pagina 'home.php'
	include_once 'view/home.php';
}
