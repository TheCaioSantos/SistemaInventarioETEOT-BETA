<?php 
include_once '../model/alterar-senha.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$idusuario = isset($_GET['idusuario']) ? trim($_GET['idusuario']) : null;
	
	$validacao = validarSenha($_POST, $idusuario);

	if (count($validacao['erros']) == 0) {

		if ($idusuario) {
			$gravou = shell_exec('C:\Users\adm\AppData\Local\Programs\Python\Python36\python C:\wamp64\www\projeto-02-07\model\alterar-senha.py 2>&1' . $validacao['usuario']['senha'] . ' ' .$idusuario);
		} 
		if ($gravou == 1) {
			include_once '../model/logout.php';
		} else {
			header('Location: ../painel.php?pagina=alterar-senha&update=erro&idusuario=' . $idusuario);
			exit();
		}
	} else {
		$parametrosErro = '';
		foreach ($validacao['erros'] as $i => $campo) {
			$parametrosErro .= '&erro' . $i . '=' . $campo;
		}

		header('Location: ../painel.php?pagina=alterar-senha' . $parametrosErro . '&idusuario=' . $idusuario);
		exit();
	}
} else {
	header('Location: ../painel.php');
	exit;
}


?>
