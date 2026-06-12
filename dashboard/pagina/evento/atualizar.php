<?php

require_once(__DIR__ . '/../../class/ClassEvento.php');
$id = $_GET['id'];
$evento = new ClassEvento($id);

if (isset($_POST['nomeEvento'])) {
    $nomeEvento = $_POST['nomeEvento'];
    $dataEvento = $_POST['dataEvento'];
    $statusEvento = $_POST['statusEvento'];



    // Atualizar no banco de dados
    $evento->nomeEvento = $nomeEvento;
    $evento->dataEvento = $dataEvento;
    $evento->statusEvento = $statusEvento;

    $evento->Atualizar();
}

?>

<div class="container mt-5">
    <h2>Cadastro de Evento</h2>
    <form action="index.php?p=evento&e=atualizar&id=<?php echo $evento->idEvento; ?>" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-4">
                <div class="mb-3">
                    <label for="nomeEvento" class="form-label">Título</label>
                    <input type="text" class="form-control" id="nomeEvento" name="nomeEvento" placeholder="Título do Evento" required value="<?php echo $evento->nomeEvento; ?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <div class="mb-3">
                    <label for="dataEvento" class="form-label">Data</label>
                    <input type="date" class="form-control" id="dataEvento" name="dataEvento" required value="<?php echo $evento->dataEvento; ?>">
                </div>
            </div>
            <div class="col-2">
                <div class="mb-3">
                    <label for="statusEvento" class="form-label">Status</label>
                    <select class="form-select" id="statusEvento" name="statusEvento" placeholder="StatusEvestatusEvento " required value="<?php echo $evento->statusEvento; ?>">
                        <option value="ATIVO" <?php if ($evento->statusEvento == 'ATIVO') echo 'selected'; ?>>ATIVO</option>
                        <option value="INATIVO" <?php if ($evento->statusEvento == 'INATIVO') echo 'selected'; ?>>INATIVO</option>
                    </select>
                </div>
            </div>
        </div>
        <button  type="submit" class="btn btn-primary">Atualizar</button>
        <a href="index.php?p=evento" class="btn btn-secondary">Voltar</a>
    </form>
</div>