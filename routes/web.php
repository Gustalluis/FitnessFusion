<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PlanoController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\InscricaoController;

Route::get('/clientes', [ClienteController::class, 'index']);
Route::get('/planos', [PlanoController::class, 'index']);
Route::get('/funcionarios', [FuncionarioController::class, 'index']);
Route::get('/inscricoes', [InscricaoController::class, 'index']);