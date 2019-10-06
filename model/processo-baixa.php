<?php 
function consultarBensAtivo() {
	include 'model/conexao.php';

	$query = "SELECT * FROM bem WHERE situacao = 1";
	return mysqli_query($conexao, $query);
}
 ?>}
