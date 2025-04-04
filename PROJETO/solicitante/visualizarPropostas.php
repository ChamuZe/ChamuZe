<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChamuZé - Propostas</title>
    <link rel="shortcut icon" href="imagens/chamuzeFavicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
</head>
<body class="bg-light vh-100">
    <?php include "../header/header.php"; ?>

    <main class="container">
        <h1 class="text-center mt-4 mb-4">Propostas Disponíveis</h1>
    </main>

    <?php include "../footer.php"; ?>
</body>
</html>