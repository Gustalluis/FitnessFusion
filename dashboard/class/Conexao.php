<?php
/**
 * 🔒 ARQUIVO DE COMPATIBILIDADE
 * Redireciona para a nova classe Database unificada
 * Mantido para evitar erros em arquivos que ainda possam requerê-lo
 */

require_once(__DIR__ . '/../../env/Database.php');

if (!class_exists('Conexao', false)) {
    class Conexao {
        public static function LigarConexao() {
            return Database::conectar();
        }
    }
}