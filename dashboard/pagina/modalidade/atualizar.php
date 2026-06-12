<?php
require_once(__DIR__ . '/../../class/ClassModalidade.php');

$id = (int) ($_GET['id'] ?? 0);
if ($id <= 0) {
    echo "<script>window.location.href='index.php?p=modalidade'</script>";
    exit;
}

$modalidade = new ClassModalidade($id);

if (isset($_POST['nomeModalidade'])) {
    try {
        $nomeModalidade = $_POST['nomeModalidade'];
        $conteudoModalidade = $_POST['conteudoModalidade'];
        $statusModalidade = $_POST['statusModalidade'];
        $altModalidade = 'foto de ' . strtolower($nomeModalidade);

        if ($statusModalidade === 'SITE' && $modalidade->statusModalidade !== 'SITE') {
            if (ClassModalidade::contarStatusSite() >= ClassModalidade::MAX_DESTAQUE_SITE) {
                throw new Exception('Não é permitido destacar mais de 3 modalidades com status SITE.');
            }
        }

        if (!empty($_FILES['foto']['name'])) {
            $arquivo = $_FILES['foto'];

            if ($arquivo['error'] != UPLOAD_ERR_OK) {
                throw new Exception('Erro no upload do arquivo: ' . $arquivo['error']);
            }

            $novoNome = $modalidade->idModalidade . '_' . ClassModalidade::normalizarNomeArquivo($nomeModalidade) . '.jpeg';
            $uploadDir = ClassModalidade::UPLOAD_DIR;

            $nomeFotoLimpo = basename($modalidade->fotoModalidade);
            $fotoAntiga = $uploadDir . $nomeFotoLimpo;
            if (!empty($nomeFotoLimpo) && file_exists($fotoAntiga)) {
                unlink($fotoAntiga);
            }

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            if (!move_uploaded_file($arquivo['tmp_name'], $uploadDir . $novoNome)) {
                throw new Exception('Não foi possível realizar o upload da imagem.');
            }

            $fotoModalidade = $novoNome;
        } else {
            $fotoModalidade = basename($modalidade->fotoModalidade);
        }

        $modalidade->nomeModalidade = $nomeModalidade;
        $modalidade->fotoModalidade = $fotoModalidade;
        $modalidade->statusModalidade = $statusModalidade;
        $modalidade->conteudoModalidade = $conteudoModalidade;
        $modalidade->altModalidade = $altModalidade;
        $modalidade->Atualizar();
        exit;
    } catch (Exception $e) {
        $erroAtualizacao = $e->getMessage();
    }
}
?>

<div class="container mt-5">
    <h2>Atualizar Modalidade</h2>
    <?php if (!empty($erroAtualizacao)) : ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($erroAtualizacao, ENT_QUOTES, 'UTF-8'); ?></div>
    <?php endif; ?>
    <form action="index.php?p=modalidade&m=atualizar&id=<?php echo (int) $modalidade->idModalidade; ?>" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-9">
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="nomeModalidade" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nomeModalidade" name="nomeModalidade" placeholder="Nome Modalidade" required value="<?php echo htmlspecialchars($modalidade->nomeModalidade, ENT_QUOTES, 'UTF-8'); ?>">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="statusModalidade" class="form-label">Status</label>
                            <select class="form-select" id="statusModalidade" name="statusModalidade" required>
                                <option value="ATIVO" <?php echo ($modalidade->statusModalidade == 'ATIVO') ? 'selected' : ''; ?>>ATIVO — visível na página Modalidades</option>
                                <option value="SITE" <?php echo ($modalidade->statusModalidade == 'SITE') ? 'selected' : ''; ?>>SITE — destaque na Home (máx. 3)</option>
                                <option value="INATIVO" <?php echo ($modalidade->statusModalidade == 'INATIVO') ? 'selected' : ''; ?>>INATIVO — oculto no site</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="conteudoModalidade" class="form-label">Conteúdo</label>
                            <textarea class="form-control" id="conteudoModalidade" name="conteudoModalidade" placeholder="Conteúdo Modalidade" rows="4" maxlength="150" required><?php echo htmlspecialchars($modalidade->conteudoModalidade, ENT_QUOTES, 'UTF-8'); ?></textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Atualizar</button>
                <a href="index.php?p=modalidade" class="btn btn-secondary">Voltar</a>
            </div>
            <div class="col-3">
                <img src="img/modalidade/<?php echo htmlspecialchars(basename($modalidade->fotoModalidade), ENT_QUOTES, 'UTF-8'); ?>" class="img-fluid" alt="foto da modalidade" id="img" style="cursor: pointer; border: 1px dashed #ccc; padding: 5px;">
                <input type="file" class="form-control" id="foto" name="foto" style="display: none;">
            </div>
        </div>
    </form>
</div>
