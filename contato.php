<!-- CONTEUDO REVISADO/ACESSIBILIDADE CHECADA-->
<!--Enviar Email-->
<?php
require_once __DIR__ . '/env/.env.php';
require_once __DIR__ . '/env/Database.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$ok = 0;
$mensagem = '';
$nome = '';
$email = '';
$fone = '';
$mens = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $honeyPot = trim((string) ($_POST['website'] ?? ''));

  if ($honeyPot !== '') {
    $ok = 3;
    $mensagem = 'Mensagem recebida.';
  } else {
    $nome = mb_substr(strip_tags(trim((string) ($_POST['nome'] ?? ''))), 0, 100);
    $email = mb_substr(strip_tags(trim((string) ($_POST['email'] ?? ''))), 0, 255);
    $fone = mb_substr(strip_tags(trim((string) ($_POST['fone'] ?? ''))), 0, 30);
    $mens = mb_substr(strip_tags(trim((string) ($_POST['mens'] ?? ''))), 0, 2000);

    if ($nome === '' || $email === '' || $fone === '' || $mens === '') {
      $ok = 3;
      $mensagem = 'Preencha todos os campos para enviar sua mensagem.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $ok = 3;
      $mensagem = 'Informe um e-mail válido.';
    } elseif (!preg_match('/^\+?[0-9\s().-]{8,20}$/', $fone)) {
      $ok = 3;
      $mensagem = 'Informe um telefone válido.';
    } else {
      require_once __DIR__ . '/mailer/Exception.php';
      require_once __DIR__ . '/mailer/PHPMailer.php';
      require_once __DIR__ . '/mailer/SMTP.php';

      $mail = new PHPMailer(true);

      try {
        $smtpHost = fitnessFusionConfig('smtp_host');
        $smtpUsername = fitnessFusionConfig('smtp_username');
        $smtpPassword = fitnessFusionConfig('smtp_password');
        $smtpFrom = fitnessFusionConfig('smtp_from');
        $smtpTo = fitnessFusionConfig('smtp_to');
        $smtpPort = (int) fitnessFusionConfig('smtp_port', 465);

        if ($smtpHost === '' || $smtpUsername === '' || $smtpPassword === '' || $smtpFrom === '' || $smtpTo === '') {
          $ok = 2;
          $mensagem = 'No momento, não foi possível enviar sua mensagem. Configure as credenciais SMTP do site.';
        } else {
          $mail->CharSet = 'UTF-8';
          $mail->isSMTP();
          $mail->Host = $smtpHost;
          $mail->SMTPAuth = true;
          $mail->Username = $smtpUsername;
          $mail->Password = $smtpPassword;
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
          $mail->Port = $smtpPort;

          $mail->setFrom($smtpFrom, 'Site Fitness Fusion');
          $mail->addAddress($smtpTo);

          $mail->isHTML(true);
          $mail->Subject = 'Contato Fitness Fusion';
          $mail->Body = "
            <strong>Mensagem do site Fitness Fusion</strong>
            <br><br>
            <strong>Nome:</strong> {$nome}<br>
            <strong>Email:</strong> {$email}<br>
            <strong>Telefone:</strong> {$fone}<br>
            <strong>Mensagem:</strong> {$mens}
          ";
          $mail->AltBody = "Mensagem do site Fitness Fusion\n\nNome: {$nome}\nEmail: {$email}\nTelefone: {$fone}\nMensagem: {$mens}";

          $mail->send();
          $ok = 1;
          $mensagem = sprintf('%s, sua mensagem foi enviada com sucesso!', htmlspecialchars($nome, ENT_QUOTES, 'UTF-8'));
        }
      } catch (Exception $e) {
        $ok = 2;
        $mensagem = 'Não foi possível enviar sua mensagem. Tente novamente em alguns minutos.';
      }
    }
  }
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
  <title>Contato - Academia Fitness Fusion</title>
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

  <!--############### CABEÇALHO ###############-->
  <header>
    <div id="menu-fixo" class="menu">
      <div>
        <!-- Logo com link para a página inicial -->
        <a href="index.php" aria-label="Voltar para a página inicial">
          <h1 class="logo" aria-hidden="true"> Contato - Academia Fitness Fusion</h1>
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
  <!--############### FIM CABEÇALHO ###############-->
  <!--########### CONTEUDO ###########-->
  <main>

    <div>

      <section class="form">

        <div class="site">

          <h2 class="titulo wow animate__animated animate__fadeIn" onclick="window.location.href='contato.php';">
            Entre em Contato
          </h2>

          <h5 aria-live="polite">
            <?php echo htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8'); ?>
          </h5>

          <div>

            <div class="wow animate__animated animate__fadeIn">

              <H3>
                Academia Fitness Fusion
              </H3>

              <a href="https://www.google.com.br/maps/place/Senac+S%C3%A3o+Miguel+Paulista/@-23.4955923,-46.434437,17z/data=!3m1!4b1!4m6!3m5!1s0x94ce63dda7be6fb9:0xa74e7d5a53104311!8m2!3d-23.4955972!4d-46.4318621!16s%2Fg%2F11c5bl2g7p?entry=ttu" target="_blank" rel="noopener noreferrer">
                Avenida Marechal Tito, 1500 - São Miguel Paulista, São Paulo - SP, 08010-090
              </a>

              <p>
                Telefone:(11)96262-6565
              </p>

              <a href="mailto:fitnessfusion@ti22.smpsistema.com.br">
                fitnessfusion@ti22.smpsistema.com.br
              </a>

            </div>

            <form class="wow animate__animated animate__fadeIn" action="contato.php" method="post">

              <div>

                <div>
                  <input type="text" name="nome" id="nome" placeholder="informe seu nome" required>
                </div>

                <div>
                  <input type="email" name="email" id="email" placeholder="informe seu email" required>
                </div>

                <div>
                  <input type="tel" name="fone" id="fone" placeholder="informe seu telefone" required>
                </div>

              </div>

              <div>

                <div>
                  <textarea name="mens" id="mens" cols="30" rows="10" placeholder="informe sua mensagem"></textarea>
                </div>

                <div style="display:none;">
                  <label for="website">Deixe em branco</label>
                  <input type="text" name="website" id="website" tabindex="-1" autocomplete="off">
                </div>

                <div>
                  <input type="submit" value="enviar">
                </div>

              </div>

            </form>

          </div>

        </div>

      </section>

      <section class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3659.0254648900777!2d-46.434437023761696!3d-23.495592259181063!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce63dda7be6fb9%3A0xa74e7d5a53104311!2sSenac%20S%C3%A3o%20Miguel%20Paulista!5e0!3m2!1spt-BR!2sbr!4v1710505040919!5m2!1spt-BR!2sbr" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </section>

    </div>

  </main>
  <!--########### FIM CONTEUDO ###########-->

  <?php require_once('conteudo/rodape.php'); ?><!-- ###### RODAPÉ ########## -->

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