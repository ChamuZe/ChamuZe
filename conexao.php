<?php
    function conectaDB(){
        $host = "127.0.0.1:3307";
        $db_name = "chamuze";
        $user_name = "root";
        $password = ""; 
        $conexao = new mysqli($host, $user_name, $password, $db_name);
        return $conexao;
    }

    
?>