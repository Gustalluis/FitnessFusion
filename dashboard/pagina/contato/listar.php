 <!-- chamando a clase com seus atributos e metodos-->
<?php
require_once(__DIR__ . '/../../class/ClassContato.php');
$contato = new ClassContato();
$lista = $contato->Listar();
?>

<div class="card">
    <div class="card-header">
        <h3>Contatos</h3>
    </div>

    <div class="card-body">
        <div class="tabela">
            <table>
                <thead>
                    <tr>
                        <td scope="col">Nome</td>
                        <td scope="col">E-mail</td>
                        <td scope="col">Telefone</td>
                        <td scope="col">Mensagem</td>
                        <td scope="col">Status</td>
                        <td scope="col">Data</td>
                        <td scope="col">Hora</td>
                        <td scope="col">Leitura</td>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista as $linha) : ?> <!-- laço repetição-->
                        <tr>
                            <?php $linha['idContato']; ?>
                            <td><?php echo $linha['nomeContato']; ?></td>
                            <td><?php echo $linha['emailContato']; ?></td>
                            <td><?php echo $linha['telefoneContato']; ?></td>
                            <td><?php echo $linha['mensagemContato']; ?></td>
                            <td><?php echo $linha['statusContato']; ?></td>
                            <td><?php echo $linha['dataContato']; ?></td>
                            <td><?php echo $linha['horaContato']; ?></td>
                            <td><a class="btn" href="index.php?p=contato&cont=atualizar&id=<?php echo $linha['idContato']; ?>"><span class="las la-envelope-open"></span></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>