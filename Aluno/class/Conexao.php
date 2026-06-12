<?php
// 🔒 REDIRECIONA PARA A CLASSE DE CONEXÃO UNIFICADA
require_once(__DIR__ . '/../../env/Database.php');

// Mantém compatibilidade com código antigo que usa funcao LigarConexao()
function LigarConexao() {
    return Database::conectar();
}

// Mantém compatibilidade com código antigo que usa $conn global
$conn = Database::conectar();