<?php
session_start();
include "classes/Servico.php"; // Incluindo a classe Servico

// Criando a instância da classe Servico
$servico = new Servico();

// Buscar todos os serviços
$servicos = $servico->buscarTodos(); // Agora usando o método buscarTodos da classe Servico
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light vh-100">
    <?php include __DIR__ . "/header/header.php"; ?>

    <main class="container">
        <h1 class="text-center mt-4 mb-4">Serviços Disponíveis</h1>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 min-vh-100">
            <?php foreach ($servicos as $row): ?>
                <div class="col">
                    <div class="card shadow-sm">
                        <!-- Cabeçalho do Card com o Título -->
                        <div class="card-header">
                            <h5 class="card-title mb-0"><?= $row['titulo'] ?></h5>
                        </div>

                        <!-- Corpo do Card com Imagem e Informações -->
                        <div class="card-body d-flex">
                            <!-- Lado Esquerdo: Imagem -->
                            <div class="flex-shrink-0 me-3">
                                <img src="uploads/<?= $row['img_servico'] ?>" class="card-img-top" alt="Imagem do Serviço" style="width: 150px; height: 150px; object-fit: cover;">
                            </div>
                            
                            <!-- Lado Direito: Informações Textuais -->
                            <div class="flex-grow-1">
                                <p class="text-muted mb-1 small"><strong>Categoria:</strong> <?= $row['categoria'] ?></p>
                                <p class="text-muted mb-1 small"><strong>Região:</strong> <?= $row['regiao'] ?></p>
                                <p class="card-text small"><?= $row['descricao'] ?></p>

                                <!-- Preço com Destaque -->
                                <p class="fw-bold text-warning mb-3" style="font-size: 1.1em;"><strong>Preço:</strong> R$ <?= number_format($row['preco'], 2, ',', '.') ?></p>
                            </div>
                        </div>

                        <!-- Rodapé do Card com Botões de Editar e Excluir -->
                        <div class="card-footer bg-transparent d-flex justify-content-end">
                            <form method="POST" action="updateServico.php" class="d-inline me-2">
                                <input type="hidden" name="id_servico" value="<?= $row['id_servico'] ?>">
                                <button type="submit" class="btn btn-primary btn-sm"> <!-- Botão de editar azul -->
                                    <i class="bi bi-pencil"></i> Editar
                                </button>
                            </form>
                            <form method="POST" action="controller/deleteServicoController.php" class="d-inline">
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

    <?php include __DIR__ . "/footer.php"; ?>
</body>
</html>
