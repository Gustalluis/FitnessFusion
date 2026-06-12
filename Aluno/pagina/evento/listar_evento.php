<?php

require_once(__DIR__ . '/../../class/Conexao.php');


// QUERY PARA RECUPERAR OS EVENTOS
$query_events = "SELECT id, title, color, start, end FROM events";

// PREPARAR A QUERY
$result_events = $conn->prepare($query_events);

// EXECUTAR A QUERY
$result_events->execute();

// CRIAR O ARRAY QUE RECEBE OS EVENTOS
$eventos =[];

// PERCORRER A LISTA DE REGISTROS RETORNADO DO BANCO DE DADOS
while($row_events = $result_events->fetch(PDO::FETCH_ASSOC)){
    
    // EXTRAIR O ARRAY
    extract($row_events);

    $eventos[] = [
        'id' => $id,
        'title' => $title,
        'color' => $color,
        'start' => $start,
        'end' => $end,
    ];
}

echo json_encode($eventos);