<?php

require_once(__DIR__ . '/../../env/Database.php');

class ClassModalidade
{
    public const UPLOAD_DIR = __DIR__ . '/../img/modalidade/';
    public const PUBLIC_PATH = 'dashboard/img/modalidade/';
    public const MAX_DESTAQUE_SITE = 3;

    public $idModalidade;
    public $nomeModalidade;
    public $conteudoModalidade;
    public $fotoModalidade;
    public $altModalidade;
    public $statusModalidade;
    public $dataCadModalidade;
    public $tipoModalidade;

    public function __construct($id = false)
    {
        if ($id) {
            $this->idModalidade = $id;
            $this->Carregar();
        }
    }

    public function Listar()
    {
        $sql = "SELECT * FROM modalidade ORDER BY nomeModalidade ASC";
        $conn = Database::conectar();
        $resultado = $conn->query($sql);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    /** Modalidades visíveis na página pública (exclui INATIVO). */
    public function ListarPublicas()
    {
        $sql = "SELECT * FROM modalidade WHERE statusModalidade IN ('ATIVO', 'SITE') ORDER BY nomeModalidade ASC";
        $conn = Database::conectar();
        $stmt = $conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** Modalidades em destaque na home (status SITE, máx. 3). */
    public function ListarDestaque()
    {
        $sql = "SELECT * FROM modalidade WHERE statusModalidade = 'SITE' ORDER BY nomeModalidade ASC LIMIT " . self::MAX_DESTAQUE_SITE;
        $conn = Database::conectar();
        $stmt = $conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function contarStatusSite(): int
    {
        $conn = Database::conectar();
        $sql = "SELECT COUNT(*) AS total FROM modalidade WHERE statusModalidade = 'SITE'";
        $resultado = $conn->query($sql);
        $contagem = $resultado->fetch(PDO::FETCH_ASSOC);
        return (int) ($contagem['total'] ?? 0);
    }

    public static function normalizarNomeArquivo(string $nome): string
    {
        $nome = str_replace(' ', '', $nome);
        $nome = iconv('UTF-8', 'ASCII//TRANSLIT', $nome);
        return strtolower($nome);
    }

    public function Inserir()
    {
        $sql = "INSERT INTO modalidade (nomeModalidade, fotoModalidade, statusModalidade, altModalidade, conteudoModalidade)
                VALUES (:nomeModalidade, :fotoModalidade, :statusModalidade, :altModalidade, :conteudoModalidade)";

        $conn = Database::conectar();
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':nomeModalidade', $this->nomeModalidade);
        $stmt->bindParam(':fotoModalidade', $this->fotoModalidade);
        $stmt->bindParam(':statusModalidade', $this->statusModalidade);
        $stmt->bindParam(':altModalidade', $this->altModalidade);
        $stmt->bindParam(':conteudoModalidade', $this->conteudoModalidade);

        $stmt->execute();
    }

    public function Atualizar()
    {
        $sql = "UPDATE modalidade SET
                nomeModalidade = :nomeModalidade,
                fotoModalidade = :fotoModalidade,
                statusModalidade = :statusModalidade,
                altModalidade = :altModalidade,
                conteudoModalidade = :conteudoModalidade
                WHERE idModalidade = :idModalidade";

        $conn = Database::conectar();
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':nomeModalidade', $this->nomeModalidade);
        $stmt->bindParam(':fotoModalidade', $this->fotoModalidade);
        $stmt->bindParam(':statusModalidade', $this->statusModalidade);
        $stmt->bindParam(':altModalidade', $this->altModalidade);
        $stmt->bindParam(':conteudoModalidade', $this->conteudoModalidade);
        $stmt->bindParam(':idModalidade', $this->idModalidade, PDO::PARAM_INT);

        $stmt->execute();
        echo "<script>window.location.href='index.php?p=modalidade';</script>";
    }

    public function Carregar()
    {
        $sql = "SELECT * FROM modalidade WHERE idModalidade = :idModalidade";
        $conn = Database::conectar();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idModalidade', $this->idModalidade, PDO::PARAM_INT);
        $stmt->execute();
        $modalidade = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($modalidade) {
            $this->idModalidade = $modalidade['idModalidade'];
            $this->nomeModalidade = $modalidade['nomeModalidade'];
            $this->conteudoModalidade = $modalidade['conteudoModalidade'];
            $this->fotoModalidade = $modalidade['fotoModalidade'];
            $this->altModalidade = $modalidade['altModalidade'];
            $this->statusModalidade = $modalidade['statusModalidade'];
            $this->dataCadModalidade = $modalidade['dataCadModalidade'];
            $this->tipoModalidade = $modalidade['tipoModalidade'];
        }
    }

    public function Desativar($id)
    {
        $sql = "UPDATE modalidade SET statusModalidade = 'INATIVO' WHERE idModalidade = :idModalidade";
        $conn = Database::conectar();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idModalidade', $id, PDO::PARAM_INT);
        $stmt->execute();

        echo "<script>window.location.href='index.php?p=modalidade';</script>";
    }
}
