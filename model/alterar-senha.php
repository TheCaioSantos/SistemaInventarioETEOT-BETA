<?php 


function validarSenha($usuario, $idusuario = null) {
	$erros = array();

	//verificando se estar preenchido
	$senha = isset($usuario['senha']) && trim($usuario['senha']) ? trim($usuario['senha']) : null;

	//validação
	if (!$senha) {
		$erros[] = 'senha';
	} elseif (strlen($senha) < 8) {
		$erros[] = 'senhainvalida';
	}


	//Retornando array 'erros' e 'usuario'
	 return array(
	 	'erros' => $erros,
	 	'usuario' => array(
	 		'senha' => $senha,
	 	)
	 );
	}

function consultarPerfil($idusuario) {
	//Conexão com Banco de Dados
	include_once 'model/conexao.php';
	$query = "SELECT senha FROM usuario WHERE idusuario = '$idusuario'";
	
	return mysqli_query($conexao, $query);
}


function atualizarSenha($usuario, $idusuario) {
	include '../model/conexao.php';

    //verificando se já tem alguem cadastrado com o mesmo email
	$senha = $usuario['senha'];
	

	$query = "UPDATE usuario SET senha = md5('$senha') WHERE idusuario = $idusuario";

	return mysqli_query($conexao, $query);
}

?>