<?php
require_once(__DIR__ . '/../../class/ClassModalidade.php');

function validarUploadModalidade(array $arquivo): void
{
    $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $maxSize = 5 * 1024 * 1024;

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

    if (getimagesize($arquivo['tmp_name']) === false) {
        throw new Exception('Arquivo não é uma imagem válida.');
    }
}

if (isset($_POST['nomeModalidade'])) {
    try {
        $nomeModalidade = $_POST['nomeModalidade'];
        $statusModalidade = $_POST['statusModalidade'];
        $conteudoModalidade = $_POST['conteudoModalidade'];
        $altModalidade = 'foto de ' . $nomeModalidade;

        if ($statusModalidade === 'SITE' && ClassModalidade::contarStatusSite() >= ClassModalidade::MAX_DESTAQUE_SITE) {
            throw new Exception('Não é permitido cadastrar mais de 3 modalidades com status SITE.');
        }

        if (!isset($_FILES['foto'])) {
            throw new Exception('Arquivo não enviado.');
        }

        $arquivo = $_FILES['foto'];
        validarUploadModalidade($arquivo);

        $conn = Database::conectar();
        $sql = $conn->query('SELECT idModalidade FROM modalidade ORDER BY idModalidade DESC LIMIT 1');
        $resultado = $sql->fetch(PDO::FETCH_ASSOC);
        $novoId = ($resultado !== false && isset($resultado['idModalidade'])) ? $resultado['idModalidade'] + 1 : 1;

        $novoNome = $novoId . '_' . ClassModalidade::normalizarNomeArquivo($nomeModalidade) . '.jpeg';
        $uploadDir = ClassModalidade::UPLOAD_DIR;

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        if (!move_uploaded_file($arquivo['tmp_name'], $uploadDir . $novoNome)) {
            throw new Exception('Erro ao mover o arquivo.');
        }

        $modalidade = new ClassModalidade();
        $modalidade->nomeModalidade = $nomeModalidade;
        $modalidade->fotoModalidade = $novoNome;
        $modalidade->statusModalidade = $statusModalidade;
        $modalidade->altModalidade = $altModalidade;
        $modalidade->conteudoModalidade = $conteudoModalidade;
        $modalidade->Inserir();

        echo "<script>document.location='index.php?p=modalidade'</script>";
        exit;
    } catch (Exception $e) {
        $erroCadastro = $e->getMessage();
    }
}
?>

<div class="container mt-5">
    <h2>Cadastro de Modalidade</h2>
    <?php if (!empty($erroCadastro)) : ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($erroCadastro, ENT_QUOTES, 'UTF-8'); ?></div>
    <?php endif; ?>
    <form action="index.php?p=modalidade&m=inserir" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-9">
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="nomeModalidade" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nomeModalidade" name="nomeModalidade" placeholder="Nome Modalidade" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="statusModalidade" class="form-label">Status</label>
                            <select class="form-select" id="statusModalidade" name="statusModalidade" required>
                                <option value="ATIVO">ATIVO — visível na página Modalidades</option>
                                <option value="SITE">SITE — destaque na Home (máx. 3)</option>
                                <option value="INATIVO">INATIVO — oculto no site</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="conteudoModalidade" class="form-label">Conteúdo</label>
                            <textarea class="form-control" id="conteudoModalidade" name="conteudoModalidade" placeholder="Conteúdo Modalidade" rows="4" maxlength="150" required></textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Cadastrar</button>
                <a href="index.php?p=modalidade" class="btn btn-secondary">Voltar</a>
            </div>
            <div class="col-3">
                <img src="img/modalidade/semfoto.jpeg" class="img-fluid" alt="foto da modalidade" id="img" style="cursor: pointer;">
                <input type="file" class="form-control" id="foto" name="foto" required style="display: none;">
            </div>
        </div>
    </form>
</div>
