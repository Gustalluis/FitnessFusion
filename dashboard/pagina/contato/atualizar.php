<?php

require_once(__DIR__ . '/../../class/ClassContato.php');
$id = $_GET['id'];
$contato = new ClassContato($id);

if (isset($_POST['nomeContato'])) {
    $nomeContato = $_POST['nomeContato'];
    $emailContato = $_POST['emailContato'];
    $telefoneContato = $_POST['telefoneContato'];
    $mensagemContato = $_POST['mensagemContato'];
    $statusContato = $_POST['statusContato'];
    $dataContato = $_POST['dataContato'];
    $horaContato = $_POST['horaContato'];

   // Atualizar no banco de dados
   $contato->statusContato = $statusContato;
  

   $contato->Atualizar();
    
}

?>

<div class="container mt-5">
    <h2>Leitura Contatos</h2>
    <form action="index.php?p=contato&cont=atualizar&id=<?php echo $contato->idContato; ?>" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-4">
                <div class="mb-3">
                    <label for="nomeContato" class="form-label">Nome do Contato</label>
                    <input type="text" class="form-control" id="nomeContato" name="nomeContato" placeholder="Nome do Contato" required value="<?php echo $contato->nomeContato; ?>">
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="emailContato" class="form-label">Email do Contato</label>
                    <input type="email" class="form-control" id="emailContato" name="emailContato" placeholder="Email do Contato" required value="<?php echo $contato->emailContato; ?>">
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="telefoneContato" class="form-label">Telefone do Contato</label>
                    <input type="tel" class="form-control" id="telefoneContato" name="telefoneContato" placeholder="Telefone do Contato" required value="<?php echo $contato->telefoneContato; ?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <label for="mensagemContato" class="form-label">Mensagem</label>
                    <textarea class="form-control" id="mensagemContato" name="mensagemContato" rows="4" placeholder="Mensagem" required><?php echo $contato->mensagemContato; ?></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <div class="mb-3">
                    <label for="statusContato" class="form-label">Status</label>
                    <input type="text" class="form-control" id="statusContato" name="statusContato" required value="<?php echo $contato->statusContato; ?>">

                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="mb-3">
                    <label for="dataContato" class="form-label">Data do Contato</label>
                    <input type="date" class="form-control" id="dataContato" name="dataContato" required value="<?php echo $contato->dataContato; ?>">
                </div>
            </div>
            <div class="col-2">
                <div class="mb-3">
                    <label for="horaContato" class="form-label">Hora do Contato</label>
                    <input type="time" class="form-control" id="horaContato" name="horaContato" required value="<?php echo $contato->horaContato; ?>">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="index.php?p=contato" class="btn btn-secondary">Voltar</a>
    </form>
</div>