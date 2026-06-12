<?php
require_once(__DIR__ . '/../env/.env.php');
require_once(__DIR__ . '/../env/Session.php');
require_once(__DIR__ . '/../env/Database.php');
require_once(__DIR__ . '/class/ClassCliente.php');
require_once(__DIR__ . '/class/ClassFuncionario.php');

Session::start();

$cliente = new ClassCliente();
$funcionario = new ClassFuncionario();

$tipo = '';
$nome = '';
$foto = '';

if (isset($_SESSION['idCliente'])) {
    $tipo = 'aluno';
    $tipoFoto = 'cliente/';
    $idCliente = $_SESSION['idCliente'];
    $nomecliente = $cliente->BuscarPorId($idCliente);
    if ($nomecliente) {
        $nome = htmlspecialchars($nomecliente->nomeCliente, ENT_QUOTES, 'UTF-8');
        $foto = htmlspecialchars($nomecliente->fotoCliente, ENT_QUOTES, 'UTF-8');
    } else {
        echo "Cliente não encontrado.";
    }
} elseif (isset($_SESSION['idFuncionario'])) {
    $tipo = 'funcionario';
    $tipoFoto = 'funcionario/';
    $idFuncionario = $_SESSION['idFuncionario'];
    $nomeFuncionario = $funcionario->BuscarPorId($idFuncionario);
    if ($nomeFuncionario) {
        $nome = htmlspecialchars($nomeFuncionario->nomeFuncionario, ENT_QUOTES, 'UTF-8');
        $foto = htmlspecialchars($nomeFuncionario->fotoFuncionario, ENT_QUOTES, 'UTF-8');
    } else {
        echo "Funcionário não encontrado.";
    }
} else {
    header('Location: ' . BASE_URL . 'login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/logoFitnessvazio.svg" type="image/svg+xml">
    <title>ADMINISTRATIVO - ACADEMIA FITNESS FUSION</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <section class="topoDash">
            <h1 class="logo">
                Dashboard - Fitness Fusion
            </h1>
            <div class="group">
                <svg class="icon" aria-hidden="true" viewBox="0 0 24 24">
                    <g>
                        <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>
                    </g>
                </svg>
                <input id="searchInput" placeholder="Search" type="search" class="input">
                <div id="suggestions" class="suggestions-container"></div>
            </div>
            <div id="searchResults"></div>
            <section>
                <button class="button">
                    <svg viewBox="0 0 448 512" class="bell">
                        <path d="M224 0c-17.7 0-32 14.3-32 32V49.9C119.5 61.4 64 124.2 64 200v33.4c0 45.4-15.5 89.5-43.8 124.9L5.3 377c-5.8 7.2-6.9 17.1-2.9 25.4S14.8 416 24 416H424c9.2 0 17.6-5.3 21.6-13.6s2.9-18.2-2.9-25.4l-14.9-18.6C399.5 322.9 384 278.8 384 233.4V200c0-75.8-55.5-138.6-128-150.1V32c0-17.7-14.3-32-32-32zm0 96h8c57.4 0 104 46.6 104 104v33.4c0 47.9 13.9 94.6 39.7 134.6H72.3C98.1 328 112 281.3 112 233.4V200c0-57.4 46.6-104 104-104h8zm64 352H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7s18.7-28.3 18.7-45.3z"></path>
                    </svg>
                </button>
                <button id="config" class="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 20 20" height="20" fill="none" class="svg-icon">
                        <g stroke-width="1.5" stroke-linecap="round" stroke="#ffffff">
                            <circle r="2.5" cy="10" cx="10"></circle>
                            <path fill-rule="evenodd" d="m8.39079 2.80235c.53842-1.51424 2.67991-1.51424 3.21831-.00001.3392.95358 1.4284 1.40477 2.3425.97027 1.4514-.68995 2.9657.82427 2.2758 2.27575-.4345.91407.0166 2.00334.9702 2.34248 1.5143.53842 1.5143 2.67996 0 3.21836-.9536.3391-1.4047 1.4284-.9702 2.3425.6899 1.4514-.8244 2.9656-2.2758 2.2757-.9141-.4345-2.0033.0167-2.3425.9703-.5384 1.5142-2.67989 1.5142-3.21831 0-.33914-.9536-1.4284-1.4048-2.34247-.9703-1.45148.6899-2.96571-.8243-2.27575-2.2757.43449-.9141-.01669-2.0034-.97028-2.3425-1.51422-.5384-1.51422-2.67994.00001-3.21836.95358-.33914 1.40476-1.42841.97027-2.34248-.68996-1.45148.82427-2.9657 2.27575-2.27575.91407.4345 2.00333-.01669 2.34247-.97026z" clip-rule="evenodd"></path>
                        </g>
                    </svg>
                    <span class="lable"></span>
                </button>
                <hr>
                <div class="perfil">
                    <div>
                        <div>
                            <h2><?php echo $nome; ?></h2>
                            <h3><?php echo htmlspecialchars($tipo, ENT_QUOTES, 'UTF-8'); ?></h3>
                        </div>
                        <img src="img/<?php echo htmlspecialchars($tipoFoto . $foto, ENT_QUOTES, 'UTF-8'); ?>" alt="foto <?php echo $nome ?>">
                    </div>
                    <?php
                    if ($tipo === 'aluno') {
                    ?>
                        <nav class="config" aria-label="Menu de configuração">
                            <ul>
                                <li><a href="index.php?p=<?php echo $tipo; ?>&c=atualizar&id=<?php echo (int)$idCliente; ?>">Perfil</a></li>
                                <li><a href="pagamentos.php">Pagamentos</a></li>
                                <li><a href="feedback.php">Feedback</a></li>
                                <li><a href="ajuda.php">Ajuda/Suporte</a></li>
                                <li><a href="sair.php">Sair</a></li>
                            </ul>
                        </nav>
                    <?php
                    } elseif ($tipo === 'funcionario') {
                    ?>
                        <nav class="config" aria-label="Menu de configuração">
                            <ul>
                                <li><a href="index.php?p=<?php echo $tipo; ?>&c=atualizar&id=<?php echo (int)$idFuncionario; ?>">Perfil</a></li>
                                <li><a href="ajuda.php">Ajuda/Suporte</a></li>
                                <li><a href="sair.php">Sair</a></li>
                            </ul>
                        </nav>
                    <?php
                    }
                    ?>
                </div>
            </section>
        </section>
    </header>

    <div class="dashboard">
        <aside>
            <div class="sidebarDash">
                <div class="sidebarDash-menu">
                    <nav>
                        <ul>
                            <li>
                                <a href="index.php?p=dashboard"><span class="las la-home"></span>
                                    <span>Dashboard</span></a>
                            </li>
                            <?php if ($tipo === 'funcionario') : ?>
                                <li>
                                    <a href="index.php?p=aluno"><span class="las la-users"></span>
                                        <span>Alunos</span></a>
                                </li>
                                <li>
                                    <a href="index.php?p=evento"><span class="las la-calendar"></span>
                                        <span>Eventos</span></a>
                                </li>
                                <li>
                                    <a href="index.php?p=modalidade"><span class="las la-shapes"></span>
                                        <span>Modalidades</span></a>
                                </li>
                                <li>
                                    <a href="index.php?p=banner"><span class="las la-photo-video"></span>
                                        <span>Banner</span></a>
                                </li>
                                <li>
                                    <a href="index.php?p=contato"><span class="las la-envelope"></span>
                                        <span>Contato</span></a>
                                </li>
                                <li>
                                    <a href="index.php?p=feedback"><span class="las la-comment-alt"></span>
                                        <span>Feedback</span></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </aside>
        <main>
            <div>
                <?php
                $pagina = $_GET['p'] ?? 'dashboard';
                $paginasPermitidas = ['dashboard', 'aluno', 'contato', 'banner', 'modalidade', 'evento', 'feedback'];

                // Define o caminho base a partir da pasta dashboard
                $basePath = __DIR__ . '/pagina/';

                if (in_array($pagina, $paginasPermitidas)) {
                    $caminho = $basePath . $pagina . '/' . $pagina . '.php';
                    if (file_exists($caminho)) {
                        require_once($caminho);
                    } else {
                        echo "<p>Erro: Arquivo não encontrado em: " . htmlspecialchars($caminho) . "</p>";
                    }
                } else {
                    require_once($basePath . 'dashboard/dashboard.php');
                }
                ?>
            </div>
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/animaDash.js"></script>
</body>

</html>