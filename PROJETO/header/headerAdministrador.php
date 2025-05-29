<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$nomeUsuario = isset($_SESSION['usuario']['nome']) ? $_SESSION['usuario']['nome'] : 'Usuário';
?>

<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <div class="container">
            <a class="navbar-brand" href="../administrador/inicialAdministrador.php">
                <img src="../assets/img/chamuzeLogoComFundoR.png" alt="Logo Chamauze" class="rounded-3" width="240">
            </a>
            <div class="d-flex align-items-center">
                <script src="../assets/js/historico.js"></script>
                <a class="btn btn-outline-warning me-2" href="../administrador/inicialAdministrador.php" onclick="atualizarUrl('Home');">Home</a>
                <a class="btn btn-outline-warning me-2" href="cadastroAdm.php" onclick="atualizarUrl('CadastroAdm');">Cadastrar ADM</a>
                <a class="btn btn-outline-warning me-2" href="avaliarPrestadores.php" onclick="atualizarUrl('AvaliacaoPrestador');">Avaliar Prestadores</a>
                <a class="btn btn-outline-warning me-2" href="gerenciarServicos.php" onclick="atualizarUrl('GerenciarServicos');">Gerenciar Serviços</a>
                <a class="btn btn-outline-warning me-2" href="../administrador/gerenciarUsuarios.php" onclick="atualizarUrl('GerenciarUsuarios');">Gerenciar Usuários</a>
                <a class="btn btn-warning d-flex align-items-center" href="../config/perfilUsuario.php" onclick="atualizarUrl('PerfilUsuario');">
                    <link rel="stylesheet"
                        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
                    <i class="bi bi-person-circle me-2"></i>
                    Bem-vindo, <?= htmlspecialchars($nomeUsuario) ?>
                </a>
                <a class="ms-2">
                    <form method="POST" action="../controller/logOutController.php">
                        <input type="submit" value="Sair" class="btn btn-danger btn-logout">
                    </form>
                </a>
            </div>
        </div>
    </nav>
</header>