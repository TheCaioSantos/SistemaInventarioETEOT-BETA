<?php 
include_once '../model/local.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$idlocal = isset($_GET['idlocal']) ? trim($_GET['idlocal']) : null;
	
	$validacao = validarLocal($_POST, $idlocal);

	if (count($validacao['erros']) == 0) {

		if ($idlocal) {
			$gravou = transferirLocal($validacao['local'], $idlocal);
		} else {
			$gravou = inserirLocal($validacao['local']);
		}
		if ($gravou) {
			if ($idlocal) {
				header('Location: ../painel.php?pagina=editar-local&update=sucesso&idlocal=' . $idlocal);
			} else {
				header('Location: ../painel.php?pagina=cadastro-local&cadastro=sucesso');
			}
			exit();
		} else {
			if ($idlocal) {
				header('Location: ../painel.php?pagina=editar-local&update=erro&idlocal=' . $idlocal);
			} else{
				header('Location: ../painel.php?pagina=cadastro-local&cadastro=erro');
			}
			exit();
		}
	} else {
		//Passa por GET os erros na validação
		$parametrosErro = '';
		foreach ($validacao['erros'] as $i => $campo) {
			$parametrosErro .= '&erro' . $i . '=' . $campo;
		}

		if ($idlocal) {
			header('Location: ../painel.php?pagina=editar-local' . $parametrosErro . '&idlocal=' . $idlocal);
		} else{
			header('Location: ../painel.php?pagina=cadastro-local' . $parametrosErro);
		}
		exit();
	}
} else {
	header('Location: ../painel.php?pagina=cadastro-local');
	exit;
}


?>