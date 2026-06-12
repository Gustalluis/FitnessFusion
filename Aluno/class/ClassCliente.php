<?php
require_once(__DIR__ . '/../../env/Database.php');

class ClassCliente
{
    public $idCliente;
    public $treinoCliente;
    public $planoCliente;
    public $idAvaliacaoFisica;
    public $nomeCliente;
    public $cpfCliente;
    public $telefoneCliente;
    public $dataNascCliente;
    public $emailCliente;
    public $senhaCliente;
    public $statusCliente;
    public $fotoCliente;
    public $altCliente;
    public $dataCadCliente;
    public $metodoPagamento;

    public function Listar()
    {
        $sql = "SELECT     
                c.idCliente,
                c.nomeCliente,
                c.fotoCliente,
                c.altCliente,
                c.telefoneCliente,
                c.statusCliente,
                c.dataNascCliente,
                c.dataCadCliente,
                c.cpfCliente,
                p.nomePlano,
                t.nomeTreino
            FROM
                cliente c
            INNER JOIN
                planoAssinatura p ON c.idPlano = p.idPlano
            INNER JOIN
                treino t ON c.idTreino = t.idTreino";

        $conn = Database::conectar();
        $resultado = $conn->query($sql);
        return $resultado->fetchAll();
    }
}