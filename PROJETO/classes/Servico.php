<?php
class Servico {
    private $conexao;
    private $status = "disponivel";

    public function __construct(){
        // Ajustando o caminho para incluir o arquivo de conexão corretamente
        include __DIR__ . '/../config/conexao.php'; // Usando __DIR__ para garantir o caminho correto
        $this->conexao = conectaDB();
    }

    // Salvar serviço no banco
    public function salvar($titulo, $descricao, $categoria, $regiao, $caminhoImgServico, $preco, $idSolicitante){
        $sql = "INSERT INTO servico (titulo, descricao, categoria, local_servico, img_servico, preco, id_solicitante) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("sssssdd", $titulo, $descricao, $categoria, $regiao, $caminhoImgServico, $preco, $idSolicitante);
        return $stmt->execute();
    }

    // Excluir serviço pelo ID
    public function excluir($id){
        $sql = "DELETE FROM servico WHERE id_servico = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Atualizar serviço pelo ID
    public function atualizar($id, $titulo, $descricao, $categoria, $regiao, $caminhoImgServico, $preco){
        $sql = "UPDATE servico SET titulo = ?, descricao = ?, categoria = ?, local_servico = ?, img_servico = ?, preco = ? WHERE id_servico = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("sssssdi", $titulo, $descricao, $categoria, $regiao, $caminhoImgServico, $preco, $id);
        return $stmt->execute();
    }

    // Buscar todos os serviços
    public function buscarTodos(){
        $sql = "SELECT * FROM servico";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Buscar serviço por ID
    public function buscarPorId($id_servico){
        $sql = "SELECT * FROM servico WHERE id_servico = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("i", $id_servico); // "i" para inteiro
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Retorna uma linha associativa
    }

    public function buscarPorUsuario($id_usuario) {
        $sql = "SELECT * FROM servico WHERE id_solicitante = ?"; // Filtrando pelo usuário
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC); // Retorna todos os serviços do usuário
    }
    
}
?>
