<?php
    include "../classes/Usuario.php";
    $usuario = new Usuario();
    $id = $_POST['id_usuario'];
    if(isset($_POST['aceito'])){
        $usuario->alterar("prestador", $id, "status_avaliacao", "aprovado");
        header("Location: ../administrador/avaliarPrestadores.php?erro=1");
        exit;
    }
    else if(isset($_POST['recusado'])){
        $usuario->deletarPorID("prestador", $id);
        header("Location: ../administrador/avaliarPrestadores.php?erro=0");
        exit;
    }
?>