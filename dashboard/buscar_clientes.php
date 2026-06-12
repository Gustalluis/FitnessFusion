<?php
require_once(__DIR__ . '/../env/Database.php');
require_once(__DIR__ . '/../env/Session.php');

header('Content-Type: application/json');

// 🔒 Exige autenticação para buscar clientes
Session::requireAuth();

if (isset($_POST['query'])) {
    $query = trim($_POST['query']);
    
    if (strlen($query) < 2) {
        echo json_encode([]);
        exit;
    }
    
    $conn = Database::conectar();
    $sql = "SELECT idCliente, nomeCliente, emailCliente, telefoneCliente FROM cliente WHERE nomeCliente LIKE :query ORDER BY nomeCliente LIMIT 10";
    $stmt = $conn->prepare($sql);
    $queryParam = $query . '%';
    $stmt->bindParam(':query', $queryParam, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($result);
}