<?php
session_start();
include_once "../classes/Login.php";
include_once "../classes/Usuario.php";

if (isset($_POST['btn_login'])) {
    $login = new Login($_POST['email'], $_POST['senha']);
    $usuarioObj = new Usuario();

    $usuario = $login->buscarNoBanco();
    if ($usuario == false) {
        // Redireciona para o index.php com erro 1
        header('location:../login.php?erro=1'); // Erro 1 caso o usuário não exista
        exit;
    } else {
        if ($_POST['email'] == $usuario['email'] AND password_verify($_POST['senha'], $usuario['senha'])) {
            if ($usuario['tipo_perfil'] == "prestador") {
                $usuarioPrestador = $usuarioObj->buscarPorId("prestador", $usuario['id_usuario']);
                if ($usuarioPrestador['status_avaliacao'] != "aprovado") {
                    header('location:../login.php?erro=3'); // Erro 4 Prestador não avaliado  
                    exit;
                }
            }
            $_SESSION['login'] = true;
            $_SESSION['usuario'] = $usuario;
            if (isset($_SESSION['usuario']['tipo_perfil'])) {
                switch ($_SESSION['usuario']['tipo_perfil']) {
                    case "solicitante":
                        header('location:../solicitante/inicialSolicitante.php');
                        exit;
                        break;
                    case "prestador":
                        header('location:../prestador/inicialPrestador.php');
                        exit;
                        break;
                    case "administrador":
                        header('location:../administrador/inicialAdministrador.php');
                        exit;
                        break;
                }
            }
        } else {
            header('location:../login.php?erro=2'); // Erro 2 caso o usuário informou os dados incorretamente
            exit;
        }
    }
}
?>
