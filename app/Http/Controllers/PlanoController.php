<?php

namespace App\Http\Controllers;

use App\Models\Plano;

class PlanoController extends Controller
{
    public function index()
    {
        return response()->json([
            'sucesso' => true,
            'dados' => Plano::all(),
        ]);
    }
}
