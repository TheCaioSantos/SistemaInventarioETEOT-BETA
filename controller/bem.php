<?php 

include_once '../model/bem.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$idbem = isset($_GET['idbem']) ? trim($_GET['idbem']) : null;
	$operacao = isset($_GET['operacao']) ? trim($_GET['operacao']) : null;
	$validacao = validarBem($_POST, $idbem);

	if (count($validacao['erros']) == 0) {
		if ($idbem) {
			$gravou = atualizarBem($validacao['bem'], $idbem);
		} else {
			$gravou = inserirBem($validacao['bem']);
		}
		if ($gravou) {
			if ($idbem) {
				header('Location: ../painel.php?pagina=editar-bem&update=sucesso&idbem=' . $idbem . '&operacao=' . $operacao);
			} else {
				header('Location: ../painel.php?pagina=cadastro-bens&cadastro=sucesso');
			}
			exit();
		} else {
			if ($idbem) {
				header('Location: ../painel.php?pagina=editar-bem&update=erro&idbem=' . $idbem . '&operacao=' . $operacao);
			} else{
				header('Location: ../painel.php?pagina=cadastro-bens&cadastro=erro');
			}
			exit();
		}
	} else {
		//Passa por GET os erros na validação
		$parametrosErro = '';
		foreach ($validacao['erros'] as $i => $campo) {
			$parametrosErro .= '&erro' . $i . '=' . $campo;
		}

		if ($idbem) {
			header('Location: ../painel.php?pagina=editar-bem' . $parametrosErro . '&idbem=' . $idbem . '&operacao=' . $operacao);
		} else{
			header('Location: ../painel.php?pagina=cadastro-bens' . $parametrosErro);
		}
		exit();
	}
} else {
	header('Location: ../painel.php?pagina=cadastro-bens');
	exit();
}

 ?>