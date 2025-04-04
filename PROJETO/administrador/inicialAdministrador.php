<?php
session_start();
if ($_SESSION['usuario']['tipo_perfil'] != "administrador"){
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Serviço - ChamuZé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php include "../header/header.php";?>
<p>Página inicial do ADM</p>
<?php include "../footer.php";?>
</body>
</html>
