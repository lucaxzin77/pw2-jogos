<?php
class Jogo
{
    // Atributos correspondentes à tabela de jogos
    public $id;
    public $titulo;
    public $data_lanc;
    public $genero;
    public $dev;
    public $data_cad;

    
    private $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    // Método para cadastrar uma nova jogo
    public function cadastrar(): bool
    {
        try {
            $sql = "INSERT INTO jogo (`titulo`, `data_lanc`, `genero`, `dev`) VALUES (?, ?, ?, ?)";
            $dados = [
                $this->titulo,
                $this->data_lanc,
                $this->genero,
                $this->dev
            ];
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($dados);
            return ($stmt->rowCount() > 0); 
        } catch (PDOException $e) {
            // Tratar erro de banco de dados
            error_log("Erro ao cadastrar jogo: " . $e->getMessage());
            throw new Exception(message: "Erro ao cadastrar jogo: " . $e->getMessage());
        }
    }

    // Método para consultar todas as jogos, com busca opcional
    public function consultarTodos($search = '')
    {
        try {            
            if ($search) {
                $sql = "SELECT * FROM jogo WHERE titulo LIKE ? OR genero LIKE ?";
                $search = trim(string: $search);
                $search = "%{$search}%";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$search, $search]);
            } else {
                $sql = "SELECT * FROM jogo";
                $stmt = $this->conn->query($sql);
            }
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Tratar erro de banco de dados
            error_log("Erro ao consultar jogos: " . $e->getMessage());
            throw new Exception(message: "Erro ao consultar jogos: " . $e->getMessage());
        }
    }

    // Método para consultar jogo por ID
    public function consultarPorId($id)
    {
        try {
            $sql = "SELECT * FROM jogo WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Tratar erro de banco de dados
            error_log("Erro ao consultar jogo por ID: " . $e->getMessage());
            throw new Exception(message: "Erro ao consultar jogo por ID: " . $e->getMessage());
        }
    }

    // Método para alterar uma jogo existente
    public function editar()
    {
        try {
            $sql = "UPDATE jogo SET titulo = ?, data_lanc = ?, genero = ?, dev = ? WHERE id = ?";
            $dados = [
                $this->titulo,
                $this->data_lanc,
                $this->genero,
                $this->dev,
                $this->id
            ];
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($dados);
            return ($stmt->rowCount() > 0); 
        } catch (PDOException $e) {
            // Tratar erro de banco de dados
            error_log("Erro ao alterar jogo: " . $e->getMessage());
            throw new Exception(message: "Erro ao alterar jogo: " . $e->getMessage());
        }
    }

    // Método para deletar uma jogo
    public function deletar($id): bool
    {
        try {
            $sql = "DELETE FROM jogo WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            return ($stmt->rowCount() > 0); 
        } catch (PDOException $e) {
            // Tratar erro de banco de dados
            error_log("Erro ao deletar jogo: " . $e->getMessage());
            throw new Exception(message: "Erro ao deletar jogo: " . $e->getMessage());
        }
    }
}