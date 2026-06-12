<?php if (!isset($modalidades)) { $modalidades = []; } ?>
<article>
  <div class="modalidade">
    <div class="site">
      <h2 class="wow animate__animated animate__zoomIn titulo" onclick="window.location.href='modalidades.php';" aria-label="Ir para Modalidades">Modalidades</h2>
      <div class="boxmodalidade">
        <?php foreach ($modalidades as $linha) : ?> <!-- laço repetição-->
          <div class="wow animate__animated animate__zoomIn">
            <img src="<?php echo ClassModalidade::PUBLIC_PATH . rawurlencode(basename((string) $linha['fotoModalidade'])); ?>" alt="<?php echo htmlspecialchars((string) $linha['altModalidade'], ENT_QUOTES, 'UTF-8'); ?>">
            <h3><?php echo htmlspecialchars((string) $linha['nomeModalidade'], ENT_QUOTES, 'UTF-8'); ?></h3>
            <p><?php echo htmlspecialchars((string) $linha['conteudoModalidade'], ENT_QUOTES, 'UTF-8'); ?></p>
            <a class="btn btn-mod" href="modalidades.php" aria-label="Ler mais sobre <?php echo htmlspecialchars((string) $linha['altModalidade'], ENT_QUOTES, 'UTF-8'); ?>">Ler Mais</a>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</article>