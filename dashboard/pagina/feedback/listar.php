<!-- chamando a clase com seus atributos e metodos-->
<?php
require_once(__DIR__ . '/../../class/ClassFeedback.php');
$feedback = new ClassFeedback();
$lista = $feedback->Listar();
?>



<div class="card">
    <div class="card-header">
        <h3>Feedback</h3>
    </div>

    <div class="card-body">
        <div class="tabela">
            <table>
                <thead>
                    <tr>
                        <td scope="col">Nome</td>
                        <td scope="col">Data</td>
                        <td scope="col">Tipo</td>
                        <td scope="col">Conteudo</td>
                        <td scope="col">Leitura</td>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista as $linha) : ?> <!-- laço repetição-->
                        <tr>
                            
                            <td><?php echo $linha['nomeCliente']; ?></td>
                            <td><?php echo $linha['dataFeedback']; ?></td>
                            <td><?php echo $linha['tipoFeedback']; ?></td>
                            <td><?php echo $linha['conteudoFeedback']; ?></td>
                            <td><a class="btn" href="index.php?p=feedback&feed=atualizar&id=<?php echo $linha['idFeedback']; ?>"><span class="las la-envelope-open"></span></a></td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>