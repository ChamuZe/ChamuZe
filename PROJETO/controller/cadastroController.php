<?php
session_start();
include "../classes/Cadastro.php";

// Verifica se o formulário foi submetido
if (isset($_POST['btn_enviar'])) {
    if ($_POST['senha'] !== $_POST['senhaConfirmada']) {
        header('location:../cadastro.php?erro=2&tipo_perfil='.$_POST['tipo_perfil']);
    }
    var_dump($_POST);

    if ($_POST['tipo_perfil'] === 'prestador'){
        $fotoRG = $_FILES['img_rg'];
        $extensao = pathinfo($fotoRG['name'], PATHINFO_EXTENSION);
        $extensoesPermitidas = ['jpg', 'jpeg', 'png'];

        $novoNome = uniqid() . "." . $extensao;
        $caminho = '../uploads/rg/' . $novoNome;

        // Verifica se a extensão é permitida
        if (!in_array(strtolower($extensao), $extensoesPermitidas)) {
            header('location:../cadastro.php?erro=3&tipo_perfil='.$_POST['tipo_perfil']);
            exit();
        }
        if (move_uploaded_file($fotoRG['tmp_name'], $caminho)) {

            // Salva os dados no banco
            $cadastro = new Cadastro(
                $_POST['nome'],
                $_POST['snome'],
                $_POST['email'], 
                $_POST['senha'],
                $_POST['cpf'],
                $_POST['telefone'],
                $_POST['datanasc'],
                $_POST['genero'],
                $_POST['tipo_perfil'],
                $_POST['cnpj'],
                $caminho,
                $_POST['chavepix']
            );
        }else{
            header('location:../cadastro.php?erro=4&tipo_perfil='.$_POST['tipo_perfil']);
        }

    }else{
        $cadastro = new Cadastro(
            $_POST['nome'],
            $_POST['snome'],
            $_POST['email'], 
            $_POST['senha'],
            $_POST['cpf'],
            $_POST['telefone'],
            $_POST['datanasc'],
            $_POST['genero'],
            $_POST['tipo_perfil'],
        );
    }
    
    $usuario = $cadastro->buscarNoBanco();
    if ($usuario) {
        header('location:../cadastro.php?erro=1&tipo_perfil='.$_POST['tipo_perfil']);
    }else{
        $cadastro->salvar();
        header('location:../login.php?erro=0');
    }

}else{
    header("cadastro.php");
}
?>