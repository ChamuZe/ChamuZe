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

    <div class="container-fluid d-flex justify-content-center align-items-center flex-grow-1 p-3">
        <div class="row w-100">
            <div class="col-12 col-md-6 d-flex justify-content-center align-items-center mb-4 mb-md-0">
                <img src="assets/img/chamuzeLogoSemFundo.png" alt="Logo Chamauze" class="img-fluid" style="max-width: 430px;">
            </div>

            <div class="col-12 col-md-5 bg-white p-5 rounded-5 shadow">
                <h2 class="text-center mb-4">Cadastro</h2>
                 <?php
                 if (isset($_GET['erro'])){
                    switch ($_GET['erro']){
                        case 1:
                            echo "<div class=\"alert alert-danger\">
                            E-mail de usuário já cadastrado na base de dados
                            </div>";
                            break;
                        case 2: 
                            echo "<div class=\"alert alert-danger\">
                            Senhas diferentes
                            </div>";
                            break;
                        case 3:
                            echo "<div class=\"alert alert-danger\">
                            Arquivo não permitido (Apenas JPEG,JPG ou PNG)
                            </div>";
                            break;
                        case 4:
                            echo "<div class=\"alert alert-danger\">
                            Imagem não carregada...
                            </div>";
                            break;
                        }
                    }
                 ?>
                <form action="controller/cadastroController.php" method="POST" onsubmit="return validar()" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail" required>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite seu nome" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="snome" class="form-label">Sobrenome</label>
                            <input type="text" class="form-control" id="snome" name="snome" placeholder="Digite seu sobrenome" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="datanasc" class="form-label">Data de nascimento</label>
                        <input type="date" class="form-control" id="datanasc" name="datanasc" max="<?= date('Y-m-d') ?>" required>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="cpf" class="form-label">CPF</label>
                            <input type="text" class="form-control" id="cpf" name="cpf" 
                                placeholder="Digite seu CPF" pattern="\d{11}" required>
                            <div class="form-text">Apenas números (11 dígitos)</div>
                        </div>
                        <!-- Prestador -->
                        <?php 
                        $tipo_perfil = $_GET['tipo_perfil'] ?? '';
                        if ($tipo_perfil == 'prestador'): ?>
                        <div class="col-md-6">
                            <label for="cnpj" class="form-label">CNPJ</label>
                            <input type="text" class="form-control" id="cnpj" name="cnpj" 
                                placeholder="Digite seu CPF" pattern="\d{14}" required>
                            <div class="form-text">Apenas números (14 dígitos)</div>
                        </div>
                        <?php endif; ?>
                        <div class="col-md-6">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input type="tel" class="form-control" id="telefone" name="telefone"
                                placeholder="Digite seu telefone" pattern="[0-9]{10,11}" required>
                            <div class="form-text">Com DDD, apenas números</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="genero" class="form-label">Gênero</label>
                        <select class="form-select" id="genero" name="genero" required>
                            <option value=0>Selecione...</option>
                            <option value=1>Feminino</option>
                            <option value=2>Masculino</option>
                            <option value=3>Outro</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua senha" required>
                    </div>
                    <div class="mb-3">
                        <label for="senhaConfirmada" class="form-label">Confirmar senha</label>
                        <input type="password" class="form-control" id="senhaConfirmada" name="senhaConfirmada" placeholder="Digite sua senha novamente" required>
                    </div>


                    <!-- Prestador -->
                    <?php if ($tipo_perfil === 'prestador'): ?>
                    <div class="mb-3">
                        <label for="img_rg" class="form-label">Imagem do RG</label>
                        <input type="file" class="form-control" name="img_rg" id="img_rg" required>
                    </div>

                    <div class="mb-3">
                        <label for="chavepix" class="form-label">Chave Pix</label>
                        <input type="text" class="form-control" id="chavepix" name="chavepix" 
                            placeholder="Digite sua chave Pix (CPF, e-mail, telefone ou chave aleatória)" required>
                        <div class="form-text">Sua chave Pix para recebimentos</div>
                    </div>
                    <?php endif; ?>

                    <input type="hidden" name="tipo_perfil" value="<?=$tipo_perfil?>">
                    <button type="submit" class="btn btn-warning w-100 text-dark" name="btn_enviar">Enviar</button>
                </form>
                <div class="text-center mt-3">
                    <p class="mb-0">Já possui cadastro? <a href="index.php">Fazer Login</a></p>
                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php";?>

    <script>
        function validar() {
            
            const senha = document.getElementById('senha');
            const senha2 = document.getElementById('senhaConfirmada');

            if(senha.value !== senha2.value) {
                event.preventDefault();
                senha.classList.add('is-invalid');
                senha2.classList.add('is-invalid');
                return false;
            }
            
            return true;
        }

        function validarTel(){

        }

        function validarSenha(){

        }

        //validação reativa:
        document.getElementById('senhaConfirmada').addEventListener('input', function() {
            const senha = document.getElementById('senha');
            const senha2 = this;
            
            if(senha.value !== senha2.value) {
                senha2.classList.add('is-invalid');
            } else {
                senha2.classList.remove('is-invalid');
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
