<?php
require_once(__DIR__ . '/../env/.env.php');
require_once(__DIR__ . '/../env/Session.php');

Session::destroy();
header('Location: ' . BASE_URL . 'login.php');
exit();