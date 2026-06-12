<?php

require_once(__DIR__ . '/../../env/Database.php');

class ClassFeedback
{
    public $nomeCliente;
    public $idFeedback;
    public $idCliente;
    public $dataFeedback;
    public $tipoFeedback;
    public $conteudoFeedback;

    public function __construct($id = false)
    {
        if ($id) {
            $this->idFeedback = $id;
            $this->Carregar();
        }
    }

    public function Listar()
    {
        $sql = "SELECT 
                    cliente.nomeCliente, 
                    feedback.idFeedback,
                    feedback.dataFeedback,
                    feedback.tipoFeedback,
                    feedback.conteudoFeedback 
                FROM 
                    feedback
                INNER JOIN 
                    cliente
                ON 
                    feedback.idCliente = cliente.idCliente
                ORDER BY feedback.dataFeedback DESC";

        $conn = Database::conectar();
        $resultado = $conn->query($sql);
        return $resultado->fetchAll();
    }

    public function Carregar()
    {
        $sql = "SELECT 
                    cliente.nomeCliente, 
                    feedback.idFeedback,
                    feedback.idCliente,
                    feedback.dataFeedback,
                    feedback.tipoFeedback,
                    feedback.conteudoFeedback 
                FROM 
                    feedback
                INNER JOIN 
                    cliente
                ON 
                    feedback.idCliente = cliente.idCliente
                WHERE 
                    feedback.idFeedback = :idFeedback";

        $conn = Database::conectar();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idFeedback', $this->idFeedback, PDO::PARAM_INT);
        $stmt->execute();
        
        $feedback = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($feedback) {
            $this->idCliente = $feedback['idCliente'];
            $this->nomeCliente = $feedback['nomeCliente'];
            $this->dataFeedback = $feedback['dataFeedback'];
            $this->tipoFeedback = $feedback['tipoFeedback'];
            $this->conteudoFeedback = $feedback['conteudoFeedback'];
        } else {
            throw new Exception("Feedback não encontrado.");
        }
    }
}