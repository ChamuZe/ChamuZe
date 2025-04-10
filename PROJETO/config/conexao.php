<?php
function conectaDB(){
    static $conexao = null; // variável estática mantém o valor entre chamadas

    if ($conexao === null) {
        $host = 'localhost:3306';
        $db_name = 'chamuze';
        $user_name = 'root';
        $password = '';

        $conexao = new mysqli($host, $user_name, $password, $db_name);

        if ($conexao->connect_error) {
            die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
        }
    }

    return $conexao; // retorna a conexão existente
}
