<?php

require_once(__DIR__ . '/../../env/Database.php');

class ClassContato
{
    public $idContato;
    public $nomeContato;
    public $emailContato;
    public $telefoneContato;
    public $mensagemContato;
    public $statusContato;
    public $dataContato;
    public $horaContato;

    public function __construct($id = false)
    {
        if ($id) {
            $this->idContato = $id;
            $this->Carregar(); // Nota: o método foi chamado com 'C' maiúsculo no construtor, mas definido como 'carregar' minúsculo abaixo. O PHP é tolerante, mas vamos padronizar para Carregar().
        }
    }

    // LISTAR
    public function Listar()
    {
        $sql = "SELECT * FROM contato ORDER BY dataContato DESC"; 
        $conn = Database::conectar();
        $resultado = $conn->query($sql); 
        return $resultado->fetchAll(); 
    }

    // CARREGAR (Blindado contra SQL Injection)
    public function Carregar()
    {
        $sql = "SELECT * FROM contato WHERE idContato = :idContato";
        $conn = Database::conectar();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idContato', $this->idContato, PDO::PARAM_INT);
        $stmt->execute();

        $contato = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($contato) {
            $this->idContato = $contato['idContato'];
            $this->nomeContato = $contato['nomeContato'];
            $this->emailContato = $contato['emailContato'];
            $this->telefoneContato = $contato['telefoneContato'];
            $this->mensagemContato = $contato['mensagemContato'];
            $this->statusContato = $contato['statusContato'];
            $this->dataContato = $contato['dataContato'];
            $this->horaContato = $contato['horaContato'];
        }
    }

    // ATUALIZAR (Blindado contra SQL Injection)
    public function Atualizar()
    {
        $sql = "UPDATE contato SET statusContato = 'LIDO' WHERE idContato = :idContato";

        $conn = Database::conectar();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idContato', $this->idContato, PDO::PARAM_INT);
        $stmt->execute();

        echo "<script>document.location='index.php?p=contato'</script>"; 
    }
}