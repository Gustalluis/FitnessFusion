<?php

namespace App\Http\Controllers;

use App\Models\Inscricao;
use Illuminate\Http\Request;

class InscricaoController extends Controller
{
    public function index()
    {
        // Traz as inscrições junto com os dados do cliente e do plano relacionados
        $inscricoes = Inscricao::with(['cliente', 'plano'])->get();

        return response()->json([
            'sucesso' => true,
            'dados' => $inscricoes
        ]);
    }
}