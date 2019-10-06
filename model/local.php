<?php 

function validarLocal($local, $idlocal = null) {
	$erros = array();

	$bem = isset($local['bem']) && trim($local['bem']) ? trim($local['bem']) : null;	
	$setor = isset($local['setor']) && trim($local['setor']) ? trim($local['setor']) : null;
	$data = isset($local['data']) && trim($local['data']) ? trim($local['data']) : null;

	if (!$bem) {
		$erros[] = 'bem';
	}

	if (!$setor) {
		$erros[] = 'setor';
	}

	return array(
		'erros' => $erros,
		'local' => array(
			'bem' => $bem,
			'setor' => $setor,
			'data' => $data,
		)
	);
}


function inserirLocal($local) {
	include_once '../model/conexao.php';

	$bem = mysqli_real_escape_string($conexao, $local['bem']);	
	$setor = mysqli_real_escape_string($conexao, $local['setor']);
	$data = mysqli_real_escape_string($conexao, $local['data']);

	$query = "INSERT INTO localidade (dt_inicio, idsetor, idbem, status_local) 
	VALUES (now(), '$setor', '$bem', 1)";

	return mysqli_query($conexao, $query) or die (mysqli_error($conexao));

}


function atualizarLocal($local, $idlocal) {
	include '../model/conexao.php';

	$bem = mysqli_real_escape_string($conexao, $local['bem']);	
	$setor = mysqli_real_escape_string($conexao, $local['setor']);
	$data = mysqli_real_escape_string($conexao, $local['data']);
	$data_final = mysqli_real_escape_string($conexao, $local['data-final']);

	$query = "UPDATE localidade SET dt_inicio = '$data', dt_fim = '$data_final', idsetor = '$setor', idbem = '$bem' WHERE idlocal = '$idlocal'";

	return mysqli_query($conexao, $query);
}

function transferirLocal($local, $idlocal){
	include_once '../model/conexao.php';

	$bem = mysqli_real_escape_string($conexao, $local['bem']);	
	$setor = mysqli_real_escape_string($conexao, $local['setor']);
	$data = mysqli_real_escape_string($conexao, $local['data']);

	$query = "INSERT INTO localidade (dt_inicio, idsetor, idbem, status_local) 
	VALUES (now(), '$setor', '$bem', 1)";

	$query = mysqli_query($conexao, $query);


	$query = "UPDATE localidade SET dt_fim = now(), status_local = 0 WHERE idlocal = '$idlocal'";

	return mysqli_query($conexao, $query);
}

function consultarLocal($idlocal = null, $inicio = null, $registros_por_pagina = null){
	include_once 'model/conexao.php';

	$query = "SELECT * FROM localidade l 
	INNER JOIN bem b on b.idbem = l.idbem 
	INNER JOIN setor s on s.idsetor = l.idsetor";

	if ($idlocal) {
		$query .= ' WHERE l.idlocal = ' . $idlocal;
	} 

	if (!$idlocal) {
		if ($inicio) {
			$query .= " ORDER BY l.idlocal DESC LIMIT $inicio, $registros_por_pagina";
		} else {
			$query .= " ORDER BY l.idlocal DESC LIMIT $registros_por_pagina";
		}
	}

	return mysqli_query($conexao, $query);
}

function listarLocal() {
	//Conexão com Banco de Dados
	include 'model/conexao.php';
	$query = "SELECT * FROM localidade";
	return mysqli_query($conexao, $query);
}



function consultarBensLocal(){
	include 'model/conexao.php';
	$query = "SELECT * FROM bem WHERE idbem NOT IN (SELECT idbem FROM localidade) and situacao = 1";

	return mysqli_query($conexao, $query);
}

function consultarBemLocal($idbem){
	include 'model/conexao.php';
	$query = "SELECT * FROM bem where idbem = $idbem";

	return mysqli_query($conexao, $query);
}

function consultarSetoresLocal(){
	include 'model/conexao.php';
	$query = "SELECT * FROM setor";

	return mysqli_query($conexao, $query);
}

function consultarSetorLocal($idsetor){
	include 'model/conexao.php';
	$query = "SELECT * FROM setor where idsetor = $idsetor";

	return mysqli_query($conexao, $query);
}


function filtroSetorLocal($setor){
	include 'model/conexao.php';

	$query = "SELECT *,case(b.operacao)
	when 1 then 'Compra'
	when 2 then 'Transferência'
	when 3 then 'Doação'
	end as 'nome_operacao', 
	case(b.situacao) 
	when 1 then 'Ativo'
	when 2 then 'Processo de Baixa'
	when 3 then 'Morto'
	end as 'nome_situacao' FROM localidade l 
	INNER JOIN bem b on b.idbem = l.idbem 
	INNER JOIN setor s on s.idsetor = l.idsetor 
	WHERE s.idsetor = $setor and l.status_local = 1";

	return mysqli_query($conexao, $query);
}

function RelatorioSetorLocal($setor){
	include '../model/conexao.php';

	$query = "SELECT *,case(b.operacao)
	when 1 then 'Compra'
	when 2 then 'Transferência'
	when 3 then 'Doação'
	end as 'nome_operacao', 
	case(b.situacao) 
	when 1 then 'Ativo'
	when 2 then 'Processo de Baixa'
	when 3 then 'Morto'
	end as 'nome_situacao' FROM localidade l 
	INNER JOIN bem b on b.idbem = l.idbem 
	INNER JOIN setor s on s.idsetor = l.idsetor 
	WHERE s.idsetor = $setor";

	return mysqli_query($conexao, $query);
}

function filtroInventarioLocal($inventario){
	include 'model/conexao.php';

	$query = "SELECT *,case(b.operacao)
	when 1 then 'Compra'
	when 2 then 'Transferência'
	when 3 then 'Doação'
	end as 'nome_operacao', 
	case(b.situacao) 
	when 1 then 'Ativo'
	when 2 then 'Processo de Baixa'
	when 3 then 'Morto'
	end as 'nome_situacao' FROM localidade l 
	INNER JOIN bem b on b.idbem = l.idbem 
	INNER JOIN setor s on s.idsetor = l.idsetor 
	WHERE b.nr_inventario like '%$inventario%' ORDER BY l.dt_inicio desc";

	return mysqli_query($conexao, $query);
}


 ?>