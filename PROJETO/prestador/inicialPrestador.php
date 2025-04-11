<?php
session_start();
include "../classes/Servico.php";

$servico = new Servico();
$servicos = $servico->buscarTodos(); // Buscar todos os serviços do sistema
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChamuZé - Início Prestador</title>
    <link rel="shortcut icon" href="imagens/chamuzeFavicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estiloInicialPrestador.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light vh-100">
    <?php include "../header/header.php"; ?>

    <main class="container flex-grow-1 py-4 vh-100">
        <h1 class="text-center mt-4 mb-4">Serviços Disponíveis</h1>

        <?php if (count($servicos) < 1): ?>
            <div class="alert alert-info mt-4" role="alert">
                Nenhum serviço disponível no momento.
            </div>
        <?php endif; ?>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
            <?php foreach ($servicos as $row): 
                if($row['status_servico'] == "aceito"){
                    $headerCard = "card-header bg-success-subtle d-flex justify-content-between";
                    $letraCard = "block";
                } else {
                    $headerCard = "card-header d-flex";
                    $letraCard = "none";
                }
                ?>
                <div class="col">
                    <a href="verServico.php?id_servico=<?= $row['id_servico'] ?>" class="text-decoration-none text-dark">
                        <div class="card shadow-sm h-100 position-relative">
                            <span class="stretched-link"></span>

                            <div class="<?= $headerCard ?>">
                                <h5 class="card-title mb-0"><?= $row['titulo'] ?></h5>
                                <div style="display:<?= $letraCard ?>">
                                    <i class="bi bi-check2-circle"></i> Serviço Aceito
                                </div>
                            </div>

                            <div class="card-body d-flex flex-column flex-md-row">
                                <div class="flex-shrink-0 me-md-3 mb-3 mb-md-0 text-center">
                                    <img src="<?= $row['img_servico'] ?>" class="img-fluid rounded" alt="Imagem do Serviço" style="max-width: 150px; max-height: 150px; object-fit: cover;">
                                </div>

                                <div class="flex-grow-1">
                                    <p class="text-muted mb-1 small"><strong>Categoria:</strong> <?= $row['categoria'] ?></p>
                                    <p class="text-muted mb-1 small"><strong>Região:</strong> <?= $row['local_servico'] ?></p>
                                    <p class="card-text small"><?= $row['descricao'] ?></p>
                                    <p class="text-muted mb-2 small"><strong>Disponibilidade Serviço:</strong> <?= $row['status_servico'] ?></p>
                                    <p class="fw-bold text-success mb-0" style="font-size: 1.1em;">
                                        <i class="bi bi-currency-dollar"></i> R$: <?= $row['preco'] ?>
                                    </p>
                                </div>
                            </div>

                            <div class="card-footer d-flex justify-content-end">
                                <!-- Botões futuros -->
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <?php include "../footer.php"; ?>
</body>
</html>
