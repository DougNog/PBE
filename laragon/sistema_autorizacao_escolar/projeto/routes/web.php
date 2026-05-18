<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\AutorizacaoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MovimentacaoController;
use App\Http\Controllers\PortariaController;
use App\Http\Controllers\ResponsavelController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect('/login'));

// Autenticação
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Área autenticada
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Portaria (porteiro e admin)
    Route::middleware('role:porteiro,admin')->prefix('portaria')->name('portaria.')->group(function () {
        Route::get('/',                [PortariaController::class, 'index'])->name('index');
        Route::get('/buscar/json',     [PortariaController::class, 'buscarJson'])->name('buscar.json');
        Route::get('/{aluno}/{tipo}',  [PortariaController::class, 'confirmar'])->name('confirmar');
        Route::post('/{aluno}',        [PortariaController::class, 'registrar'])->name('registrar');
    });

    // Movimentações (todos os autenticados)
    Route::get('/movimentacoes', [MovimentacaoController::class, 'index'])->name('movimentacoes.index');

    // Autorizações (professor e admin)
    Route::middleware('role:professor,admin')->prefix('autorizacoes')->name('autorizacoes.')->group(function () {
        Route::get('/',                         [AutorizacaoController::class, 'index'])->name('index');
        Route::get('/criar',                    [AutorizacaoController::class, 'create'])->name('create');
        Route::post('/',                        [AutorizacaoController::class, 'store'])->name('store');
        Route::patch('/{autorizacao}/aprovar',  [AutorizacaoController::class, 'aprovar'])->name('aprovar');
        Route::patch('/{autorizacao}/revogar',  [AutorizacaoController::class, 'revogar'])->name('revogar');
        Route::delete('/{autorizacao}',         [AutorizacaoController::class, 'destroy'])->name('destroy');
    });

    // Alunos (admin)
    Route::middleware('role:admin')->group(function () {
        Route::resource('alunos', AlunoController::class)->except(['show']);
        Route::resource('responsaveis', ResponsavelController::class)->except(['show']);
    });
});
