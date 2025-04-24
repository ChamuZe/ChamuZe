<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="shortcut icon" href="../assets/img/chamuzeFavicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <?php include "../header/header.php"; ?>

    <div class="container mt-5 vh-100">
        <h2 class="text-center">Bem-vindo ao seu perfil</h2>
        
        <?php if (isset($_SESSION['usuario'])): ?>
            <?php
            // Pegando os dados da sessão
            $usuario = $_SESSION['usuario'];
            ?>

            <p><strong>Nome:</strong> <?= $usuario['nome']; ?></p>
            <p><strong>Sobrenome:</strong> <?= $usuario['sobrenome']; ?></p>
            <p><strong>Email:</strong> <?= $usuario['email']; ?></p>
            <p><strong>CPF:</strong> <?= $usuario['cpf']; ?></p>
            <p><strong>Telefone:</strong> <?= $usuario['telefone']; ?></p>
            <p><strong>Nacionalidade:</strong> <?= $usuario['nacionalidade']; ?></p>
            <p><strong>Data de Nascimento:</strong> <?= date('d/m/Y', strtotime($usuario['data_nascimento'])); ?></p>
            <p><strong>Nota de Reputação:</strong> <?= $usuario['nota_reputacao']; ?></p>
            <p><strong>Gênero:</strong> <?= $usuario['genero'] == 'F' ? 'Feminino' : ($usuario['genero'] == 'M' ? 'Masculino' : 'Outro'); ?></p>
            <p><strong>Tipo de Perfil:</strong> <?= ucfirst($usuario['tipo_perfil']); ?></p>

        <?php else: ?>
            <p>Você não está logado!</p>
        <?php endif; ?>

        <!-- Botão de Sair -->
        <form method="POST" action="../controller/logOutController.php">
            <input type="submit" value="Sair" class="btn btn-danger">
        </form>
    </div>

    <?php include "../footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
