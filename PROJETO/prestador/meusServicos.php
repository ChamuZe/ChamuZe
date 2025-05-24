<?php
session_start();

// Verificar se é um prestador
if ($_SESSION['usuario']['tipo_perfil'] != "prestador") {
    header("Location: ../index.php");
    exit();
}

include "../classes/Servico.php";
include "../helpers/biblioteca.php";

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
    <link rel="stylesheet" href="../assets/css/estilo.css">
    <link rel="stylesheet" href="../assets/css/estrelas.css">
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
    <main class="container vh-100">
        <h1 class="text-center mb-4">Meus Serviços</h1>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
            <?php if (count($servicosAceitos) > 0): ?>
                <?php foreach ($servicosAceitos as $row): ?>
    <div class="col">
        <a href="visualizarMeusServicos.php?id_servico=<?= $row['id_servico'] ?>" class="text-decoration-none text-dark">
            <div class="card shadow-sm ">
                <div class="card-header">
                    <h5 class="card-title mb-0"><?= $row['titulo'] ?></h5>
                </div>
                <div class="col">
                    <div class="row-1">
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
                    <div class="row-2">
                        <form action="../solicitante/paginaSolicitante.php" method="GET">
                            <?php $solicitante = buscarSolicitanteNoBancoPeloId($row['id_solicitante']) ?>
                            <button class="botao-prestador-responsavel"
                                style="display:<?= $stiloPrestadorResponsavel ?>;"
                                name="id_solicitante"
                                value="<?= $row['id_solicitante'] ?>">
                                <strong><i class="bi bi-person-video"></i> Solicitante:</strong> <?= $solicitante['nome'] ?>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </a>
        <div class="card card-footer">
            <form action="#">
                <button>Marcar como concluído</button>
            </form>
            <!-- Botão para abrir modal de avaliação -->
            <form action="#">
                <button type="button" class="btn btn-warning" style="display: <?= $visibilidadeBotaoAvaliacaoPrestador ?>" data-bs-toggle="modal" data-bs-target="#avaliarModal<?= $row['id_servico'] ?>">
                    <i class="bi bi-star-half"></i> Avaliar Solicitante
                </button>
            </form>
        </div>

        <!-- Modal de avaliação específico para cada serviço -->
        <div class="modal fade" id="avaliarModal<?= $row['id_servico'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="avaliarModalLabel<?= $row['id_servico'] ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="avaliarModalLabel<?= $row['id_servico'] ?>">Avaliação</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>

                    <div class="modal-body">
                        <form action="../controller/avaliarPrestadorController.php" method="POST" enctype="multipart/form-data">
                            <div class="estrelas">
                                <label for="zero_estrela_<?= $row['id_servico'] ?>"><i class="bi bi-star-fill zero_estrela"></i></label>
                                <input type="radio" id="zero_estrela_<?= $row['id_servico'] ?>" name="estrela" value="0" checked>

                                <label for="estrela_um_<?= $row['id_servico'] ?>"><i class="bi bi-star-fill"></i></label>
                                <input type="radio" id="estrela_um_<?= $row['id_servico'] ?>" name="estrela" value="1">

                                <label for="estrela_dois_<?= $row['id_servico'] ?>"><i class="bi bi-star-fill"></i></label>
                                <input type="radio" id="estrela_dois_<?= $row['id_servico'] ?>" name="estrela" value="2">

                                <label for="estrela_tres_<?= $row['id_servico'] ?>"><i class="bi bi-star-fill"></i></label>
                                <input type="radio" id="estrela_tres_<?= $row['id_servico'] ?>" name="estrela" value="3">

                                <label for="estrela_quatro_<?= $row['id_servico'] ?>"><i class="bi bi-star-fill"></i></label>
                                <input type="radio" id="estrela_quatro_<?= $row['id_servico'] ?>" name="estrela" value="4">

                                <label for="estrela_cinco_<?= $row['id_servico'] ?>"><i class="bi bi-star-fill"></i></label>
                                <input type="radio" id="estrela_cinco_<?= $row['id_servico'] ?>" name="estrela" value="5">

                                <input type="hidden" name="id_avaliado" value="<?= $row['id_solicitante'] ?>">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-warning" value="avaliar">Avaliar</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-primary text-center">
                        Nenhum serviço aceito até o momento.
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <?php include "../footer.php"; ?>
</body>

</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
