<?php

require_once(__DIR__ . '/../../env/Database.php');
require_once(__DIR__ . '/../../env/Session.php');

class ClassFuncionario
{
    public $idFuncionario;
    public $nomeFuncionario;
    public $cargoFuncionario;
    public $fotoFuncionario;
    public $altFuncionario;
    public $telefoneFuncionario;
    public $enderecoFuncionario;
    public $emailFuncionario;
    public $senhaFuncionario;
    public $statusFuncionario;
    public $dataCadFuncionario;
    public $salarioFuncionario;
    public $descricaoFuncionario;

    public function Listar()
    {
        $sql = "SELECT * FROM funcionario ORDER BY nomeFuncionario ASC";
        $conn = Database::conectar();
        $resultado = $conn->query($sql);
        $lista = $resultado->fetchAll();
        return $lista;
    }

    /**
     * LOGIN SEGURO - APENAS com password_verify()
     */
    public function Verificarlogin()
    {
        $sql = "SELECT * FROM funcionario WHERE emailFuncionario = :emailFuncionario AND statusFuncionario = 'ATIVO'";
        
        $conn = Database::conectar();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':emailFuncionario', $this->emailFuncionario);
        $stmt->execute();
        
        $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($funcionario && password_verify($this->senhaFuncionario, $funcionario['senhaFuncionario'])) {
            return $funcionario['idFuncionario'];
        }

        return false;
    }

    public function BuscarPorId($id)
    {
        $sql = "SELECT * FROM funcionario WHERE idFuncionario = :idFuncionario";
        $conn = Database::conectar();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idFuncionario', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}

// Processamento do login (so executa se for uma requisicao POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    Session::start();
    
    $funcionario = new ClassFuncionario();
    $email = $_POST['email'];
    $senha = $_POST['password'];
    
    $funcionario->emailFuncionario = $email;
    $funcionario->senhaFuncionario = $senha;

    $idFuncionario = $funcionario->Verificarlogin();

    if ($idFuncionario) {
        $_SESSION['idFuncionario'] = $idFuncionario;
        echo json_encode(['success' => true, 'message' => 'login OK']);
    } else {
        echo json_encode(['success' => false, 'message' => 'E-mail ou senha invalidos']);
    }
}