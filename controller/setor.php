<?php 
include_once '../model/setor.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$idsetor = isset($_GET['idsetor']) ? trim($_GET['idsetor']) : null;

	$validacao = validarSetor($_POST, $idsetor);

	if (count($validacao['erros']) == 0) {
		if ($idsetor) {
			$gravou = atualizarSetor($validacao['setor'], $idsetor);
		} else {
			$gravou = inserirSetor($validacao['setor']);
		} 

		if ($gravou) {
			if ($idsetor) {
				header('Location: ../painel.php?pagina=editar-setor&update=sucesso&idsetor=' . $idsetor);
			} else {
				header('Location: ../painel.php?pagina=cadastro-setor&cadastro=sucesso');
			}
			exit();
		} else {
			if ($idsetor) {
				header('Location: ../painel.php?pagina=editar-setor&update=erro&idsetor=' . $idsetor);
			} else{
				header('Location: ../painel.php?pagina=cadastro-setor&cadastro=erro');
			}
			exit();
		}

	} else {
		//Passa por GET os erros na validação
		$parametrosErro = '';
		foreach ($validacao['erros'] as $i => $campo) {
			$parametrosErro .= '&erro' . $i . '=' . $campo;
		}

		if ($idsetor) {
			header('Location: ../painel.php?pagina=editar-setor' . $parametrosErro . '&idsetor=' . $idsetor);
		} else{
			header('Location: ../painel.php?pagina=cadastro-setor' . $parametrosErro);
		}
		exit();
	}

} else {
	header('Location: ../painel.php?pagina=cadastro-setor');
	exit;
}










 ?>