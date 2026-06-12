<?php
// 🔒 BLINDADO CONTRA LFI
$pagina = @$_GET['cont'] ?? '';

$paginasPermitidas = ['inserir', 'atualizar'];

if ($pagina == '') {
    require_once('listar.php');
} elseif (in_array($pagina, $paginasPermitidas)) {
    require_once($pagina . '.php');
} else {
    require_once('listar.php');
}
?>
