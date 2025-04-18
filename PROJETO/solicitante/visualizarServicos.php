<?php
session_start();
include "../classes/Servico.php"; // Incluindo a classe Servico

// Criando a instância da classe Servico
$servico = new Servico();

// Buscar todos os serviços
$servicos = $servico->buscarPorUsuario($_SESSION['usuario']['id_usuario']); // Agora usando o método buscarTodos da classe Servico
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChamuZé - Visualizar Serviços</title>
    <link rel="shortcut icon" href="imagens/chamuzeFavicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
</head>
<body class="bg-light vh-100">
    <?php include "../header/header.php"; ?>

    <main class="container flex-grow-1 py-4 vh-100">
    <?php
        if (isset($_GET['erro'])) {
            switch ($_GET['erro']) {
                case 0:
                    echo '<div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                            O serviço foi excluído com sucesso!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                          </div>';
                    break;
                case 1:
                    echo '<div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                            Ops, algo deu errado. O serviço não foi excluído!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                          </div>';
                    break;
            }
        }
    ?>

    <h1 class="text-center mt-4 mb-4">Serviços Disponíveis</h1>

    <?php if (count($servicos) < 1): ?>
        <div class="alert alert-info mt-4" role="alert">
            Você não possui serviços cadastrados no momento!
        </div>
    <?php endif; ?>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
        <?php foreach ($servicos as $row): 
            if($row['status_servico'] == "aceito"){
                $heaerCard = "card-header bg-success-subtle d-flex justify-content-between";
                $letraCard = "block";
            } else {
                $heaerCard = "card-header d-flex";
                $letraCard = "none";
            }
            ?>
            <div class="col">
                <div class="card shadow-sm h-100">
                    <!-- Cabeçalho do Card -->
                    <div class="<?= $heaerCard?>">
                        <h5 class="card-title mb-0"><?= $row['titulo'] ?></h5>
                        <div style = "display:<?=$letraCard?>">
                        <i class="bi bi-check2-circle"></i> Serviço Aceito
                        </div>
                    </div>

                    <!-- Corpo do Card -->
                    <div class="card-body d-flex flex-column flex-md-row">
                        <!-- Imagem -->
                        <div class="flex-shrink-0 me-md-3 mb-3 mb-md-0 text-center">
                            <img src="<?= $row['img_servico'] ?>" class="img-fluid rounded" alt="Imagem do Serviço" style="max-width: 150px; max-height: 150px; object-fit: cover;">
                        </div>

                        <!-- Texto -->
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

                    <!-- Rodapé com Botões -->
                    <div class="card-footer d-flex flex-wrap justify-content-end gap-2">
                        <form method="POST" action="updateServico.php" class="d-inline">
                            <input type="hidden" name="id_servico" value="<?= $row['id_servico'] ?>">
                            <button type="submit" name="btn-editar" class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil"></i> Editar
                            </button>
                        </form>
                        <form method="POST" action="../controller/deleteServicoController.php" class="d-inline">
                            <input type="hidden" name="id_servico" value="<?= $row['id_servico'] ?>">
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este serviço?')">
                                <i class="bi bi-trash"></i> Excluir
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>


    <?php include "../footer.php"; ?>
</body>
</html>
