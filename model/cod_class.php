<?php


function consultarCodclass($cod){

    require_once '../model/conexao.php';

    $sql = "SELECT * FROM cod_class WHERE nr_titulo = '" . $cod . "'";
    $cod_class = mysqli_query($conexao, $sql);
    $todos = mysqli_fetch_all($cod_class);

    return $todos;
}

function consultarCodclassEditar($cod){

    require 'model/conexao.php';

    $sql = "SELECT * FROM cod_class WHERE nr_titulo = '" . $cod . "'";
    return mysqli_query($conexao, $sql);

}

function consultarCods(){
	require 'model/conexao.php';

	$sql = "SELECT * FROM cod_class GROUP BY nr_titulo ORDER BY codclass_titulo asc";

	return mysqli_query($conexao, $sql);
}
