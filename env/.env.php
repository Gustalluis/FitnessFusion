<?php
// 🔒 CONFIGURAÇÕES DE AMBIENTE
// Este arquivo NÃO deve ficar acessível publicamente
// As configurações são carregadas como constantes

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'fitnessfusion');

// Configurações de sessão
define('SESSION_LIFETIME', 3600); // 1 hora
define('SESSION_NAME', 'FITNESSFUSION_SESSID');

// Configurações de upload
define('MAX_UPLOAD_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'gif', 'webp']);

// Caminho base - detecta automaticamente
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$basePath = dirname($_SERVER['SCRIPT_NAME']);
define('BASE_URL', $protocol . '://' . $host . $basePath . '/');

/**
 * Retorna configurações SMTP para envio de e-mails
 * Configurado para ambiente 100% LOCAL (Desenvolvimento)
 */
function fitnessFusionConfig(string $chave, $padrao = '') {
    $configs = [
        'smtp_host'     => 'localhost',
        'smtp_username' => '',
        'smtp_password' => '',
        'smtp_from'     => 'sistema@localhost',
        'smtp_to'       => 'admin@localhost', 
        'smtp_port'     => 1025, // Porta 1025 para Mailpit/MailHog. Mude para 25 se usar Sendmail nativo do XAMPP.
    ];
    return $configs[$chave] ?? $padrao;
}