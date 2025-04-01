<?php session_start();?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChamuZé - Solicitar Serviço</title>
    <link rel="shortcut icon" href="imagens/chamuzeFavicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilo.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light vh-100">

    <?php include __DIR__ . "/header/header.php";?> <!-- Inclui o cabeçalho -->

    <main class="container d-flex flex-column justify-content-center">
        <h1 class="text-center mt-4 mb-4">Solicitar Serviço</h1>
        <form action="controller/solicitarServicoController.php" method="POST" enctype="multipart/form-data" class="bg-white p-4 shadow-sm rounded">

            <!-- Título do serviço -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Título do Serviço</label>
                <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Título do Serviço">
            </div>

            <!-- Descrição do serviço -->
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição do Serviço</label>
                <textarea class="form-control" name="descricao" id="descricao" placeholder="Descrição do serviço" rows="4"></textarea>
            </div>

            <!-- Imagem do serviço -->
            <div class="mb-3">
                <label for="img_servico" class="form-label">Imagem do Serviço</label>
                <input type="file" class="form-control" name="img_servico" id="img_servico">
            </div>

            <!-- Categoria do serviço -->
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria</label>
                <select class="form-select" name="categoria" id="categoria">
                    <option value="construcao">Construção</option>
                    <option value="encanamento">Encanamento</option>
                    <option value="jardinagem">Jardinagem</option>
                </select>
            </div>

            <!-- Região do serviço -->
            <div class="mb-3">
                <label for="regiao" class="form-label">Região</label>
                <select class="form-select" name="regiao" id="regiao">
                    <option value="abranches">Abranches</option>
                    <option value="agua_verde">Água Verde</option>
                    <option value="ahu">Ahú</option>
                    <option value="alto_boqueirao">Alto Boqueirão</option>
                    <option value="alto_da_gloria">Alto da Glória</option>
                    <option value="alto_da_rua_xv">Alto da Rua XV</option>
                    <option value="atuba">Atuba</option>
                    <option value="augusta">Augusta</option>
                    <option value="bacacheri">Bacacheri</option>
                    <!-- Adicione mais opções conforme necessário -->
                </select>
            </div>

            <!-- Preço do serviço -->
            <div class="mb-3">
                <label for="img_servico" class="form-label">Preço</label>
                <input type="number" class="form-control" name="preco" id="preco">
            </div>

            <!-- Botão de envio -->
            <div class="d-flex justify-content-center">
                <button type="submit" name="btn_solicitar" class="btn btn-warning w-100">Solicitar</button>
            </div>
        </form>
    </main>

    <?php include __DIR__ . "/footer.php";?> <!-- Inclui o rodapé -->

</body>
</html>
