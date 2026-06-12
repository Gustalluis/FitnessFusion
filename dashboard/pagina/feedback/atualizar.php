<?php

require_once(__DIR__ . '/../../class/ClassFeedback.php');
$id = $_GET['id'];
$feedback = new ClassFeedback($id);

if (isset($_POST['nomeCliente'])) {
    $nomeCliente = $_POST['nomeCliente'];
    $dataFeedback = $_POST['dataFeedback'];
    $tipoFeedback = $_POST['tipoFeedback'];
    $conteudoFeedback = $_POST['conteudoFeedback'];
    

   
    
}

?>

<div class="container mt-5">
    <h2>Leitura Feedback</h2>
    <form action="index.php?p=feedback&feed=atualizar&id=<?php echo $feedback->idFeedback; ?>" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-4">
                <div class="mb-3">
                    <label for="nomeCliente" class="form-label">Nome do Cliente</label>
                    <input type="text" class="form-control" id="nomeCliente" name="nomeCliente" placeholder="Nome do Cliente" required value="<?php echo $feedback->nomeCliente; ?>">
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="dataFeedback" class="form-label">Data do Feedback</label>
                    <input type="date" class="form-control" id="dataFeedback" name="dataFeedback" required value="<?php echo $feedback->dataFeedback; ?>">
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="tipoFeedback" class="form-label">Tipo de Feedback</label>
                    <input type="text" class="form-control" id="tipoFeedback" name="tipoFeedback" placeholder="Tipo de Feedback" required value="<?php echo $feedback->tipoFeedback; ?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <label for="conteudoFeedback" class="form-label">Conteúdo do Feedback</label>
                    <textarea class="form-control" id="conteudoFeedback" name="conteudoFeedback" rows="4" placeholder="Conteúdo do Feedback" required><?php echo $feedback->conteudoFeedback; ?></textarea>
                </div>
            </div>
        </div>
        <a href="index.php?p=feedback" class="btn btn-secondary">Voltar</a>
    </form>
</div>
