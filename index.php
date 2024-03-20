<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Equipe GKR">
  <meta name="description" content="A Academia Fitness Fusion: Inspire-se. Transpire. Conquiste.">
  <title>Home - Academia Fitness Fusion</title>
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

  <?php require_once('conteudo/topo.php'); ?><!--############# MENU ###########-->

  <main>

    <div>

      <article><!--############ BANNER ##########-->
        <div class="banner">
          <img src="img/banner.png" alt="Banner Fitness Fusion">
        </div>
      </article>

      <?php require_once('conteudo/cont-sobre.php'); ?><!--######### SOBRE #########-->

      <?php require_once('conteudo/cont-modalidades.php'); ?><!--####### MODALIDADES #########-->

      <article><!--####### BANNER 2 #######-->
        <div class="bannerEvento">
          <img src="img/bannerEvento.png" alt="banner eventos academia Fitness Fusion">
          <img src="img/bannerEvento1.png" alt="banner eventos academia Fitness Fusion">
        </div>
      </article>

      <?php require_once('conteudo/cont-blog.php'); ?><!--####### BLOG #######-->

      <?php require_once('conteudo/cont-planos.php'); ?><!-- ######### PLANOS ########## -->

      <?php require_once("conteudo/cont-comenterios.php"); ?><!-- ######### Início Comentarios ########## -->

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