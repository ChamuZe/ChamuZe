<?php
session_start();
    if ($_SESSION['usuario']['tipo_perfil'] != "administrador"){
        header("Location: ../index.php");
    }
    include "../classes/Usuario.php";
    $usuario = new Usuario();

    $emailPesquisa = isset($_GET['pesquisa']) && $_GET['pesquisa'] !== 'null'  ? $_GET['pesquisa'] : null;

    if (isset($emailPesquisa)) {
        $usuarios = $usuario->buscarPorEmail($emailPesquisa);
    }



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/history.js"></script>
</head>
<body>
    <?php include "../header/header.php" ?>
    <main class="container my-5 vh-100">
        <h1 class="text-center mt-4 mb-4">Gerenciar usuários</h1>
        <div class="container d-flex sticky-top justify-content-center mb-5">
            <form class="d-flex w-50" role="search" method="GET" action="">
                <input class="form-control me-2" name="pesquisa" type="search" placeholder="nome@exemplo.com" aria-label="Search">
                <button class="btn btn-warning" type="submit" >Buscar</button>
            </form>
        </div>
        <?php if (isset($_GET['erro'])): ?>
            <?php
                switch ($_GET['erro']) {
                    case 0:
                        echo '<div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                                O Usuario foi removido da base de dados!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                              </div>';
                        break;
                    case 1:
                        echo '<div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                                Ops, algo deu errado! Os dados não foram enviados por POST.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                              </div>';
                        break;
                }
            ?>
        <?php endif; ?>
        <?php if (is_null($emailPesquisa)): ?>
                <div class="alert alert-primary">Digite o Email de um usuário para ele ser exibido aqui.</div>
        <?php elseif (is_null($usuarios)): ?>
                <div class="alert alert-warning">Usuario não encontrado.</div>
        <?php else: ?>
            <?php if ($usuarios['tipo_perfil'] == 'prestador'): ?>
                <div class="col-md-8 col-lg-6 mb-4 mx-auto">
                    <div class="card shadow-lg border-0 h-100">
                        <div class="card-body">
                            <ul class="list-group list-group-flush mb-3">
                                <li class="list-group-item"><strong>Nome:</strong> <?= $usuarios['nome'] ?></li> 
                                <li class="list-group-item"><strong>Sobrenome:</strong> <?= $usuarios['sobrenome'] ?></li> 
                                <li class="list-group-item"><strong>Tipo de perfil:</strong> <?= $usuarios['tipo_perfil'] ?></li>
                                <li class="list-group-item"><strong>E-mail:</strong> <?= $usuarios['email'] ?></li> 
                                <li class="list-group-item"><strong>Telefone:</strong> <?= $usuarios['telefone'] ?></li>
                                <li class="list-group-item"><strong>Data de Nascimento:</strong> <?= date("d/m/Y", strtotime($usuarios['data_nascimento'])) ?></li>
                                <li class="list-group-item"><strong>Gênero:</strong> <?= ucfirst($usuarios['genero']) ?></li>
                                <li class="list-group-item"><strong>Nacionalidade:</strong> <?= $usuarios['nacionalidade'] ?></li>
                                <li class="list-group-item"><strong>CPF:</strong> <?= $usuarios['cpf'] ?></li>
                                <li class="list-group-item"><strong>CNPJ:</strong> <?= $usuarios['cnpj'] ?></li>
                                <li class="list-group-item"><strong>Chave Pix:</strong> <?= $usuarios['chave_pix'] ?></li>
                            </ul>

                            <div class="mb-3 text-center">
                                <strong>Documento (RG):</strong><br>
                                <img src="<?= $usuarios['img_rg'] ?>" class="img-thumbnail mt-2" alt="Imagem do RG"
                                    style="max-height: 250px; object-fit: cover;">
                            </div>

                            <form method="POST" action="../controller/gerenciarUsuariosController.php">
                                <input type="hidden" name="id_usuario" value="<?= $usuarios['id_usuario'] ?>">
                                <div class="d-flex justify-content-center gap-3">
                                    <button class="btn btn-danger px-4" type="submit" name="acao" value="prestador">Excluir</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="col-md-8 col-lg-6 mb-4 mx-auto">
                    <div class="card shadow-lg border-0 h-100">
                        <div class="card-body">
                            <ul class="list-group list-group-flush mb-3">
                                <li class="list-group-item"><strong>Nome:</strong> <?= $usuarios['nome'] ?></li> 
                                <li class="list-group-item"><strong>Sobrenome:</strong> <?= $usuarios['sobrenome'] ?></li> 
                                <li class="list-group-item"><strong>Perfil de:</strong> <?= $usuarios['tipo_perfil'] ?></li>
                                <li class="list-group-item"><strong>E-mail:</strong> <?= $usuarios['email'] ?></li> 
                                <li class="list-group-item"><strong>Telefone:</strong> <?= $usuarios['telefone'] ?></li>
                                <li class="list-group-item"><strong>Data de Nascimento:</strong> <?= date("d/m/Y", strtotime($usuarios['data_nascimento'])) ?></li>
                                <li class="list-group-item"><strong>Gênero:</strong> <?= ucfirst($usuarios['genero']) ?></li>
                                <li class="list-group-item"><strong>Nacionalidade:</strong> <?= $usuarios['nacionalidade'] ?></li>
                                <li class="list-group-item"><strong>CPF:</strong> <?= $usuarios['cpf'] ?></li>
 
                            </ul>
                            <form method="POST" action="../controller/gerenciarUsuariosController.php">
                                <input type="hidden" name="id_usuario" value="<?= $usuarios['id_usuario'] ?>">
                                <div class="d-flex justify-content-center gap-3">
                                    <button class="btn btn-danger px-4" type="submit" name="acao" value="solicitante">Excluir</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </main>
    <?php include "../footer.php" ?>
</body>
</html>