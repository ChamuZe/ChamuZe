<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Chamauze</title>
    <link rel="shortcut icon" href="assets/img/chamuzeFavicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column" style="height: 100vh;">

    <div class="container-fluid d-flex justify-content-center align-items-center flex-grow-1">
        <div class="row w-100">
            <div class="col-12 col-md-6 d-flex justify-content-center align-items-center mb-4 mb-md-0">
                <img src="assets/img/chamuzeLogoSemFundo.png" alt="Logo Chamauze" class="img-fluid" style="max-width: 430px;">
            </div>

            <div class="col-12 col-md-5 bg-white p-5 rounded-5 shadow">
                <h2 class="text-center mb-4">Cadastro</h2>
                 <?php
                 if(isset($_GET['erro']) && $_GET['erro'] == '1'){
                    echo "<div class=\"alert alert-danger\">
                        E-mail de usuário já cadastrado na base de dados!
                    </div>";
                 }
                 ?>
                <form action="controller/cadastroController.php" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail" required>
                    </div>
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="nome" class="form-control" id="nome" name="nome" placeholder="Digite seu nome de usuário" required>
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua senha" required>
                    </div>
                    <button type="submit" class="btn btn-warning w-100 text-dark" name="btn_enviar">Entrar</button>
                </form>
                <div class="text-center mt-3">
                    <p class="mb-0"><a href="index.php">Retornar ao login</a></p>
                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php";?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

