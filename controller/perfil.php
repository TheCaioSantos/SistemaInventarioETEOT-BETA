<?php 
include_once '../model/perfil.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$idusuario = isset($_GET['idusuario']) ? trim($_GET['idusuario']) : null;
	
	$validacao = validarPerfil($_POST, $idusuario);

	if (count($validacao['erros']) == 0) {

		if ($idusuario) {
			$gravou = atualizarPerfil($validacao['usuario'], $idusuario);
		} 
		if ($gravou) {
			header('Location: ../painel.php?pagina=perfil&update=sucesso&idusuario=' . $idusuario);
			exit();
		} else {
			header('Location: ../painel.php?pagina=perfil&update=erro&idusuario=' . $idusuario);
			exit();
		}
	} else {
		$parametrosErro = '';
		foreach ($validacao['erros'] as $i => $campo) {
			$parametrosErro .= '&erro' . $i . '=' . $campo;
		}

		header('Location: ../painel.php?pagina=perfil' . $parametrosErro . '&idusuario=' . $idusuario);
		exit();
	}
} else {
	header('Location: ../painel.php');
	exit;
}


?>