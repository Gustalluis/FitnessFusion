<?php

require_once(__DIR__ . '/../../env/Database.php');

class ClassBanner
{
    public $idBanner;
    public $nomeBanner;
    public $fotoBanner;
    public $altBanner;
    public $statusBanner;
    public $tipoBanner;

    public function __construct($id = false)
    {
        if ($id) {
            $this->idBanner = $id;
            $this->Carregar();
        }
    }

    public function Listar()
    {
        $sql = "SELECT * FROM banner ORDER BY nomeBanner ASC";
        $conn = Database::conectar();
        $resultado = $conn->query($sql);
        return $resultado->fetchAll();
    }

    public function Inserir()
    {
        $sql = "INSERT INTO banner (nomeBanner, fotoBanner, statusBanner, altBanner, tipoBanner) 
                VALUES (:nomeBanner, :fotoBanner, :statusBanner, :altBanner, :tipoBanner)";

        $conn = Database::conectar();
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':nomeBanner', $this->nomeBanner);
        $stmt->bindParam(':fotoBanner', $this->fotoBanner);
        $stmt->bindParam(':statusBanner', $this->statusBanner);
        $stmt->bindParam(':altBanner', $this->altBanner);
        $stmt->bindParam(':tipoBanner', $this->tipoBanner);
        
        $stmt->execute();
    }

    public function Atualizar()
    {
        $sql = "UPDATE banner SET 
                nomeBanner = :nomeBanner,
                fotoBanner = :fotoBanner,
                statusBanner = :statusBanner,
                altBanner = :altBanner,
                tipoBanner = :tipoBanner
                WHERE idBanner = :idBanner";

        $conn = Database::conectar();
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':nomeBanner', $this->nomeBanner);
        $stmt->bindParam(':fotoBanner', $this->fotoBanner);
        $stmt->bindParam(':statusBanner', $this->statusBanner);
        $stmt->bindParam(':altBanner', $this->altBanner);
        $stmt->bindParam(':tipoBanner', $this->tipoBanner);
        $stmt->bindParam(':idBanner', $this->idBanner, PDO::PARAM_INT);

        $stmt->execute();
        echo "<script>document.location='index.php?p=banner'</script>";
    }

    public function Carregar()
    {
        $sql = "SELECT * FROM banner WHERE idBanner = :idBanner";
        $conn = Database::conectar();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idBanner', $this->idBanner, PDO::PARAM_INT);
        $stmt->execute();
        
        $banner = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($banner) {
            $this->idBanner = $banner['idBanner'];
            $this->nomeBanner = $banner['nomeBanner'];
            $this->fotoBanner = $banner['fotoBanner'];
            $this->altBanner = $banner['altBanner'];
            $this->statusBanner = $banner['statusBanner'];
            $this->tipoBanner = $banner['tipoBanner'];
        }
    }

    public function Desativar($id)
    {
        $sql = "UPDATE banner SET statusBanner = 'INATIVO' WHERE idBanner = :idBanner";
        $conn = Database::conectar();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idBanner', $id, PDO::PARAM_INT);
        $stmt->execute();

        echo "<script>document.location='index.php?p=banner'</script>";
    }
}