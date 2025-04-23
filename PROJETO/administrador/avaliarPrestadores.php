<?php
session_start();

// Segurança de acesso
if ($_SESSION['usuario']['tipo_perfil'] != "administrador") {
    header("Location: ../index.php");
    exit;
}

include "../classes/Usuario.php";
$usuario = new Usuario();
$usuarios = $usuario->buscarTodos("prestador");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Avaliar Prestador - ChamuZé</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light p-4">
    <?php include "../header/header.php"; ?>

    <?php if (isset($_GET['erro'])): ?>
        <?php
            switch ($_GET['erro']) {
                case 0:
                    echo '<div class="alert alert-success mt-4">O Prestador foi Rejeitado.</div>';
                    break;
                case 1:
                    echo '<div class="alert alert-success mt-4">O Prestador foi Aprovado.</div>';
                    break;
                case 2:
                    echo '<div class="alert alert-danger mt-4">Houve algum erro.</div>';
                    break;
            }
        ?>
    <?php endif; ?>

    <main class="container">
        <h1 class="text-center mt-4 mb-4">Avaliar Prestadores</h1>

        <?php 
        $total = count($usuarios);
        $usuarioaprovadoteste = False;
        foreach ($usuarios as $index => $row){
            if($index === $total - 1){
                if ($row['status_avaliacao'] == 'aprovado'){
                    return $usuarioaprovadoteste = True;
                }
            }
        }
        if (count($usuarios) < 1 || $usuarioaprovadoteste):?>
            <div class="alert alert-info">Nenhum prestador para avaliar.</div>
        <?php else: ?>
            <div class="row">
                <?php foreach ($usuarios as $row): ?>
                    <?php if ($row['status_avaliacao'] == 'naoverificado'): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card shadow p-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div class="me-3">
                                            <p class="text-muted mb-1 small"><strong>Nome:</strong> <?= $row['nome'] ?></p>
                                            <p class="text-muted mb-1 small"><strong>Email:</strong> <?= $row['email'] ?></p>
                                            <p class="text-muted mb-1 small"><strong>CPF:</strong> <?= $row['cpf'] ?></p>
                                            <p class="text-muted mb-1 small"><strong>Chave do pix:</strong> <?= $row['chave_pix'] ?></p>
                                        </div>
                                        <div>
                                            <img src="<?= $row['img_rg'] ?>" class="rounded" alt="Imagem do RG"
                                                 style="width: 180px; height: 250px; object-fit: cover;">
                                        </div>
                                    </div>
                                    <form method="POST" action="..\controller\admDecisaoSobPrestador.php">
                                        <input type="hidden" name="id_usuario" value="<?= $row['id_usuario'] ?>">
                                        <div class="d-flex justify-content-center gap-3">
                                            <button class="btn btn-success px-4" type="submit" name="acao" value="aceito">Aceitar</button>
                                            <button class="btn btn-danger px-4" type="submit" name="acao" value="recusado">Recusar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    <?php include "../footer.php"; ?>
</body>
</html>