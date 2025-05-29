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
    <link rel="stylesheet" href="../assets/css/estiloperfilusuario.css">
</head>

<body>

    <?php include "../header/header.php"; ?>

    <div class="container mt-5 vh-100 d-flex justify-content-center align-items-center">
        <div class="perfil-container w-75">
            <h2 class="text-center mb-4">Perfil do Usuário</h2>

            <?php if (isset($_SESSION['usuario'])): ?>
                <?php
                // Pegando os dados da sessão
                $usuario = $_SESSION['usuario'];
                ?>

                <table class="table perfil-table">
                    <tbody>
                        <tr>
                            <th>Nome:</th>
                            <td><?= $usuario['nome']; ?></td>
                        </tr>
                        <tr>
                            <th>Sobrenome:</th>
                            <td><?= $usuario['sobrenome']; ?></td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td><?= $usuario['email']; ?></td>
                        </tr>
                        <tr>
                            <th>CPF:</th>
                            <td><?= $usuario['cpf']; ?></td>
                        </tr>
                        <tr>
                            <th>Telefone:</th>
                            <td><?= $usuario['telefone']; ?></td>
                        </tr>
                        <tr>
                            <th>Nacionalidade:</th>
                            <td><?= $usuario['nacionalidade']; ?></td>
                        </tr>
                        <tr>
                            <th>Data de Nascimento:</th>
                            <td><?= date('d/m/Y', strtotime($usuario['data_nascimento'])); ?></td>
                        </tr>
                        <tr>
                            <th>Nota de Reputação:</th>
                            <td><?= $usuario['nota_reputacao']; ?></td>
                        </tr>
                        <tr>
                            <th>Gênero:</th>
                            <td><?= $usuario['genero'] == 'F' ? 'Feminino' : ($usuario['genero'] == 'M' ? 'Masculino' : 'Outro'); ?></td>
                        </tr>
                        <tr>
                            <th>Tipo de Perfil:</th>
                            <td><?= ucfirst($usuario['tipo_perfil']); ?></td>
                        </tr>
                    </tbody>
                </table>

                <form method="POST" action="../controller/logOutController.php">
                    <input type="submit" value="Sair" class="btn btn-danger btn-logout">
                </form>

            <?php else: ?>
                <p class="text-center">Você não está logado!</p>
            <?php endif; ?>
        </div>
    </div>

    <?php include "../footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
