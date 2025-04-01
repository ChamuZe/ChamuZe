<?php
session_start();
include "../classes/Servico.php";

// Verifica se o formulário foi submetido
if (isset($_POST['btn_solicitar'])) {

    // Processa a imagem
    $fotoServico = $_FILES['img_servico'];
    $extensao = pathinfo($fotoServico['name'], PATHINFO_EXTENSION); // Obtém a extensão do arquivo
    $extensoesPermitidas = ['jpg', 'jpeg', 'png'];

    // Verifica se a extensão é permitida
    if (!in_array(strtolower($extensao), $extensoesPermitidas)) {
        echo "<div class=\"alert alert-info\" role=\"alert\">
                Você só pode enviar arquivos JPG, JPEG ou PNG!
            </div>";
    }

    // Gera um nome único para a imagem
    $novoNome = uniqid() . "." . $extensao;
    $caminho = '../uploads/' . $novoNome;

    //Cria a instancia servico
    $servico = new Servico();

    // Move o arquivo para o diretório de uploads e salva os dados no banco
    if (move_uploaded_file($fotoServico['tmp_name'], $caminho)) {

        // Salva os dados no banco
        $servico->salvar($_POST['titulo'], $_POST['descricao'], $_POST['categoria'], $_POST['regiao'], $caminho, 0.00);

        echo "<div class=\"alert alert-success\" role=\"alert\">
                Serviço solicitado com sucesso!
            </div>";

        // Redireciona para a página de visualização dos serviços
        header("Location: ../visualizarServicos.php");
        exit();

    } else {
        
        echo "<div class=\"alert alert-danger\" role=\"alert\">
                Ops, algo deu errado. O serviço não foi solicitado!
            </div>";
    }
}
?>