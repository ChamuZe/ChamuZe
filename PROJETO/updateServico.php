<?php
include "classes/Servico.php"; // Incluindo a classe Servico

// Criando a instância da classe Servico
$servico = new Servico();

// Verificando se o ID do serviço foi passado via GET
if (isset($_POST['id_servico'])) {
    $id_servico = $_POST['id_servico'];
    $servicoData = $servico->buscarPorId($id_servico);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Serviço - ChamuZé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<main class="container mt-5">
    <h1>Editar Serviço</h1>

    <?php if ($servicoData): ?>
        <form method="POST" action="controller/updateServicoController.php" enctype="multipart/form-data">
            <input type="hidden" name="id_servico" value="<?= $servicoData['id_servico'] ?>">

            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" id="titulo" name="titulo" class="form-control" value="<?= $servicoData['titulo'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea id="descricao" name="descricao" class="form-control" rows="4" required><?= $servicoData['descricao'] ?></textarea>
            </div>

            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria</label>
                <input type="text" id="categoria" name="categoria" class="form-control" value="<?= $servicoData['categoria'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="regiao" class="form-label">Região</label>
                <input type="text" id="regiao" name="regiao" class="form-control" value="<?= $servicoData['regiao'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="preco" class="form-label">Preço</label>
                <input type="text" id="preco" name="preco" class="form-control" value="<?= $servicoData['preco'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="img_servico" class="form-label">Imagem do Serviço</label>
                <input type="file" id="img_servico" name="img_servico" class="form-control">
                <small>Imagem atual: <?= $servicoData['img_servico'] ?></small>
            </div>

            <button type="submit" class="btn btn-primary">Atualizar Serviço</button>
        </form>
    <?php else: ?>
        <p>Serviço não encontrado.</p>
    <?php endif; ?>
</main>

</body>
</html>
