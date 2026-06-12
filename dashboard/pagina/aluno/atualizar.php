<?php
require_once(__DIR__ . '/../../class/Conexao.php');
require_once(__DIR__ . '/../../class/ClassCliente.php');
$id = $_GET['id'];
$cliente = new ClassCliente($id);

if (isset($_POST['nomeCliente'])) {
    // Atualizar propriedades do cliente com os dados do formulário
    $cliente->nomeCliente = $_POST['nomeCliente'];
    $cliente->cpfCliente = $_POST['cpfCliente'];
    $cliente->telefoneCliente = $_POST['telefoneCliente'];
    $cliente->dataNascCliente = $_POST['dataNascCliente'];
    $cliente->emailCliente = $_POST['emailCliente'];
    $cliente->senhaCliente = $_POST['senhaCliente'];
    $cliente->statusCliente = $_POST['statusCliente'];
    $cliente->planoCliente = $_POST['planoCliente'];
    $cliente->treinoCliente = $_POST['treinoCliente'];
    $cliente->altCliente = "foto " . $_POST['nomeCliente'];
    $cliente->metodoPagamento = $_POST['metodoPagamento']; // Adicionando método de pagamento

    // Verificar se a foto foi modificada
    if (!empty($_FILES['foto']['name'])) {
        $novoId = $cliente->idCliente; // Usar a propriedade do cliente

        // Tratar o campo FILES
        $arquivo = $_FILES['foto'];
        if ($arquivo['error']) {
            throw new Exception('O erro foi: ' . $arquivo['error']);
        }


        $nomeCliFoto = str_replace(' ', '', $_POST['nomeCliente']); // Remover espaços em branco
        $nomeCliFoto = iconv('UTF-8', 'ASCII//TRANSLIT', $nomeCliFoto); // Eliminação de caracteres especiais
        $nomeCliFoto = strtolower($nomeCliFoto); // Deixar tudo minúsculo
        $novoNome = $novoId . '_' . $nomeCliFoto . '.jpeg';

        // 🗑️ Excluir a foto antiga se existir
        $uploadDir = __DIR__ . '/../../img/cliente/';
        $fotoAntiga = $uploadDir . $cliente->fotoCliente;
        if (!empty($cliente->fotoCliente) && file_exists($fotoAntiga)) {
            unlink($fotoAntiga);
        }

        // Mover a imagem
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        if (move_uploaded_file($arquivo['tmp_name'], $uploadDir . $novoNome)) {
            $cliente->fotoCliente = $novoNome;
        } else {
            throw new Exception('Não foi possível fazer o upload!');
        }
    }

    try {
        // Atualizar no banco de dados
        $cliente->Atualizar();
        echo "<script>document.location='index.php?p=dashboard'</script>";
    } catch (Exception $e) {
        echo "Erro ao atualizar cliente: " . $e->getMessage();
    }
    // Atualizar no banco de dados


}
?>

