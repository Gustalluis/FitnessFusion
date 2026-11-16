<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        // Busca todos os clientes cadastrados usando o Model
        $clientes = Cliente::all();

        // Retorna os dados em formato JSON (ótimo para testar APIs e backend)
        return response()->json([
            'sucesso' => true,
            'dados' => $clientes
        ]);
    }
}