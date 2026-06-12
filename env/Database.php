<?php
/**
 * 🔒 CLASSE DE CONEXÃO UNIFICADA
 * Substitui: config.php, dashboard/class/Conexao.php, Aluno/class/Conexao.php
 */

// Garante que as constantes de ambiente estão carregadas
if (!defined('DB_HOST')) {
    require_once(__DIR__ . '/.env.php');
}

class Database
{
    private static $instancia = null;
    private static $conexao = null;

    /**
     * Retorna a conexão PDO (Singleton - evita múltiplas conexões)
     */
    public static function conectar()
    {
        if (self::$conexao === null) {
            try {
                $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
                self::$conexao = new PDO($dsn, DB_USER, DB_PASS, [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci",
                ]);
            } catch (PDOException $e) {
                // ⚠️ NÃO expõe detalhes do banco em produção!
                error_log("Erro de conexão: " . $e->getMessage());
                die("Erro interno do servidor. Tente novamente mais tarde.");
            }
        }
        return self::$conexao;
    }

    /**
     * Alias para manter compatibilidade com código antigo
     */
    public static function LigarConexao()
    {
        return self::conectar();
    }

    /**
     * Previne clonagem do singleton
     */
    private function __clone() {}
    private function __construct() {}
}