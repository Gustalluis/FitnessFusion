<?php
// ############################################################################
// 1. IMPORTAÇÕES E CONFIGURAÇÕES DE ERRO (CRUCIAL PARA AMBIENTE LINUX)
// ############################################################################

require_once('env/.env.php');
require_once('dashboard/class/Conexao.php');
require_once('dashboard/class/ClassEvento.php');
require_once('dashboard/class/ClassModalidade.php');

if (getenv('APP_ENV') === 'production') {
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);
} else {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}


// ############################################################################
// 2. INSTANCIAÇÃO DE OBJETOS E COLETA DE DADOS DA SUA CLASSE
// ############################################################################

$objEvento = new ClassEvento();
$objModalidade = new ClassModalidade();
$modalidades = $objModalidade->ListarPublicas();


// ############################################################################
// 3. PROCESSAMENTO DOS EVENTOS (PROTEÇÃO CONTRA TABELA AUSENTE NO BANCO)
// ############################################################################

$eventos = [];
try {
    // Tenta buscar os eventos da classe ClassEvento
    $lista = $objEvento->listar(); 
    
    // Se a tabela existir e retornar dados válidos, monta o array do calendário
    if (is_array($lista) || is_object($lista)) {
        foreach ($lista as $linha) {
          $itemEvento = [
            'id'    => $linha['idEvento'] ?? '',
            'name'  => $linha['nomeEvento'] ?? '',
            'date'  => isset($linha['dataEvento']) ? date('F d, Y', strtotime($linha['dataEvento'])) : '',
            'type'  => 'event',
          ];
          $eventos[] = $itemEvento;
        }
    }
} catch (Exception $e) {
    // Se a tabela 'evento' não existir no banco local do XAMPP, o try/catch impede
    // a página de quebrar, deixando o calendário apenas vazio no final do site.
    $eventos = []; 
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Equipe GKR">
  <meta name="description" content="A Academia Fitness Fusion: Inspire-se. Transpire. Conquiste.">
  <link rel="icon" href="img/logo/logoFitnessvazio.svg" type="image/svg+xml">
  <title>Modalidades - Academia Fitness Fusion</title>
  
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="css/slick.css">
  <link rel="stylesheet" href="css/slick-theme.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link rel="stylesheet" href="css/evo-calendar.css" />
  <link rel="stylesheet" href="css/evo-calendar.midnight-blue.css" />
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/responsive.css">
</head>

<body>

  <header>
    <div id="menu-fixo" class="menu">
      <div>
        <a href="index.php" aria-label="Voltar para a página inicial">
          <h1 class="logo" aria-hidden="true">Modalidades - Academia Fitness Fusion</h1>
        </a>

        <label id="menu" class="hamburger">
          <input type="checkbox" id="menuCheckbox">
          <svg viewBox="0 0 32 32">
            <path class="line line-top-bottom" d="M27 10 13 10C10.8 10 9 8.2 9 6 9 3.5 10.8 2 13 2 15.2 2 17 3.8 17 6L17 26C17 28.2 18.8 30 21 30 23.2 30 25 28.2 25 26 25 23.8 23.2 22 21 22L7 22"></path>
            <path class="line" d="M7 16 27 16"></path>
          </svg>
        </label>

        <nav class="navegacao" aria-label="Menu de navegação principal">
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="sobre.php">Sobre</a></li>
            <li><a href="modalidades.php">Modalidades</a></li>
          <li><a href="planos.php">Planos</a></li>
            <li><a href="contato.php">Contato</a></li>
          </ul>

          <div class="btn">
            <span class="material-symbols-outlined" aria-hidden="true">group</span>
            <a class="areaAluno" href="login.php" role="button" aria-label="Área do Aluno">Área Do Usuário</a>
          </div>
        </nav>
      </div>
    </div>
  </header>

  <main>
    <article>
      <img class="banner" src="img/banner/bannerModalidade.jpeg" alt="Banner Modalidades" aria-hidden="true">
      <h3 class="tituloSobreBanner wow animate__animated animate__zoomIn">modalidades</h3>
    </article>

    <div class="corpoModalidade">
      <aside class="wow animate__animated animate__fadeInLeft">
        <h2 class="titulo">Modalidades</h2>
        <nav class="sidebar" aria-label="Menu de modalidades">
          <ul class="modalidadesHover">
            <?php foreach ($modalidades as $linha) : ?>
              <li><a href="#"><?php echo htmlspecialchars((string) $linha['nomeModalidade'], ENT_QUOTES, 'UTF-8'); ?></a></li>
            <?php endforeach; ?>
          </ul>
        </nav>
      </aside>

      <main>
        <ul class="fotoModalidade">
          <?php foreach ($modalidades as $linha) : ?>
            <li class="wow animate__animated animate__slideInRight">
              <a href="#">
                <img src="<?php echo ClassModalidade::PUBLIC_PATH . rawurlencode(basename((string) $linha['fotoModalidade'])); ?>" alt="<?php echo htmlspecialchars((string) $linha['altModalidade'], ENT_QUOTES, 'UTF-8'); ?>">
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </main>
    </div>

    <h2 class="titulo wow animate__animated animate__fadeInUp">Aulas</h2>
    <div class="wow animate__animated animate__fadeInUp" id="calendar"></div>
  </main>

  <?php require_once('conteudo/rodape.php'); ?>

  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="js/slick.min.js"></script>
  <script src="js/wow.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/evo-calendar@1.1.2/evo-calendar/js/evo-calendar.min.js"></script>
  <script src="js/animacoes.js"></script>
  
  <script>
    $(document).ready(function() {
      // Injeta de forma segura o array processado pelo PHP transformando-o em formato JSON
      let eventos = <?php echo json_encode($eventos, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;

      // Configuração inicial do Calendário
      $("#calendar").evoCalendar({
        theme: "Midnight Blue",
        language: "pt",
        format: "dd MM, yyyy",
        titleFormat: "MM",
        todayHighlight: true,
        sidebarDisplayDefault: false,
        eventDisplayDefault: true,
        eventListToggler: true,
        calendarEvents: eventos,
      });
    });
  </script>
</body>

</html>