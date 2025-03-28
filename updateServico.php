<?php
include 'conexao.php'; 
$conexao = conectaDB();
$id_servico = $_POST['id_servico1'];

if (isset($_POST['btn_solicitar'])) {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $categoria = $_POST['categoria'];
    $regiao = $_POST['regiao']; 
    $fotoServico = $_FILES['img_servico'];

    // Verificando e tratando o upload da imagem (se fornecido)
    if (!empty($fotoServico['name'])) {
        $extensao = pathinfo($fotoServico['name'], PATHINFO_EXTENSION); 
        $extensoesPermitidas = ['jpg', 'jpeg', 'png'];

        if (!in_array(strtolower($extensao), $extensoesPermitidas)) {
            echo "<div class=\"alert alert-info\" role=\"alert\">
                    Você só pode enviar arquivos JPG, JPEG ou PNG!
                </div>";
            exit;
        }

        $novoNome = uniqid() . "." . $extensao;
        $caminho = 'uploads/' . $novoNome;

        if (!move_uploaded_file($fotoServico['tmp_name'], $caminho)) {
            echo "<div class=\"alert alert-danger\" role=\"alert\">
                    Ops, algo deu errado. O serviço não foi alterado!
                </div>";
            exit;
        }
    } else {
        // Caso não envie foto, mantém o valor anterior ou define como null
        $caminho = null;
    }

    // Montando a consulta SQL para atualizar o serviço
    $sql = "UPDATE servicos SET titulo = ?, descricao = ?, categoria = ?, regiao = ?";
    if ($caminho) {
        $sql .= ", img_servico = ?";
    }
    $sql .= " WHERE id_servico = ?";

    // Preparando e executando a consulta
    $stmt = $conexao->prepare($sql);
    if ($caminho) {
        $stmt->bind_param("sssssi", $titulo, $descricao, $categoria, $regiao, $caminho, $id_servico);
    } else {
        $stmt->bind_param("ssssi", $titulo, $descricao, $categoria, $regiao, $id_servico);
    }

    // Verificando a execução da consulta
    if ($stmt->execute()) {
        echo "<div class=\"alert alert-success\" role=\"alert\">
                Serviço Alterado com sucesso!
            </div>";
    } else {
        echo "<div class=\"alert alert-danger\" role=\"alert\">
                Erro ao atualizar serviço: " . $stmt->error . "
            </div>";
    }

    // Fechando a consulta e a conexão
    $stmt->close();
    $conexao->close();
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChamuZé - Modificar Serviço</title>
    <link rel="shortcut icon" href="imagens/chamuzeFavicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light vh-100">
    <?php include __DIR__ . "/header.php"; ?>
    <main class="container d-flex flex-column justify-content-center">
        <h1 class="text-center mt-4 mb-4">Alterar Serviço</h1>
        <h1 class="text-center mt-4 mb-4">ID <strong><?= $id_servico ?></strong></h1>
        <form action="updateServico.php" method="POST" enctype="multipart/form-data" class="bg-white p-4 shadow-sm rounded">
            <!-- Título do serviço -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Título do Serviço</label>
                <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Título do Serviço" required>
            </div>

            <!-- Descrição do serviço -->
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição do Serviço</label>
                <textarea class="form-control" name="descricao" id="descricao" placeholder="Descrição do serviço" rows="4" required></textarea>
            </div>

            <!-- Imagem do serviço -->
            <div class="mb-3">
                <label for="img_servico" class="form-label">Imagem do Serviço</label>
                <input type="file" class="form-control" name="img_servico" id="img_servico">
            </div>

            <!-- Categoria do serviço -->
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria</label>
                <select class="form-select" name="categoria" id="categoria" required>
                    <option value="construcao">Construção</option>
                    <option value="encanamento">Encanamento</option>
                    <option value="jardinagem">Jardinagem</option>
                </select>
            </div>

            <!-- Região do serviço -->
            <div class="mb-3">
                <label for="regiao" class="form-label">Região</label>
                <select class="form-select" name="regiao" id="regiao" required>
                    <option value="abranches">Abranches</option>
                    <option value="agua_verde">Água Verde</option>
                    <option value="ahu">Ahú</option>
                    <option value="alto_boqueirao">Alto Boqueirão</option>
                    <option value="alto_da_gloria">Alto da Glória</option>
                    <option value="alto_da_rua_xv">Alto da Rua XV</option>
                    <option value="atuba">Atuba</option>
                    <option value="augusta">Augusta</option>
                    <option value="bacacheri">Bacacheri</option>
                </select>
            </div>

            <input type="hidden" name="id_servico1" value="<?= $id_servico ?>">

            <!-- Botão de envio -->
            <div class="d-flex justify-content-center">
                <button type="submit" name="btn_solicitar" class="btn btn-warning w-100">Alterar Serviço</button>
            </div>
        </form>
    </main>
    <?php include __DIR__ . "/footer.php"; ?>
</body>
</html>
