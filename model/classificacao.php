<?php 
function validarClassificacao($classificacao, $idcod_class = null){
	$erros = array();

	//verificando se estar preenchido
	$nr_titulo = isset($classificacao['nr-titulo']) && trim($classificacao['nr-titulo']) ? trim($classificacao['nr-titulo']) : null;	
	$titulo_class = isset($classificacao['titulo-class']) && trim($classificacao['titulo-class']) ? trim($classificacao['titulo-class']) : null;
	$nr_sub = isset($classificacao['nr-sub']) && trim($classificacao['nr-sub']) ? trim($classificacao['nr-sub']) : null;
	$subtitulo_class = isset($classificacao['subtitulo-class']) && trim($classificacao['subtitulo-class']) ? trim($classificacao['subtitulo-class']) : null;
	$valor_depreciacao = isset($classificacao['valor-depreciacao']) && trim($classificacao['valor-depreciacao']) ? trim($classificacao['valor-depreciacao']) : null;
	$data_depreciacao = isset($classificacao['data-depreciacao']) && trim($classificacao['data-depreciacao']) ? trim($classificacao['data-depreciacao']) : null;

	return array(
	 	'erros' => $erros,
	 	'classificacao' => array(
	 		'nr-titulo' => $nr_titulo,
	 		'titulo-class' => $titulo_class,
	 		'nr-sub' => $nr_sub,
	 		'subtitulo-class' => $subtitulo_class,
	 		'valor-depreciacao' => $valor_depreciacao,
	 		'data-depreciacao' => $data_depreciacao,
	 	)
	 );
}

function inserirClassificacao($classificacao) {
	//Conexão com Banco de Dados
	include_once '../model/conexao.php';

	$nr_titulo = $classificacao['nr-titulo'];	
	$titulo_class = $classificacao['titulo-class'];
	$nr_sub = $classificacao['nr-sub'];
	$subtitulo_class = $classificacao['subtitulo-class'];
	$valor_depreciacao = $classificacao['valor-depreciacao'];
	$data_depreciacao = $classificacao['data-depreciacao'];

	$query = "INSERT INTO cod_class (nr_titulo, codclass_titulo, nr_subtitulo, codclass_subtitulo) 
	VALUES ('$nr_titulo', '$titulo_class', '$nr_sub', '$subtitulo_class')";

	$query = mysqli_query($conexao, $query) or die (mysqli_error($conexao));

	$idcod_class = mysqli_insert_id($conexao);

	$query = "INSERT INTO depreciacao (valor_depre, dt_inicio, idcod_class)
	VALUES ('$valor_depreciacao', '$data_depreciacao', '$idcod_class')";

	return mysqli_query($conexao, $query) or die (mysqli_error($conexao));
}

function consultarClassificacao($idcod_class = null, $inicio = null, $registros_por_pagina = null) {
	//Conexão com Banco de Dados
	include_once 'model/conexao.php';
	$query = "SELECT * FROM cod_class cc";
	if ($idcod_class) {
		$query .= ' INNER JOIN depreciacao d on d.idcod_class = cc.idcod_class WHERE cc.idcod_class =' . $idcod_class;
	}

	if (!$idcod_class) {
		if ($inicio) {
			$query .= " ORDER BY cc.idcod_class DESC LIMIT $inicio, $registros_por_pagina";
		} else {
			$query .= " ORDER BY cc.idcod_class DESC LIMIT $registros_por_pagina";
		}
	}

	return mysqli_query($conexao, $query);
}

function listarClassificacao() {
	//Conexão com Banco de Dados
	include 'model/conexao.php';
	$query = "SELECT * FROM cod_class";
	return mysqli_query($conexao, $query);
}

function atualizarClassificacao($classificacao, $idcod_class) {
	include '../model/conexao.php';

	$nr_titulo = $classificacao['nr-titulo'];	
	$titulo_class = $classificacao['titulo-class'];
	$nr_sub = $classificacao['nr-sub'];
	$subtitulo_class = $classificacao['subtitulo-class'];
	$valor_depreciacao = $classificacao['valor-depreciacao'];
	$data_depreciacao = $classificacao['data-depreciacao'];

	$query = "UPDATE cod_class SET nr_titulo = '$nr_titulo', codclass_titulo = '$titulo_class', nr_subtitulo = '$nr_sub', codclass_subtitulo = '$subtitulo_class' WHERE idcod_class = '$idcod_class'";

	$query = mysqli_query($conexao, $query);

	$query = "UPDATE cod_class cc 
	INNER JOIN depreciacao d on d.iddepreciacao = cc.idcod_class 
	SET valor_depre = '$valor_depreciacao', dt_inicio = '$data_depreciacao' 
	WHERE cc.idcod_class = '$idcod_class'";

	return mysqli_query($conexao, $query);
}


function filtroTituloBem($titulo) {
	include_once 'model/conexao.php';

	$query = "SELECT * FROM cod_class WHERE codclass_titulo LIKE '%$titulo%'";

	return mysqli_query($conexao, $query);
}

 ?>