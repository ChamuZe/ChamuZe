<?php
session_start();

// Verificar se é um prestador
if ($_SESSION['usuario']['tipo_perfil'] != "prestador") {
    header("Location: ../index.php");
    exit();
}

include "../classes/Servico.php";

$servico = new Servico();
$id_prestador = $_SESSION['usuario']['id_usuario'];

// Buscar apenas os serviços aceitos por este prestador
$servicosAceitos = $servico->buscarServicosPorPrestador($id_prestador);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Meus Serviços Aceitos - ChamuZé</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/img/chamuzeFavicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="estiloMeusServicos.css" rel="stylesheet">
    <style>
        .card-text {
            word-wrap: break-word;
            overflow-wrap: break-word;
            max-height: 100px;
            overflow: hidden;
        }
    </style>
</head>

<body class="bg-light">
    <?php include "../header/headerPrestador.php"; ?>
    <main class="container mt-4">
        <h1 class="text-center mb-4">Meus Serviços</h1>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
            <?php if (count($servicosAceitos) > 0): ?>
                <?php foreach ($servicosAceitos as $row): ?>
                    <div class="col">
                        <a href="visualizarMeusServicos.php?id_servico=<?= $row['id_servico'] ?>"
                            class="text-decoration-none text-dark">
                            <div class="card shadow-sm h-100">
                                <div class="card-header">
                                    <h5 class="card-title mb-0"><?= $row['titulo'] ?></h5>
                                </div>
                                <div class="card-body d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <img src="<?= $row['img_servico'] ?>" class="card-img-top" alt="Imagem do Serviço"
                                            style="width: 150px; height: 150px; object-fit: cover;">
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="text-muted mb-1 small"><strong>Categoria:</strong>
                                            <?= $row['categoria'] ?? 'Não informada' ?></p>
                                        <p class="text-muted mb-1 small"><strong>Região:</strong>
                                            <?= $row['local_servico'] ?? 'Não informada' ?></p>
                                        <?php
                                        $descricao = strlen($row['descricao']) > 150 ? substr($row['descricao'], 0, 150) . '...' : $row['descricao'];
                                        ?>
                                        <p class="card-text small"><?= $descricao ?></p>
                                        <p class="fw-bold text-success mb-3" style="font-size: 1.1em;">
                                            <strong>Preço:</strong> R$ <?= number_format($row['preco'], 2, ',', '.') ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        Nenhum serviço aceito até o momento.
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <?php include "../footer.php"; ?>
</body>

</html>