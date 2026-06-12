<!-- chamando a clase com seus atributos e metodos-->
<?php
require_once(__DIR__ . '/../../class/Conexao.php');
require_once(__DIR__ . '/../../class/ClassCliente.php');
$cliente = new ClassCliente();
$lista = $cliente->Listar();

?>

<a class="btn btnCad" href="index.php?p=aluno&c=inserir"> + Cadastrar Aluno</a>

<div class="card">
    <div class="card-header">
        <h3>Alunos</h3>
    </div>

    <div class="card-body">
        <div class="tabela">
            <table>
                <thead>
                    <tr>
                        <td scope="col">Foto</td>
                        <td scope="col">Nome</td>
                        <td scope="col">Plano</td>
                        <td scope="col">E-mail</td>
                        <td scope="col">Telefone</td>
                        <td scope="col">Atualizar</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista as $linha) : ?> <!-- laço repetição-->
                        <tr>
                            <?php $linha['idCliente']; ?>
                            <td><img src="img/cliente/<?php echo htmlspecialchars($linha['fotoCliente'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($linha['altCliente'], ENT_QUOTES, 'UTF-8'); ?>"></td>
                            <td><?php echo htmlspecialchars($linha['nomeCliente'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($linha['nomePlano'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($linha['emailCliente'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($linha['telefoneCliente'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><a class="btn btn" href="index.php?p=aluno&c=atualizar&id=<?php echo htmlspecialchars($linha['idCliente'], ENT_QUOTES, 'UTF-8'); ?>"><span class="las la-edit"></span></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>