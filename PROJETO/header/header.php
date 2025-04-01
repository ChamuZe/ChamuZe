<?php
if (isset($_SESSION['usuario']['tipo_usuario'])){
    switch ($_SESSION['usuario']['tipo_usuario']){
        case "solicitante":
            include "headerSolicitante.php";
            break;
        case "prestador":
            include "headerPrestador.php";
            break;
        case "administrador":
            include "headerAdministrador.php";
            break;
    }
} else {

    var_dump($_SESSION['usuario']);

}
?>
