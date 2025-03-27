<?php
include 'conexao.php'; // Conexão com o banco de dados

$conn = conectaDB();

// Buscar todos os serviços
$sql = "SELECT id_servico, titulo, descricao, categoria, regiao, img_servico FROM servicos";
$result = $conn->query($sql);
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
    <?php include __DIR__ . "/header.php"; ?>

    <main class="container">
        <h1 class="text-center mt-4 mb-4">Serviços Disponíveis</h1>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 min-vh-100">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col">
                    <div class="service-container p-3">
                        <div class="service-info yellow-bg">
                            <h5 class="card-title mb-1"><?= $row['titulo'] ?></h5>
                            <p class="text-muted mb-1 small"><?= $row['categoria'] ?></p>
                            <p class="mb-0 small"><?= $row['regiao'] ?></p>
                        </div>
                        
                        <img src="<?= $row['img_servico'] ?>" class="card-img-top" alt="Imagem do Serviço">
                        
                        <div class="card-body">
                            <p class="card-text small"><?= $row['descricao'] ?></p>
                        </div>

                        <div class="card-footer bg-transparent">
                            <form method="POST" action="deleteServico.php" class="d-inline">
                                <input type="hidden" name="id_servico" value="<?= $row['id_servico'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm" 
                                    onclick="return confirm('Tem certeza que deseja excluir este serviço?')">
                                    <i class="bi bi-trash"></i> Excluir
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>

        </div>
    </main>

    <?php include __DIR__ . "/footer.php"; ?>
</body>
</html>
