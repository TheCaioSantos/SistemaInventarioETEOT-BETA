<?php

function estaLogado() {
    if (
            isset($_SESSION['idusuario']) && trim(isset($_SESSION['idusuario'])) &&
            isset($_SESSION['nome']) && trim(isset($_SESSION['nome'])) &&
            isset($_SESSION['email']) && trim(isset($_SESSION['email'])) &&
            isset($_SESSION['nivel']) && trim(isset($_SESSION['nivel']))
    )
        return true;
    else
        return false;
}

?>