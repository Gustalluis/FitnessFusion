<?php
require_once(__DIR__ . '/../../class/ClassBanner.php');

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

if (isset($_POST['nomeBanner'])) {
    $nomeBanner = $_POST['nomeBanner'];
    $tipoBanner = $_POST['tipoBanner'];
    $statusBanner = 'ATIVO';
    $altBanner = "foto de " . $nomeBanner;

    // Recuperar o último ID
    $conexao = Database::conectar();
    $sql = $conexao->query('SELECT idBanner FROM banner ORDER BY idBanner DESC LIMIT 1');
    $resultado = $sql->fetch(PDO::FETCH_ASSOC);
    $novoId = ($resultado !== false && isset($resultado['idBanner'])) ? $resultado['idBanner'] + 1 : 1;

    // Tratar o campo FILES (foto)
    if (isset($_FILES['foto'])) {
        $arquivo = $_FILES['foto'];
        validarUpload($arquivo);
        
        $nomeBanFoto = str_replace(' ', '', $nomeBanner);
        $nomeBanFoto = iconv('UTF-8', 'ASCII//TRANSLIT', $nomeBanFoto);
        $nomeBanFoto = strtolower($nomeBanFoto);
        $novoNome = $novoId . '_' . $nomeBanFoto . '.jpeg';

        $uploadDir = __DIR__ . '/../../img/banner/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        if (move_uploaded_file($arquivo['tmp_name'], $uploadDir . $novoNome)) {
            $fotoBanner = $novoNome;
        } else {
            throw new Exception('Erro ao mover o arquivo.');
        }

        $banner = new ClassBanner();
        $banner->nomeBanner = $nomeBanner;
        $banner->fotoBanner = $fotoBanner;
        $banner->tipoBanner = $tipoBanner;
        $banner->statusBanner = $statusBanner;
        $banner->altBanner = $altBanner;

        try {
            $banner->Inserir();
            echo "<script>document.location='index.php?p=dashboard'</script>";
        } catch (Exception $e) {
            echo "Erro ao cadastrar banner: " . htmlspecialchars($e->getMessage());
            exit;
        }
    } else {
        throw new Exception('Arquivo não enviado.');
    }
}
?>
<div class="container mt-5">
    <h2>Cadastro de Banner</h2>
    <form action="index.php?p=banner&b=inserir" method="POST" enctype="multipart/form-data">
        <div class="row brow">
            <div class="col-3">
                <div class="row brow">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="nomeBanner" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nomeBanner" name="nomeBanner" placeholder="Nome Banner" required>
                        </div>
                    </div>
                </div>
                <div class="row brow">
                    <div class="col-3">
                        <div class="mb-3">
                            <label for="tipoBanner" class="form-label">Tipo</label>
                            <select class="form-select" id="tipoBanner" name="tipoBanner" required>
                                <option value="PRINCIPAL">PRINCIPAL</option>
                                <option value="SECUNDARIO">SECUNDARIO</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="mb-3">
                            <label for="statusBanner" class="form-label">Status</label>
                            <select class="form-select" id="statusBanner" name="statusBanner" required>
                                <option value="ATIVO">ATIVO</option>
                                <option value="INATIVO">INATIVO</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Cadastrar</button>
                <a href="index.php?p=banner" class="btn btn-secondary">Voltar</a>
            </div>
            <div class="col-9">
                <img src="img/banner/semfoto.jpeg" class="img-fluid bimg-fluid" alt="foto do banner" id="img">
                <input type="file" class="form-control" id="foto" name="foto" style="display: none;" required>
            </div>
        </div>
    </form>
</div>