<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Equipe GKR">
  <meta name="description" content="A Academia Fitness Fusion: Inspire-se. Transpire. Conquiste.">
  <title>Sobre - Academia Fitness Fusion</title>
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
    
    <?php require_once('conteudo/topo.php'); ?><!--############# Começo do menu ###########-->
   
    <main>
      
      <?php require_once('conteudo/cont-sobre.php'); ?><!--######### Inicio Sobre #########-->
      
      <article class="site  wow animate__animated animate__fadeInUp">
        <div class="">
          <div>
            <img src="img/sobre.png" alt="Academia Fitness Fusion">
          </div>
          <div>
            <h2>Academia Fitness Fusion</h2>
            <p>
            Com mais de 8 anos de trajetória, a Academia Fitness Fusion se estabeleceu como uma referência em saúde e bem-estar. Nossa mensagem é simples, mas poderosa: 'Pratique Saúde'.
            </p>
          </div>
        </div>
      </article>
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