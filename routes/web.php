<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Aparelho;
use App\Models\Manutencao;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AparelhoController;
use App\Http\Controllers\ManutencaoController;


Route::get('/', function () {
    $totalFuncionarios = User::count();
    $totalAparelhos = Aparelho::count();
    $totalManutencoes = Manutencao::count();
    
    $manutencoesPendentes = Manutencao::where('status', 'Pendente')->count();
    $manutencoesEmAnalise = Manutencao::where('status', 'Em Análise')->count();
    $manutencoesConcluidas = Manutencao::where('status', 'Concluído')->count();
    
    
    $recentesManutencoes = Manutencao::with(['aparelho', 'tecnico'])->latest()->take(5)->get();

    return view('dashboard', compact(
        'totalFuncionarios',
        'totalAparelhos',
        'totalManutencoes',
        'manutencoesPendentes',
        'manutencoesEmAnalise',
        'manutencoesConcluidas',
        'recentesManutencoes'
    ));
})->name('dashboard');


Route::resource('usuarios', UserController::class);
Route::resource('aparelhos', AparelhoController::class);
Route::resource('manutencoes', ManutencaoController::class);


