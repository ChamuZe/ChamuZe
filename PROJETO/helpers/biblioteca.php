<?php
include "../config/conexao.php";
$conexao = conectaDB();

function buscarPrestadorNoBanco($id){
    global $conexao;
    $sql = "SELECT * FROM usuario LEFT JOIN prestador ON usuario.id_usuario = prestador.id_prestador WHERE id_usuario = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function salvarAvaliacaoNoBanco($nota ,$id_avaliado, $id_avaliador){
    global $conexao;
    $sql = "INSERT INTO avaliacao (nota, id_avaliado, id_avaliador) 
    VALUES (?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("iii",$nota ,$id_avaliado, $id_avaliador);
    $stmt->execute();
}

function recalcularNotaAvaliacao($id_avaliado){
    global $conexao;
    $sql = "SELECT AVG(nota) AS media FROM avaliacao WHERE id_avaliado = (?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('i',$id_avaliado);
    $stmt->execute();
    $resultado = $stmt->get_result();

    $media = 0;
    if($row = $resultado->fetch_assoc()){
        $media = round($row['media'], 2);
    }

    return $media;
}

function atualizarCampoDeNotaRecalculada($novaMedia, $id_avaliado){
    global $conexao;
    $sql = "UPDATE usuario SET nota_reputacao = (?) WHERE id_usuario = (?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('di',$novaMedia, $id_avaliado);
    $stmt->execute();
}
?>