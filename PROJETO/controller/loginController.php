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
            $_SESSION['inicioSessao'] = time();
            $_SESSION['usuario'] = $usuario;
            if (isset($_SESSION['usuario']['tipo_perfil'])) {
                switch ($_SESSION['usuario']['tipo_perfil']) {
                    case "solicitante":
                        echo '<script>
                            window.location.href = "../solicitante/inicialSolicitante.php";
                        </script>';
                        exit;
                        break;
                    case "prestador":
                        echo '<script>
                            window.location.href = "../prestador/inicialPrestador.php";
                        </script>';
                        exit;
                        break;
                    case "administrador":
                        echo '<script>
                            window.location.href = "../administrador/inicialAdministrador.php";
                        </script>';
                        exit;
                        break;
                }
            }
        } else {
            echo '<script>
                sessionStorage.removeItem("caminhoPercorrido");
                window.location.href = "../prestador/inicialPrestador.php";
            </script>';
            exit;
        }
    }
}
?>
