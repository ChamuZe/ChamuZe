<?php
include 'conexao.php';
$conn = conectaDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_servico = $_POST['id_servico'];
    
    $sql = "DELETE FROM servicos WHERE id_servico = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_servico);
    
    if ($stmt->execute()) {
        header("Location: ".$_SERVER['HTTP_REFERER']."?success=1");
    } else {
        header("Location: ".$_SERVER['HTTP_REFERER']."?error=1");
    }
    exit();
}
?>