<!-- chamando a clase com seus atributos e metodos-->
<?php
require_once(__DIR__ . '/../../class/ClassEvento.php');
$evento = new ClassEvento();
$lista = $evento->Listar();
?>

<a class="btn btnCad" href="index.php?p=evento&e=inserir"> + Cadastrar Evento</a>

<div class="card">
    <div class="card-header">
        <h3>Eventos</h3>
    </div>

    <div class="card-body">
        <div class="tabela">
            <table>
                <thead>
                    <tr>
                        <td scope="col">Titulo</td>
                        <td scope="col">Data</td>
                        <td scope="col">Status</td>
                        <td scope="col">Atualizar</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista as $linha) : ?> <!-- laço repetição-->
                        <tr>
                            <?php $linha['idEvento']; ?>
                            <td><?php echo $linha['nomeEvento']; ?></td>
                            <td><?php echo $linha['dataEvento']; ?></td>
                            <td><?php echo $linha['statusEvento']; ?></td>
                            <td><a class="btn" href="index.php?p=evento&e=atualizar&id=<?php echo $linha['idEvento']; ?>"><span class="las la-edit"></span></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>