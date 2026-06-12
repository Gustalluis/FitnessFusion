<!-- chamando a clase com seus atributos e metodos-->
<?php
require_once(__DIR__ . '/../../class/ClassModalidade.php');
$modalidade = new ClassModalidade();
$lista = $modalidade->Listar();
?>

<a class="btn btnCad" href="index.php?p=modalidade&m=inserir"> + Cadastrar Modalidade</a>

<div class="card">
    <div class="card-header">
        <h3>Modalidades</h3>
    </div>

    <div class="card-body">
        <div class="tabela">
            <table>
                <thead>
                    <tr>
                        <td scope="col">Foto</td>
                        <td scope="col">Nome</td>
                        <td scope="col">Conteudo</td>
                        <td scope="col">Status</td>
                        <td scope="col">Atualizar</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista as $linha) : ?>
                        <tr>
                            <td><img src="img/modalidade/<?php echo htmlspecialchars(basename($linha['fotoModalidade']), ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($linha['nomeModalidade'], ENT_QUOTES, 'UTF-8'); ?>"></td>
                            <td><?php echo htmlspecialchars($linha['nomeModalidade'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($linha['conteudoModalidade'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($linha['statusModalidade'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><a class="btn" href="index.php?p=modalidade&m=atualizar&id=<?php echo $linha['idModalidade']; ?>"><span class="las la-edit"></span></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>