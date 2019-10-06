<?php 
include_once '../model/usuario.php';

$idusuario = isset($_GET['idusuario']) ? trim($_GET['idusuario']) : null;

if (isset($_GET['status'])) {
		$status = status($idusuario, $_GET['status']);
		header('Location: ../painel.php?pagina=lista-usuarios');
		exit();
	}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$idusuario = isset($_GET['idusuario']) ? trim($_GET['idusuario']) : null;

	
	//Chamando função que valida os campos preenchidos
	//Essa função retorna os vetores 'erros' e 'usuario'
	$validacao = validarUsuario($_POST, $idusuario);

	if (count($validacao['erros']) == 0) {
		//Chamando função que insere o usuario
		if ($idusuario) {
			$gravou = atualizarUsuario($validacao['usuario'], $idusuario);
		} else {
			$gravou = inserirUsuario($validacao['usuario']);
		}
		if ($gravou) {
			if ($idusuario) {
				header('Location: ../painel.php?pagina=editar-usuario&update=sucesso&idusuario=' . $idusuario);
			} else {
				header('Location: ../painel.php?pagina=cadastro-usuario&cadastro=sucesso');
			}
			exit();
		} else {
			if ($idusuario) {
				header('Location: ../painel.php?pagina=editar-usuario&update=erro&idusuario=' . $idusuario);
			} else{
				header('Location: ../painel.php?pagina=cadastro-usuario&cadastro=erro');
			}
			exit();
		}
	} else {
		//Passa por GET os erros na validação
		$parametrosErro = '';
		foreach ($validacao['erros'] as $i => $campo) {
			$parametrosErro .= '&erro' . $i . '=' . $campo;
		}

		if ($idusuario) {
			header('Location: ../painel.php?pagina=editar-usuario' . $parametrosErro . '&idusuario=' . $idusuario);
		} else{
			header('Location: ../painel.php?pagina=cadastro-usuario' . $parametrosErro);
		}
		exit();
	}
} else {
	header('Location: ../painel.php?pagina=cadastro-usuario');
	exit;
}


?>