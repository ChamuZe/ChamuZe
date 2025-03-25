<?php
    include 'conexao.php'; // Arquivo com conexão ao banco
    $conn = conectaDB();
    
    if (isset($_POST['btn_solicitar'])) {
        
        $titulo = $_POST['titulo'];
        $descricao = $_POST['descricao'];
        $categoria = $_POST['categoria'];
        $regiao = $_POST['regiao'];
        
    
        $fotoServico = $_FILES['img_servico'];
        $extensao = pathinfo($fotoServico['name'], PATHINFO_EXTENSION); // Obtém a extensão do arquivo
        $extensoesPermitidas = ['jpg', 'jpeg', 'png'];
    
        if (!in_array(strtolower($extensao), $extensoesPermitidas)) {
            echo "<div class=\"alert alert-info\" role=\"alert\">
                    Você só pode enviar arquivos JPG, JPEG ou PNG!
                </div>";
        }
    
        // Gerar um nome único para evitar conflitos
        $novoNome = uniqid() . "." . $extensao;
        $caminho = 'uploads/' . $novoNome;
    
        if (move_uploaded_file($fotoServico['tmp_name'], $caminho)) {
            
            // Salvar os dados no banco
            $sql = "INSERT INTO servicos (titulo, descricao, categoria, regiao, img_servico) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $titulo, $descricao, $categoria, $regiao, $caminho);
            $stmt->execute();
    
            echo "<div class=\"alert alert-success\" role=\"alert\">
                    Serviço solicitado com sucesso!
                </div>";
        } else {
            echo "<div class=\"alert alert-danger\" role=\"alert\">
                    Ops, algo deu errado
                    O serviço não foi solicitado!
                </div>";
            
        
        }
    }    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChamuZé - Solicitar Serviço</title>
    <link rel="shortcut icon" href="imagens/chamuzeFavicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light vh-100">
    <?php include __DIR__ . "/header.php";?>
        <main class="container d-flex flex-column justify-content-center">
            <h1 class="text-center mt-4 mb-4">Solicitar Serviço</h1>
            <form action="solicitarServico.php" method="POST" enctype="multipart/form-data" class="bg-white p-4 shadow-sm rounded">
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

                <!-- Botão de envio -->
                <div class="d-flex justify-content-center">
                    <button type="submit" name="btn_solicitar" class="btn btn-warning w-100">Solicitar</button>
                </div>
            </form>
        </main>
        
    <?php include __DIR__ . "/footer.php";?>
</body>
</html>