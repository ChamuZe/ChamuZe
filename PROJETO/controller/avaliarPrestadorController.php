<?php
session_start();
include "../helpers/biblioteca.php";
if (isset($_POST['estrela'])){
    //Salvar na tabela avaliação
    salvarAvaliacaoNoBanco($_POST['estrela'] ,$_POST['id_avaliado'], $_SESSION['usuario']['id_usuario']);
    //Salvar nota recalculada na tabela usuário
    $novaNota = recalcularNotaAvaliacao($_POST['id_avaliado']);
    atualizarCampoDeNotaRecalculada($novaNota, $_POST['id_avaliado']);

    header("Location: ../solicitante/visualizarServicos.php?erro=-1");
}

?>