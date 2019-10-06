
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cod = isset($_POST['cod']) ? trim($_POST['cod']) : null;

    include '../model/cod_class.php';

    $classificacoes = consultarCodclass($cod);

    echo json_encode($classificacoes);
    exit;
}




?>