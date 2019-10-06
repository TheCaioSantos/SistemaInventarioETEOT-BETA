<?php

include_once 'model/conexao.php';

$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "select nr_inventario, identificacao from bem where nr_inventario like '%$q%'";

$rsd = mysqli_query($conexao, $sql);

while($rs = mysqli_fetch_array($rsd)) {
	echo $rs['nr_inventario']." - ".$rs['identificacao']."\n";
}
?>