<div class="container mt-5">
    <h2>Atualização de Cliente</h2>
    <form id="formCadastro" action="index.php?p=aluno&c=atualizar&id=<?= $cliente->idCliente ?>" method="POST" enctype="multipart/form-data">
        <div class="row">

            <div class="col-9">
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="nomeCliente" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nomeCliente" name="nomeCliente" value="<?= htmlspecialchars($cliente->nomeCliente, ENT_QUOTES, 'UTF-8') ?>" placeholder="Nome Cliente" required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="cpfCliente" class="form-label">CPF</label>
                            <input type="text" class="form-control" id="cpfCliente" name="cpfCliente" value="<?= htmlspecialchars($cliente->cpfCliente, ENT_QUOTES, 'UTF-8') ?>" placeholder="CPF Cliente" required>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="mb-2">
                            <label for="statusCliente" class="form-label">Status</label>
                            <select class="form-select" id="statusCliente" name="statusCliente" required>
                                <option value="ATIVO" <?= $cliente->statusCliente == 'ATIVO' ? 'selected' : '' ?>>ATIVO</option>
                                <option value="INATIVO" <?= $cliente->statusCliente == 'INATIVO' ? 'selected' : '' ?>>INATIVO</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="mb-3">
                            <label for="planoCliente" class="form-label">Plano</label>
                            <select class="form-select" id="planoCliente" name="planoCliente" required>
                                <option value="1" <?= $cliente->planoCliente == 1 ? 'selected' : '' ?>>BASICO MENSAL</option>
                                <option value="2" <?= $cliente->planoCliente == 2 ? 'selected' : '' ?>>BASICO TRIMESTRAL</option>
                                <option value="3" <?= $cliente->planoCliente == 3 ? 'selected' : '' ?>>BASICO SEMESTRAL</option>
                                <option value="4" <?= $cliente->planoCliente == 4 ? 'selected' : '' ?>>PADRAO MENSAL</option>
                                <option value="5" <?= $cliente->planoCliente == 5 ? 'selected' : '' ?>>PADRAO TRIMESTRAL</option>
                                <option value="6" <?= $cliente->planoCliente == 6 ? 'selected' : '' ?>>PADRAO SEMESTRAL</option>
                                <option value="7" <?= $cliente->planoCliente == 7 ? 'selected' : '' ?>>PREMIUM MENSAL</option>
                                <option value="8" <?= $cliente->planoCliente == 8 ? 'selected' : '' ?>>PREMIUM TRIMESTRAL</option>
                                <option value="9" <?= $cliente->planoCliente == 9 ? 'selected' : '' ?>>PREMIUM SEMESTRAL</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="mb-3">
                            <label for="metodoPagamento" class="form-label">Pagamento</label>
                            <select class="form-select" id="metodoPagamento" name="metodoPagamento" required>
                                <option value="1" <?= $cliente->metodoPagamento == 1 ? 'selected' : '' ?>>CREDITO</option>
                                <option value="2" <?= $cliente->metodoPagamento == 2 ? 'selected' : '' ?>>DEBITO</option>
                                <option value="3" <?= $cliente->metodoPagamento == 3 ? 'selected' : '' ?>>PIX</option>
                                <option value="4" <?= $cliente->metodoPagamento == 4 ? 'selected' : '' ?>>BOLETO</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="mb-3">
                            <label for="dataNascCliente" class="form-label">Data de Nascimento</label>
                            <input type="date" class="form-control" id="dataNascCliente" name="dataNascCliente" value="<?= htmlspecialchars($cliente->dataNascCliente, ENT_QUOTES, 'UTF-8') ?>" required>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="mb-3">
                            <label for="treinoCliente" class="form-label">Treino</label>
                            <select class="form-select" id="treinoCliente" name="treinoCliente" required>
                                <option value="1" <?= $cliente->treinoCliente == 1 ? 'selected' : '' ?>>LIVRE</option>
                                <option value="2" <?= $cliente->treinoCliente == 2 ? 'selected' : '' ?>>RESISTENCIA</option>
                                <option value="3" <?= $cliente->treinoCliente == 3 ? 'selected' : '' ?>>FORÇA GERAL</option>
                                <option value="4" <?= $cliente->treinoCliente == 4 ? 'selected' : '' ?>>FORÇA MUSCULAR</option>
                                <option value="5" <?= $cliente->treinoCliente == 5 ? 'selected' : '' ?>>INTENSIVO</option>
                                <option value="6" <?= $cliente->treinoCliente == 6 ? 'selected' : '' ?>>FLEXIBILIDADE</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="telefoneCliente" class="form-label">Telefone</label>
                            <input type="text" class="form-control" id="telefoneCliente" name="telefoneCliente" value="<?= htmlspecialchars($cliente->telefoneCliente, ENT_QUOTES, 'UTF-8') ?>" placeholder="(xx) xxxxx-xxxx" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="emailCliente" class="form-label">E-mail Cliente</label>
                            <input type="email" class="form-control" id="emailCliente" name="emailCliente" value="<?= htmlspecialchars($cliente->emailCliente, ENT_QUOTES, 'UTF-8') ?>" placeholder="E-mail Cliente" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="senhaCliente" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senhaCliente" name="senhaCliente" placeholder="Senha Cliente" required>
                    </div>
                    <div class="col-6">
                        <label for="confirmaSenhaCliente" class="form-label">Confirme Senha</label>
                        <input type="password" class="form-control" id="confirmaSenhaCliente" name="confirmaSenhaCliente" placeholder="Confirme Senha Cliente" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                        <a href="index.php?p=aluno" class="btn btn-secondary">Voltar</a>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <img src="img/cliente/<?= htmlspecialchars($cliente->fotoCliente, ENT_QUOTES, 'UTF-8') ?>" class="img-fluid" alt="foto do cliente" id="img">
                <input type="file" class="form-control" id="foto" name="foto" style="display: none;">
            </div>
        </div>
    </form>
</div>