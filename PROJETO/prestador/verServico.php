<?php
session_start();
include "../classes/Servico.php";

if (!isset($_GET['id_servico'])) {
    header("Location: inicialPrestador.php");
    exit();
}

$id_servico = $_GET['id_servico'];

$servico = new Servico();
$dados = $servico->buscarPorId($id_servico);

if (!$dados) {
    header("Location: inicialPrestador.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Serviço - ChamuZé</title>
    <link rel="shortcut icon" href="imagens/chamuzeFavicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <?php include "../header/header.php"; ?>

    <main class="container my-5">
        <div class="card shadow">
            <div class="card-header bg-warning text-dark">
                <h3 class="mb-0"><?= $dados['titulo'] ?></h3>
            </div>

            <div class="card-body row">
                <div class="col-md-4 text-center">
                    <img src="<?= $dados['img_servico'] ?>" alt="Imagem do Serviço" class="img-fluid rounded" style="max-height: 250px; object-fit: cover;">
                </div>

                <div class="col-md-8">
                    <p><strong>Descrição:</strong> <?= $dados['descricao'] ?></p>
                    <p><strong>Categoria:</strong> <?= $dados['categoria'] ?></p>
                    <p><strong>Região:</strong> <?= $dados['local_servico'] ?></p>
                    <p><strong>Status:</strong> <?= $dados['status_servico'] ?></p>
                    <p class="fw-bold text-success" style="font-size: 1.5em;">
                        <i class="bi bi-currency-dollar"></i> R$: <?= $dados['preco'] ?>
                    </p>

                    <div class="service-buttons d-flex justify-content-between mt-4">
                        <form method="POST" action="aceitarServico.php" class="d-inline">
                            <input type="hidden" name="id_servico" value="<?= $dados['id_servico'] ?>">
                            <button type="submit" name="btn-editar" class="btn btn-success btn-lg">
                                <i class="bi bi-check-circle"></i> Aceitar Serviço
                            </button>
                        </form>

                        <form method="GET" action="realizarProposta.php" class="d-inline">
                            <input type="hidden" name="id_servico" value="<?= $dados['id_servico'] ?>">
                            <button type="submit" class="btn btn-warning btn-lg" onclick="return confirm('Tem certeza que deseja realizar esta proposta?')">
                                <i class="bi bi-credit-card"></i> Realizar Proposta
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card-footer text-end">
                <a href="inicialPrestador.php" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Voltar
                </a>
            </div>
        </div>
    </main>

    <?php include "../footer.php"; ?>
</body>
</html>
