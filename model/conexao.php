<?php 
//Criando a conexão com o Banco de Dados
// error_reporting('E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED & ~E_WARNING');
// error_reporting = E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED & ~E_WARNING
$conexao = mysqli_connect('localhost', 'root', '', 'patrimonio2') or die ('Erro ao tentar conectar');
// mysqli_set_charset($conexao, 'utf8');

mysqli_query($conexao, "SET NAMES 'utf8'");
mysqli_query($conexao, 'SET character_set_connection=utf8');
mysqli_query($conexao, 'SET character_set_client=utf8');
mysqli_query($conexao, 'SET character_set_results=utf8');


?>