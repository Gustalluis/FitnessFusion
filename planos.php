<!-- CONTEUDO REVISADO/ACESSIBILIDADE CHECADA-->
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Equipe GKR">
  <meta name="description" content="A Academia Fitness Fusion: Inspire-se. Transpire. Conquiste.">
  <link rel="icon" href="img/logo/logoFitnessvazio.svg" type="image/svg+xml">
  <title>Planos - Academia Fitness Fusion</title>
  <!--############# Links/Referencias ##################-->
  <!--############# RESETA ##################-->
  <link rel="stylesheet" href="css/reset.css">
  <!--############# GOOGLE ##################-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <!--############# SLICK ##################-->
  <link rel="stylesheet" href="css/slick.css">
  <link rel="stylesheet" href="css/slick-theme.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <!--############# ESTILO ##################-->
  <link rel="stylesheet" href="css/style.css">
  <!--############# RESPONSIVO ##################-->
  <link rel="stylesheet" href="css/responsive.css">
</head>

<body>
  <header>
    <div id="menu-fixo" class="menu">
      <div>
        <!-- Logo com link para a página inicial -->
        <a href="index.php" aria-label="Voltar para a página inicial">
          <h1 class="logo" aria-hidden="true">Planos - Academia Fitness Fusion</h1>
        </a>

        <!-- Botão de menu para abrir o menu de navegação -->
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

      <div class="banner">
        <img src="img/banner/bannerPlano.png" alt="Banner Fitness Fusion" aria-label="Banner Declarando a promoção de 9,99 reais na primeira mensalidade.">
      </div>

      <div class="programasFit wow animate__animated animate__zoomIn">

        <div>
          <div>
            <span class="material-symbols-outlined">horizontal_rule</span>
          </div>
          <div>
            <h3>Fitness Fusion</h3>
          </div>
          <div>
            <span class="material-symbols-outlined">horizontal_rule</span>
          </div>
        </div>

        <div>

          <div>
            <p>Planos a partir de</p>

            <div>
              <h6>R$</h6>
              <h4>9,90</h4>
            </div>

          </div>

          <div>
            <a class="btn matricula" href="#" role="button">Matricule-se já<span class="material-symbols-outlined">arrow_outward</span></a>
          </div>

        </div>

      </div>

    </article>

    <article>

      <div class="vantagemFit">

        <div class="site">

          <div class="diferencialEsquerda wow animate__animated animate__slideInLeft">

            <h3>Diferencial da</h3>
            <h2>Fitness Fusion</h2>

            <div>
              <div class="wow animate__animated animate__fadeInBottomLeft">
                <img src="img/plano/arcondicionado.png" alt="Ar-condicionado" aria-hidden="true">
                <h4>Ar-Condicionado</h4>
              </div>
              <div class="wow animate__animated animate__fadeInBottomLeft">
                <img src="img/plano/armario.png" alt="Armarios" aria-hidden="true">
                <h4>Armarios Rotativos</h4>
              </div>
              <div class="wow animate__animated animate__fadeInBottomLeft">
                <img src="img/plano/estacionamento.png" alt="Estacionamento" aria-hidden="true">
                <h4>Estacionamento</h4>
              </div>
              <div class="wow animate__animated animate__fadeInBottomLeft">
                <img src="img/plano/chuveiro.png" alt="Chuveiro" aria-hidden="true">
                <h4>Chuveiro</h4>
              </div>
            </div>

          </div>

          <div class="diferencialDireita wow animate__animated animate__slideInRight">

            <h3>Programas</h3>
            <h2>Fit Fusion</h2>

            <div class="fitfusion wow animate__animated animate__fadeInRight">
              <img src="img/plano/programas1.jpeg" alt="programas FitFusion">
              <img src="img/plano/programas2.jpeg" alt="programas FitFusion">
              <img src="img/plano/programas.jpeg" alt="programas FitFusion">
            </div>

          </div>

        </div>
        <h2 class="titulo wow animate__animated animate__fadeInUp">Planos</h2>
      </div>

      <article>

        <div class="planosP">

          <div class="site wow animate__animated animate__fadeInUp">

            <section>

              <h2>Plano Mensal Básico</h2>

              <h3>$49</h3>

              <ul>

                <li>
                  <span class="material-symbols-outlined">check_circle</span>
                  Acesso ilimitado às áreas de treino de peso livre e máquinas.
                </li>

                <li>
                  <span class="material-symbols-outlined">check_circle</span>
                  Participação em aulas de grupo básicas, como aeróbica e alongamento.
                </li>

                <li>
                  <span class="material-symbols-outlined">check_circle</span>
                  Acesso a instalações como vestiários e chuveiros.
                </li>

                <li>
                  <span class="material-symbols-outlined">check_circle</span>
                  Orientação inicial de um instrutor de fitness.
                </li>

              </ul>

              <a class="btn" href="#" role="button" aria-label="Matricule-se 'Plano de R$49,99'">Matricule-se Já</a>

            </section>

            <section>

              <h2 class="recomendado">Recomendado</h2>

              <h2>Plano Mensal Padrão</h2>

              <h3>$79</h3>

              <ul>

                <li>
                  <span class="material-symbols-outlined">check_circle</span>
                  Todos os benefícios do plano básico.
                </li>

                <li>
                  <span class="material-symbols-outlined">check_circle</span>
                  Acesso a aulas de grupo especializadas, como spinning, pilates e treinamento funcional.
                </li>

                <li>
                  <span class="material-symbols-outlined">check_circle</span>
                  Possibilidade de agendamento de sessões individuais com instrutores.
                </li>

                <li>
                  <span class="material-symbols-outlined">check_circle</span>
                  Acompanhamento periódico de progresso com um personal trainer.
                </li>

              </ul>

              <a class="btn" href="#" role="button" aria-label="Matricule-se 'Plano de R$79,99'">Matricule-se Já</a>

            </section>

            <section>

              <h2>Plano Mensal Premium</h2>

              <h3>$99</h3>

              <ul>

                <li>
                  <span class="material-symbols-outlined">check_circle</span>
                  Todos os benefícios do plano padrão.
                </li>

                <li>
                  <span class="material-symbols-outlined">check_circle</span>
                  Acesso exclusivo a áreas VIP da academia, como salas de treinamento privadas.
                </li>

                <li>
                  <span class="material-symbols-outlined">check_circle</span>
                  Sessões individuais de treinamento personalizado com os melhores instrutores.
                </li>

                <li>
                  <span class="material-symbols-outlined">check_circle</span>
                  Acompanhamento nutricional detalhado com consultas regulares.
                </li>

              </ul>

              <a class="btn" href="#" role="button" aria-label="Matricule-se 'Plano de R$99,99'">Matricule-se Já</a>

            </section>

          </div>

        </div>

      </article>

    </article>

  </main>

  <?php require_once('conteudo/rodape.php'); ?>

  <!--######### BIBLIOTECAS #########-->
  <!-- jquery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <!-- SLICK JS -->
  <script src="js/slick.min.js"></script>
  <!-- WOW -->
  <script src="js/wow.min.js"></script>
  <!-- JS -->
  <script src="js/animacoes.js"></script>

</body>

</html>