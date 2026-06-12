<?php
/**
 * 🔒 GERENCIADOR DE SESSÃO SEGURO
 * Previne: Session Fixation, Session Hijacking
 * Auto-suficiente: usa valores padrão se .env.php nao estiver carregado
 */

class Session
{
    private static $sessionName = 'FITNESSFUSION_SESSID';
    private static $sessionLifetime = 3600; // 1 hora

    /**
     * Inicia a sessão com configurações seguras
     */
    public static function start()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            return;
        }

        // Carrega constantes se disponiveis
        if (defined('SESSION_NAME')) {
            self::$sessionName = SESSION_NAME;
        }
        if (defined('SESSION_LIFETIME')) {
            self::$sessionLifetime = SESSION_LIFETIME;
        }

        // Configurações seguras de sessão
        ini_set('session.use_strict_mode', 1);
        ini_set('session.use_only_cookies', 1);
        ini_set('session.cookie_httponly', 1);
        ini_set('session.cookie_secure', !empty($_SERVER['HTTPS']));
        ini_set('session.cookie_samesite', 'Lax');
        ini_set('session.gc_maxlifetime', self::$sessionLifetime);
        ini_set('session.sid_length', 48);
        ini_set('session.sid_bits_per_character', 6);

        session_name(self::$sessionName);
        session_start();

        // Regenera ID periodicamente para prevenir fixation
        if (!isset($_SESSION['_CREATED'])) {
            $_SESSION['_CREATED'] = time();
            session_regenerate_id(true);
        } elseif (time() - $_SESSION['_CREATED'] > self::$sessionLifetime) {
            session_regenerate_id(true);
            $_SESSION['_CREATED'] = time();
        }
    }

    /**
     * Verifica se o usuário está logado
     */
    public static function isLoggedIn()
    {
        self::start();
        return isset($_SESSION['idCliente']) || isset($_SESSION['idFuncionario']);
    }

    /**
     * Retorna o tipo de usuário ('aluno', 'funcionario', ou false)
     */
    public static function getUserType()
    {
        self::start();
        if (isset($_SESSION['idCliente'])) return 'aluno';
        if (isset($_SESSION['idFuncionario'])) return 'funcionario';
        return false;
    }

    /**
     * Retorna o ID do usuário logado
     */
    public static function getUserId()
    {
        self::start();
        return $_SESSION['idCliente'] ?? $_SESSION['idFuncionario'] ?? false;
    }

    /**
     * Redireciona para login se não estiver autenticado
     */
    public static function requireAuth($redirectUrl = null)
    {
        self::start();
        if (!self::isLoggedIn()) {
            $redirectUrl = $redirectUrl ?? (defined('BASE_URL') ? BASE_URL . 'login.php' : '../login.php');
            header('Location: ' . $redirectUrl);
            exit();
        }
    }

    /**
     * Redireciona se não for funcionário
     */
    public static function requireFuncionario($redirectUrl = null)
    {
        self::start();
        if (!isset($_SESSION['idFuncionario'])) {
            $redirectUrl = $redirectUrl ?? (defined('BASE_URL') ? BASE_URL . 'login.php' : '../login.php');
            header('Location: ' . $redirectUrl);
            exit();
        }
    }

    /**
     * Destrói a sessão com segurança
     */
    public static function destroy()
    {
        self::start();
        $_SESSION = [];
        
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params['path'], $params['domain'],
                $params['secure'], $params['httponly']
            );
        }
        
        session_destroy();
    }
}