<?php

if (isset($_POST['nomeEvento'])) {
    $nomeEvento = $_POST['nomeEvento'];
    $dataEvento = $_POST['dataEvento'];
    $statusEvento = $_POST['statusEvento'];

    //echo "Recebendo dados: nomeEvento: $nomeEvento, dataEven$dataEvento: $dataEvento, dataEvento: $dataEvento, End: $end <br>";

    require_once(__DIR__ . '/../../class/Conexao.php');
    $conexao = Conexao::LigarConexao();

    // Verificar se a conexão foi bem-sucedida
    //if ($conexao) {
    // echo "Conexão com o banco de dados estabelecida.<br>";
    //} else {
    //die("Erro na conexão com o banco de dados.");
    // }

    // Habilitar modo de erro do PDO
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    require_once(__DIR__ . '/../../class/ClassEvento.php');

    $evento = new ClassEvento();

    $evento->nomeEvento = $nomeEvento;
    $evento->dataEvento = $dataEvento;
    $evento->statusEvento = $statusEvento;

    if ($evento->inserir()) {
        echo "<script>document.location='index.php?p=dashboard'</script>";
    } else {
        echo "Falha ao inserir evento.<br>";
    }
}

?>

<div class="container mt-5">
    <h2>Cadastro de Evento</h2>
    <form action="index.php?p=evento&e=inserir" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-4">
                <div class="mb-3">
                    <label for="nomeEvento" class="form-label">Título</label>
                    <input type="text" class="form-control" id="nomeEvento" name="nomeEvento" placeholder="Título do Evento" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <div class="mb-3">
                    <label for="dataEvento" class="form-label">Data do Evento</label>
                    <input type="date" class="form-control" id="dataEvento" name="dataEvento" required>
                </div>
            </div>
            <div class="col-2">
                <div class="mb-3">
                    <label for="statusEvento" class="form-label">Status</label>
                    <select class="form-select" id="statusEvento" name="statusEvento" placeholder="StatusEvento" required>
                        <option value="ATIVO">ATIVO</option>
                        <option value="INATIVO">INATIVO</option>
                    </select>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar</button>
        <a href="index.php?p=evento" class="btn btn-secondary">Voltar</a>

    </form>
</div>