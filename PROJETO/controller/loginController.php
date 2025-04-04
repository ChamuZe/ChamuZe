<?php
session_start();
include_once "../classes/Login.php";
if (isset($_POST['btn_login'])) {
    $login = new Login($_POST['email'],$_POST['senha']);

    $usuario = $login->buscarNoBanco();
    if($usuario == false){
        //Redireciona para o index.php com erro 1
        header('location:../index.php?erro=1'); //Erro 1 caso o usuário não exista
    } else {
        if($_POST['email'] == $usuario['email'] AND password_verify($_POST['senha'], $usuario['senha'])){
            $_SESSION['login'] = true;
            $_SESSION['usuario'] = $usuario;
            if (isset($_SESSION['usuario']['tipo_perfil'])){
                switch ($_SESSION['usuario']['tipo_perfil']){
                    case "solicitante":
                        header('location:../solicitante/inicialSolicitante.php');
                        break;
                    case "prestador":
                        header('location:../prestador/inicialPrestador.php');
                        break;
                    case "administrador":
                        header('location:../administrador/inicialAdministrador.php');
                        break;
                }
            }
            
        } else {
            header('location:../index.php?erro=2'); //Erro 2 caso o usuário informou os dados incorretamente
        }
        
    }
}
?>