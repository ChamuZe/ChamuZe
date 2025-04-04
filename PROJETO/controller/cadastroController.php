<?php
session_start();
include "../classes/Cadastro.php";
$tipoUsuario="solicitante";

// Verifica se o formulário foi submetido
if (isset($_POST['btn_enviar'])) {
    $cadastro = new Cadastro($_POST['email'],$_POST['senha'],$tipoUsuario, $_POST['nome']);

    $usuario = $cadastro->buscarNoBanco();
    if ($usuario) {
        header('location:../cadastro.php?erro=1');
    }else{
        $cadastro->salvar();
        header("Location: ../index.php");
        exit();
    }

}
?>