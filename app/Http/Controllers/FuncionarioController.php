<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;

class FuncionarioController extends Controller
{
    public function index()
    {
        return response()->json([
            'sucesso' => true,
            'dados' => Funcionario::all(),
        ]);
    }
}
