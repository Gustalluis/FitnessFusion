<?php
require_once(__DIR__ . '/../../env/Database.php');

class ClassEvento
{
    public $idEvento;
    public $nomeEvento;
    public $dataEvento;
    public $statusEvento;

    public function __construct($id = false)
    {
        if ($id) {
            $this->idEvento = $id;
            $this->carregar();
        }
    }

    public function listar()
    {
        $sql = "SELECT * FROM evento ORDER BY nomeEvento ASC";
        $conn = Database::conectar();
        $stmt = $conn->query($sql);
        return $stmt->fetchAll();
    }

    public function inserir()
    {
        try {
            $sql = "INSERT INTO evento (nomeEvento, dataEvento, statusEvento) VALUES (:nomeEvento, :dataEvento, :statusEvento)";
            $conn = Database::conectar();
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nomeEvento', $this->nomeEvento);
            $stmt->bindParam(':dataEvento', $this->dataEvento);
            $stmt->bindParam(':statusEvento', $this->statusEvento);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao inserir evento: " . $e->getMessage());
            return false;
        }
    }

    public function carregar()
    {
        $sql = "SELECT * FROM evento WHERE idEvento = :idEvento";
        $conn = Database::conectar();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idEvento', $this->idEvento);
        $stmt->execute();
        $evento = $stmt->fetch();

        $this->idEvento = $evento['idEvento'];
        $this->nomeEvento = $evento['nomeEvento'];
        $this->dataEvento = $evento['dataEvento'];
        $this->statusEvento = $evento['statusEvento'];
    }

    public function atualizar()
    {
        $sql = "UPDATE evento SET nomeEvento = :nomeEvento, dataEvento = :dataEvento, statusEvento = :statusEvento WHERE idEvento = :idEvento";
        $conn = Database::conectar();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nomeEvento', $this->nomeEvento);
        $stmt->bindParam(':dataEvento', $this->dataEvento);
        $stmt->bindParam(':statusEvento', $this->statusEvento);
        $stmt->bindParam(':idEvento', $this->idEvento);
        $stmt->execute();

        echo "<script>document.location='index.php?p=evento'</script>";
    }
}