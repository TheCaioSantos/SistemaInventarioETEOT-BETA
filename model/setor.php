<?php 

function validarSetor($setor, $idsetor = null) {
	$erros = array();

	$nome_setor = isset($setor['nome-setor']) && trim($setor['nome-setor']) ? trim($setor['nome-setor']) : null;	
	$categoria_setor = isset($setor['categoria-setor']) && trim($setor['categoria-setor']) ? trim($setor['categoria-setor']) : null;

	if (!$nome_setor) {
		$erros[] = 'nome-setor';
	}

	if (!$categoria_setor) {
		$erros[] = 'categoria-setor';
	}

	//Retornando array 'erros' e 'setor'
	 return array(
	 	'erros' => $erros,
	 	'setor' => array(
	 		'nome-setor' => $nome_setor,
	 		'categoria-setor' => $categoria_setor,
	 	)
	 );
}

function inserirSetor($setor) {
	//Conexão com Banco de Dados
	include_once '../model/conexao.php';

	$nome_setor = mysqli_real_escape_string($conexao, $setor['nome-setor']);	
	$categoria_setor = mysqli_real_escape_string($conexao, $setor['categoria-setor']);

	//verificando se já tem algum setor cadastrado com o mesmo nome
	$query = "SELECT COUNT(*) as total FROM setor WHERE nome_setor = '$nome_setor'";

	$resultado = mysqli_query($conexao, $query) or die (mysqli_error($conexao));
	$row = mysqli_fetch_assoc($resultado);

	//Se for encontrado algum setor com o mesmo nome cadastrado, redireciona para pagina de cadastro com um aviso
	if ($row['total'] == 1) {
		header('Location: ../painel.php?pagina=cadastro-setor&cadastro=nomeerro');
		exit();
	}

	$query = "INSERT INTO setor (nome_setor, categoria_setor) 
	VALUES ('$nome_setor', '$categoria_setor')";

	return mysqli_query($conexao, $query) or die (mysqli_error($conexao));

}

function consultarSetor($idsetor = null, $inicio = null, $registros_por_pagina = null){
	//Conexão com Banco de Dados
	include_once 'model/conexao.php';

	$query = "SELECT * FROM setor";

	if ($idsetor) {
		$query .= ' WHERE idsetor = ' . $idsetor;
	} 
	if (!$idsetor) {
		if ($inicio) {
			$query .= " ORDER BY idsetor DESC LIMIT $inicio, $registros_por_pagina";
		} else {
			$query .= " ORDER BY idsetor DESC LIMIT $registros_por_pagina";
		}
	}

	return mysqli_query($conexao, $query);
}

function listarSetor() {
	//Conexão com Banco de Dados
	include 'model/conexao.php';
	$query = "SELECT * FROM setor";
	return mysqli_query($conexao, $query);
}



#?????????????????????????????????
function consultarCategoria(){
	//Conexão com Banco de Dados
	include_once 'model/conexao.php';

	$query = "SELECT * FROM setor GROUP BY categoria_setor";
	
	return mysqli_query($conexao, $query);
}


function atualizarSetor($setor, $idsetor) {
	include '../model/conexao.php';

	$nome_setor = mysqli_real_escape_string($conexao, $setor['nome-setor']);	
	$categoria_setor = mysqli_real_escape_string($conexao, $setor['categoria-setor']);

	//verificando se já tem alguem cadastrado com o mesmo email
	$query = "SELECT COUNT(*) as total FROM setor WHERE nome_setor = '$nome_setor'";

	$resultado = mysqli_query($conexao, $query) or die (mysqli_error($conexao));
	$row = mysqli_fetch_assoc($resultado);

	//Se for encontrado algum setor com o mesmo nome cadastrado, redireciona para pagina de cadastro com um aviso
	if ($row['total'] == 1) {
		header('Location: ../painel.php?pagina=cadastro-setor&cadastro=nomeerro');
		exit();
	}

	$query = "UPDATE setor SET nome_setor = '$nome_setor', categoria_setor = '$categoria_setor' WHERE idsetor = '$idsetor'";

	return mysqli_query($conexao, $query);
}

function filtroCategoriasetor($categoria) {
	include_once 'model/conexao.php';

	$query = "SELECT * FROM setor WHERE categoria_setor = '$categoria'";

	return mysqli_query($conexao, $query);
}


 ?>