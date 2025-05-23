<?php
class Cadastro
{
    private $nome;
    private $sobrenome;
    private $email;
    private $senha;
    private $cpf;
    private $nacionalidade;
    private $telefone;
    private $dataNascimento;
    private $genero;
    private $tipoPerfil;
    private $conexao;

    //prestador
    private $cnpj;
    private $imgRg;
    private $chavePix;

    public function __construct(
        $nome,
        $sobrenome,
        $email,
        $senha,
        $cpf,
        $telefone,
        $dataNascimento,
        $genero,
        $tipoPerfil,
        $cnpj = null,
        $imgRg = null,
        $chavePix = null
    ) {
        include "../config/conexao.php";
        $this->conexao = conectaDB();
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
        $this->email = $email;
        $this->senha = password_hash($senha, PASSWORD_DEFAULT);
        $this->cpf = $cpf;
        //revisar o do pq ter nacionalidade...
        $this->nacionalidade = 'Brasileiro';
        $this->telefone = $telefone;
        $this->dataNascimento = $dataNascimento;
        $this->genero = $genero;
        $this->tipoPerfil = $tipoPerfil;


        $this->cnpj = $cnpj;
        $this->imgRg = $imgRg;
        //fica melhor deixar isso pra inserir na página do perfil dele...
        $this->chavePix = $chavePix;
    }

    public function salvar()
    {
        try {
            $this->conexao->begin_transaction();

            // Insert into usuario table
            $sqlUsuario = "INSERT INTO usuario (
                nome, 
                sobrenome, 
                email, 
                senha, 
                cpf, 
                telefone, 
                nacionalidade, 
                data_nascimento, 
                genero, 
                tipo_perfil
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmtUsuario = $this->conexao->prepare($sqlUsuario);
            $stmtUsuario->bind_param(
                "ssssssssss",
                $this->nome,
                $this->sobrenome,
                $this->email,
                $this->senha,
                $this->cpf,
                $this->nacionalidade,
                $this->telefone,
                $this->dataNascimento,
                $this->genero,
                $this->tipoPerfil
            );

            if (!$stmtUsuario->execute()) {
                throw new Exception("Erro ao salvar usuario: " . $stmtUsuario->error);
            }

            $Id = $this->conexao->insert_id;
            var_dump($Id);

            switch ($this->tipoPerfil) {
                case 'solicitante':
                    $this->salvarSolicitante($Id);
                    break;

                case 'prestador':
                    $this->salvarPrestador($Id);
                    break;
            }

            $this->conexao->commit();

        } catch (Exception $e) {
            $this->conexao->rollback();
            var_dump($e->getMessage());
        }
    }

    public function salvarSolicitante($id)
    {
        $sql = "INSERT INTO solicitante (id_solicitante) VALUES (?)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("i", $id);

        if (!$stmt->execute()) {
            throw new Exception("Erro ao salvar solicitante: " . $stmt->error);
        }
    }

    public function salvarPrestador($id)
    {
        $sql = "INSERT INTO prestador (
            id_prestador, 
            cnpj, 
            img_rg, 
            chave_pix, 
            status_avaliacao
        ) VALUES (?, ?, ?, ?, 'naoverificado')";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param(
            "isss",
            $id,
            $this->cnpj,
            $this->imgRg,
            $this->chavePix
        );

        if (!$stmt->execute()) {
            throw new Exception("Erro ao salvar prestador: " . $stmt->error);
        }
    }

    public function salvarAdmin($id)
    {
        $sql = "INSERT INTO prestador (
            id_prestador, 
            cnpj, 
            img_rg, 
            chave_pix, 
            status_avaliacao
        ) VALUES (?, ?, ?, ?, 'naoverificado')";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param(
            "isss",
            $id,
            $this->cnpj,
            $this->imgRg,
            $this->chavePix
        );

        if (!$stmt->execute()) {
            throw new Exception("Erro ao salvar prestador: " . $stmt->error);
        }
    }

    public function buscarNoBanco()
    {
        // Prepara a consulta SQL para buscar o e-mail e a senha do usuário
        $sql = "SELECT * FROM usuario WHERE email = ?";
        $stmt = $this->conexao->prepare($sql);

        // Associa o parâmetro (e-mail) à consulta preparada para evitar SQL Injection
        $stmt->bind_param("s", $this->email);

        // Executa a consulta preparada
        $stmt->execute();

        // Obtém o resultado da execução da consulta
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            // Retorna o primeiro resultado encontrado como um array associativo
            return $resultado->fetch_assoc();
        } else {
            return false;
        }
    }

}