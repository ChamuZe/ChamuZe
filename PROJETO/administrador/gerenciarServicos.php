<?php
session_start();
include "../classes/Servico.php"; // Incluindo a classe de serviço

// Verificar se o ID do serviço foi passado
if (isset($_POST['id_servico'])) {
    $id_servico = $_POST['id_servico'];

    // Excluir o serviço
    if ($servico->excluir($id_servico)) {
        // Após excluir, redirecionar para a página de gerenciamento
        header("Location: gerenciarServicos.php?erro=0"); // 0 é para sucesso
        exit; // Após header, a execução deve parar
    } else {
        // Se não foi possível excluir, redireciona com erro
        header("Location: gerenciarServicos.php?erro=1"); // 1 é para erro
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Serviços</title>
    <!-- Seus links de CSS e outros head -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/estilo.css">
</head>

<body>
    <?php include "../header/header.php"; ?>

    <div class="container">
        <h1 class="mt-4 mb-4">Gerenciar Serviços</h1>
        <?php
        if (isset($_GET['erro'])) {
            switch ($_GET['erro']) {
                case 0:
                    echo '<div class="alert alert-success">Serviço excluído com sucesso!</div>';
                    break;
                case 1:
                    echo '<div class="alert alert-danger">Erro ao excluir o serviço.</div>';
                    break;
            }
        }
        ?>
        

        <!-- Exibir a lista de serviços aqui -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
            <?php
            $servico = new Servico();
            $servicos = $servico->buscarTodos(); // Ajuste conforme necessário
            foreach ($servicos as $servico) :
            ?>
                <div class="col">
                    <div class="card shadow-sm h-100">
                        <!-- Cabeçalho do Card -->
                        <div class="card-header d-flex justify-content-between">
                            <h5 class="card-title mb-0"><?= $servico['titulo'] ?></h5>
                        </div>

                        <!-- Corpo do Card -->
                        <div class="card-body d-flex">
                            <!-- Imagem do Serviço -->
                            <div class="flex-shrink-0 me-3">
                                <img src="<?= $servico['img_servico'] ?>" class="img-fluid rounded" alt="Imagem do Serviço"
                                    style="max-width: 150px; max-height: 150px; object-fit: cover;">
                            </div>

                            <!-- Informações do Serviço -->
                            <div class="flex-grow-1">
                                <p><strong>Solicitante:</strong> </p>
                                <p><strong>Categoria:</strong> <?= $servico['categoria'] ?></p>
                                <p><strong>Região:</strong> <?= $servico['local_servico'] ?></p>
                                <p><strong>Preço:</strong> R$: <?= number_format($servico['preco'], 2, ',', '.') ?></p>
                                <p><strong>Status:</strong> <?= $servico['status_servico'] ?></p>
                            </div>
                        </div>

                        <!-- Rodapé com Botões -->
                        <div class="card-footer d-flex flex-wrap justify-content-end gap-2">
                            <form method="POST" action="gerenciarServicos.php" class="d-inline">
                                <input type="hidden" name="id_servico" value="<?= $servico['id_servico'] ?>">
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
