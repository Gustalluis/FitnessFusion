<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Equipe GKR">
  <meta name="description" content="A Academia Fitness Fusion: Inspire-se. Transpire. Conquiste.">
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


  <?php require_once('conteudo/topo.php'); ?><!--########### MENU ###########-->


  <main>

    <div>

      <section class="form">

        <div class="site">

          <h2>Entre em Contato</h2>

          <div>
            <div>
                <H3>Academia Fitness Fusion Unidade São Paulo</H3>
                <p></p>
            </div>
          

          <form action="#" method="post">

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

              <div>
                <input type="submit" value="enviar por email">
              </div>

            </div>

          </form>

          </div>

        </div>

      </section>

      <section class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3659.0254648900777!2d-46.434437023761696!3d-23.495592259181063!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce63dda7be6fb9%3A0xa74e7d5a53104311!2sSenac%20S%C3%A3o%20Miguel%20Paulista!5e0!3m2!1spt-BR!2sbr!4v1710505040919!5m2!1spt-BR!2sbr" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </section>


      <?php require_once("conteudo/cont-comenterios.php") ?><!-- ###### COMENTARIOS ########## -->


    </div>
  </main>

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