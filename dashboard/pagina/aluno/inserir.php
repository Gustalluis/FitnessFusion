<?php
require_once(__DIR__ . '/../../class/ClassCliente.php');

// 🔒 VALIDAÇÃO DE UPLOAD BLINDADA
function validarUpload($arquivo) {
    $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $maxSize = 5 * 1024 * 1024; // 5MB
    
    if ($arquivo['error'] != UPLOAD_ERR_OK) {
        throw new Exception('Erro no upload: ' . $arquivo['error']);
    }
    
    if ($arquivo['size'] > $maxSize) {
        throw new Exception('Arquivo muito grande. Máximo: 5MB');
    }
    
    $extensao = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
    if (!in_array($extensao, $extensoesPermitidas)) {
        throw new Exception('Tipo de arquivo não permitido: ' . $extensao);
    }
    
    // Verificar se é realmente uma imagem
    $info = getimagesize($arquivo['tmp_name']);
    if ($info === false) {
        throw new Exception('Arquivo não é uma imagem válida.');
    }
    
    return true;
}

if (isset($_POST['nomeCliente'])) {
    $cliente = new ClassCliente();

    // Atribuir valores do formulário ao objeto cliente
    $cliente->nomeCliente = $_POST['nomeCliente'];
    $cliente->cpfCliente = $_POST['cpfCliente'];
    $cliente->telefoneCliente = $_POST['telefoneCliente'];
    $cliente->dataNascCliente = $_POST['dataNascCliente'];
    $cliente->emailCliente = $_POST['emailCliente'];
    $cliente->senhaCliente = $_POST['senhaCliente'];
    $cliente->statusCliente = $_POST['statusCliente'];
    $cliente->planoCliente = $_POST['planoCliente'];
    $cliente->treinoCliente = $_POST['treinoCliente'];
    $cliente->metodoPagamento = $_POST['metodoPagamento'];

    // 🔒 VALIDAÇÃO DE UPLOAD
    $arquivo = $_FILES['foto'];
    validarUpload($arquivo);

    // Recuperar o ID
    $conexao = Database::conectar();
    $sql = $conexao->query('select idCliente from cliente order by idCliente desc limit 1');
    $resultado = $sql->fetch(PDO::FETCH_ASSOC);

    $novoId = ($resultado !== false && isset($resultado['idCliente'])) ? $resultado['idCliente'] + 1 : 1;

    // Formatar o nome do arquivo da foto
    $nomeCliFoto = str_replace(' ', '', $_POST['nomeCliente']);
    $nomeCliFoto = iconv('UTF-8', 'ASCII//TRANSLIT', $nomeCliFoto);
    $nomeCliFoto = strtolower($nomeCliFoto);
    $novoNome = $novoId . '_' . $nomeCliFoto . '.jpeg';

    // Mover a imagem para o diretório
    $uploadDir = __DIR__ . '/../../img/cliente/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    if (move_uploaded_file($arquivo['tmp_name'], $uploadDir . $novoNome)) {
        $cliente->fotoCliente = $novoNome;
    } else {
        throw new Exception('Não foi possível fazer o upload!');
    }

    $cliente->altCliente = 'foto ' . strtolower($cliente->nomeCliente);

    try {
        $cliente->Inserir();
        echo "<script>document.location='index.php?p=dashboard'</script>";
    } catch (Exception $e) {
        echo "Erro ao cadastrar cliente: " . htmlspecialchars($e->getMessage());
        exit;
    }
}
?>

<div class="container mt-5">

    <h2>Cadastro de Cliente</h2>
    <form id="formCadastro" action="index.php?p=aluno&c=inserir" method="POST" enctype="multipart/form-data">
        <div class="row">

            <div class="col-9">
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="nomeCliente" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nomeCliente" name="nomeCliente" placeholder="Nome Cliente" required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="cpfCliente" class="form-label">CPF</label>
                            <input type="text" class="form-control" id="cpfCliente" name="cpfCliente" placeholder="CPF Cliente" required>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="mb-2">
                            <label for="statusCliente" class="form-label">Status</label>
                            <select class="form-select" id="statusCliente" name="statusCliente" required>
                                <option value="ATIVO">ATIVO</option>
                                <option value="INATIVO">INATIVO</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="mb-3">
                            <label for="planoCliente" class="form-label">Plano</label>
                            <select class="form-select" id="planoCliente" name="planoCliente" required>
                                <option value="1">BASICO MENSAL</option>
                                <option value="2">BASICO TRIMESTRAL</option>
                                <option value="3">BASICO SEMESTRAL</option>
                                <option value="4">PADRAO MENSAL</option>
                                <option value="5">PADRAO TRIMESTRAL</option>
                                <option value="6">PADRAO SEMESTRAL</option>
                                <option value="7">PREMIUM MENSAL</option>
                                <option value="8">PREMIUM TRIMESTRAL</option>
                                <option value="9">PREMIUM SEMESTRAL</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="mb-3">
                            <label for="metodoPagamento" class="form-label">Metodo Pagamento</label>
                            <select class="form-select" id="metodoPagamento" name="metodoPagamento" required>
                                <option value="1">CREDITO</option>
                                <option value="2">DEBITO</option>
                                <option value="3">PIX</option>
                                <option value="4">BOLETO</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="mb-3">
                            <label for="dataNascCliente" class="form-label">Data de Nascimento</label>
                            <input type="date" class="form-control" id="dataNascCliente" name="dataNascCliente" required>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="mb-3">
                            <label for="treinoCliente" class="form-label">Treino</label>
                            <select class="form-select" id="treinoCliente" name="treinoCliente" required>
                                <option value="1">LIVRE</option>
                                <option value="2">RESISTENCIA</option>
                                <option value="3">FORÇA GERAL</option>
                                <option value="4">FORÇA MUSCULAR</option>
                                <option value="5">INTENSIVO</option>
                                <option value="6">FLEXIBILIDADE</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="telefoneCliente" class="form-label">Telefone</label>
                            <input type="text" class="form-control" id="telefoneCliente" name="telefoneCliente" placeholder="(xx) xxxxx-xxxx" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="emailCliente" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="emailCliente" name="emailCliente" placeholder="E-mail Cliente" required>
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
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                        <a href="index.php?p=aluno" class="btn btn-secondary">Voltar</a>

                    </div>
                </div>
            </div>
            <div class="col-3">
                <img src="img/cliente/semfoto.jpeg" class="img-fluid" alt="foto do cliente" id="img">
                <input type="file" class="form-control" id="foto" name="foto" style="display: none;">
            </div>
        </div>
    </form>
</div>
<script src="../../js/animaDash.js"></script>