<?php
function conectaDB(){
    $host = 'localhost';
    $db_name = 'chamuze';
    $user_name = 'root';
    $password = '';

    $conexao = new mysqli($host, $user_name, $password, $db_name);
    return $conexao;
}