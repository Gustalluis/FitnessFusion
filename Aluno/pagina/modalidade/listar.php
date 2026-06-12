<?php
require_once(__DIR__ . '/../../../dashboard/class/ClassModalidade.php');

$modalidade = new ClassModalidade();
$lista = $modalidade->ListarPublicas();
?>

<div class="card">
    <div class="card-header">
        <h3>Modalidades</h3>
    </div>

    <div class="card-body">
        <div class="table">
            <table>
                <thead>
                    <tr>
                        <td scope="col">Foto</td>
                        <td scope="col">Nome</td>
                        <td scope="col">Conteudo</td>
                        <td scope="col">Status</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista as $linha) : ?>
                        <tr>
                            <td><img src="../<?php echo ClassModalidade::PUBLIC_PATH . rawurlencode(basename($linha['fotoModalidade'])); ?>" style="width: 100px; height: auto;" alt="<?php echo htmlspecialchars($linha['nomeModalidade'], ENT_QUOTES, 'UTF-8'); ?>"></td>
                            <td><?php echo htmlspecialchars($linha['nomeModalidade'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($linha['conteudoModalidade'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($linha['statusModalidade'], ENT_QUOTES, 'UTF-8'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
