<?php
class Cadastro{
    private $nomeUsuario;
    private $emailUsuario;
    private $senhaUsuario;
    private $conexao;
    private $tipoUsuario;

    public function __construct($emailUsuario, $senhaUsuario, $tipoUsuario, $nomeUsuario){
        include "../config/conexao.php";
        $this->conexao = conectaDB();
        $this->emailUsuario = $emailUsuario;
        $this->senhaUsuario = password_hash($senhaUsuario, PASSWORD_DEFAULT);
        $this->tipoUsuario = $tipoUsuario;
        $this->nomeUsuario = $nomeUsuario;
    }

    public function salvar(){
        $sql = "INSERT INTO usuario (nome,email,senha,tipo_perfil) VALUES (?, ?, ?, ?)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("ssss", $this->nomeUsuario, $this->emailUsuario, $this->senhaUsuario, $this->tipoUsuario);
        return $stmt->execute();
    }

    public function buscarNoBanco(){
        // Prepara a consulta SQL para buscar o e-mail e a senha do usuário
        $sql = "SELECT * FROM usuario WHERE email = ?";
        $stmt = $this->conexao->prepare($sql); 
    
        // Associa o parâmetro (e-mail) à consulta preparada para evitar SQL Injection
        $stmt->bind_param("s", $this->emailUsuario); 
    
        // Executa a consulta preparada
        $stmt->execute();
    
        // Obtém o resultado da execução da consulta
        $resultado = $stmt->get_result(); 
    
        if ($resultado->num_rows > 0){
            // Retorna o primeiro resultado encontrado como um array associativo
            return $resultado->fetch_assoc();
        } else{
            return false;
        }
    }

}
