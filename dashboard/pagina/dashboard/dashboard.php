<?php
// Usamos dirname(__DIR__, 3) para subir até a pasta FitnessFusion/class
require_once(dirname(__DIR__, 3) . '/class/ClassCliente.php');
require_once(dirname(__DIR__, 3) . '/class/Conexao.php');

$cliente = new ClassCliente();
$lista = $cliente->Listar(); // Retorna o que o seu método Listar() entrega

$conexao = Conexao::LigarConexao();

// Consultas de contagem (Seguras)
$sqlAtivos = $conexao->query("SELECT COUNT(idCliente) AS total FROM cliente WHERE statusCliente = 'ATIVO';");
$ativos = $sqlAtivos->fetch(PDO::FETCH_ASSOC);

$sqlInativos = $conexao->query("SELECT COUNT(idCliente) AS total FROM cliente WHERE statusCliente = 'INATIVO';");
$inativos = $sqlInativos->fetch(PDO::FETCH_ASSOC);

// Buscar últimos clientes
$stmt = $conexao->prepare("SELECT c.nomeCliente, c.fotoCliente, c.altCliente, c.telefoneCliente, p.nomePlano 
                           FROM cliente c 
                           INNER JOIN planoAssinatura p ON c.idPlano = p.idPlano 
                           WHERE c.statusCliente = 'ATIVO' 
                           ORDER BY c.dataCadCliente DESC LIMIT 5");
$stmt->execute();
$novosClientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section>
    <div class="dadoPrimario">
        <div>
            <div><img src="../img/cliente.png" alt="Icone"></div>
            <div><h2><?php echo $ativos['total'] ?? 0; ?></h2><h3>Clientes</h3></div>
        </div>
        <div>
            <div><img src="../img/visualizacoes.png" alt="Icone"></div>
            <div><h2>5.326</h2><h3>Visualizações</h3></div>
        </div>
        <div>
            <div><img src="../img/contrato.png" alt="Icone"></div>
            <div><h2><?php echo $inativos['total'] ?? 0; ?></h2><h3>Matriculas canceladas</h3></div>
        </div>
    </div>
</section>

<section>
    <div class="cliente">
        <div class="card">
            <div class="card-header"><h3>Alunos</h3></div>
            <div class="card-body">
                <div class="tabelaDash">
                    <table>
                        <thead>
                            <tr><td>Foto</td><td>Nome</td><td>Plano</td><td>Telefone</td></tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($lista)) : foreach ($lista as $l) : 
                                // Tratamento para Array ou Objeto
                                $row = (array)$l; 
                            ?>
                                <tr>
                                    <td><img src="../img/cliente/<?php echo htmlspecialchars($row['fotoCliente'], ENT_QUOTES, 'UTF-8'); ?>" width="50"></td>
                                    <td><?php echo htmlspecialchars($row['nomeCliente'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($row['nomePlano'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($row['telefoneCliente'], ENT_QUOTES, 'UTF-8'); ?></td>
                                </tr>
                            <?php endforeach; else: ?>
                                <tr><td colspan="4">Nenhum aluno encontrado.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="customers">
            <div class="card">
                <div class="card-header"><h3>Novos alunos</h3></div>
                <div class="card-body">
                    <?php foreach ($novosClientes as $nc) : ?>
                        <div class="customer">
                            <div class="info">
                                <img src="../img/cliente/<?php echo htmlspecialchars($nc['fotoCliente'], ENT_QUOTES, 'UTF-8'); ?>" width="40">
                                <div>
                                    <h4><?php echo $nc['nomeCliente']; ?></h4>
                                    <h4><?php echo $nc['telefoneCliente']; ?></h4>
                                </div>
                            </div>
                            <div><h4><?php echo $nc['nomePlano']; ?></h4></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>