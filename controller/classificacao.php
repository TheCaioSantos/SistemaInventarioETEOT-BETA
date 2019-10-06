<?php 
include_once '../model/classificacao.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$idcod_class = isset($_GET['idcod_class']) ? trim($_GET['idcod_class']) : null;
	
	$validacao = validarClassificacao($_POST, $idcod_class);

	if (count($validacao['erros']) == 0) {
		if ($idcod_class) {
			$gravou = atualizarClassificacao($validacao['classificacao'], $idcod_class);
		} else {
			$gravou = inserirClassificacao($validacao['classificacao']);
		}
		if ($gravou) {
			if ($idcod_class) {
				header('Location: ../painel.php?pagina=editar-classificacao&update=sucesso&idcod_class=' . $idcod_class);
			} else {
				header('Location: ../painel.php?pagina=cadastro-classificacao&cadastro=sucesso');
			}
			exit();
		} else {
			if ($idcod_class) {
				header('Location: ../painel.php?pagina=editar-classificacao&update=erro&idcod_class=' . $idcod_class);
			} else{
				header('Location: ../painel.php?pagina=cadastro-classificacao&cadastro=erro');
			}
			exit();
		}
	} else {
		//Passa por GET os erros na validação
		$parametrosErro = '';
		foreach ($validacao['erros'] as $i => $campo) {
			$parametrosErro .= '&erro' . $i . '=' . $campo;
		}

		if ($idcod_class) {
			header('Location: ../painel.php?pagina=editar-classificacao' . $parametrosErro . '&idcod_class=' . $idcod_class);
		} else{
			header('Location: ../painel.php?pagina=cadastro-classificacao' . $parametrosErro);
		}
		exit();
	}
} else {
	header('Location: ../painel.php?pagina=cadastro-classificacao');
	exit;
}


?>