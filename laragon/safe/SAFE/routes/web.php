<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\AutorizacaoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MovimentacaoController;
use App\Http\Controllers\PortariaController;
use App\Http\Controllers\ResponsavelController;
use App\Http\Controllers\UserController;
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
        Route::get('/',              [PortariaController::class, 'index'])->name('index');
        Route::get('/buscar/json',   [PortariaController::class, 'buscarJson'])->name('buscar.json');
        Route::get('/{aluno}',       [PortariaController::class, 'confirmar'])->name('confirmar');
        Route::post('/{aluno}/confirmar', [PortariaController::class, 'registrar'])->name('registrar');
        Route::post('/{aluno}/recusar',   [PortariaController::class, 'recusar'])->name('recusar');
    });

    // Movimentações (todos os autenticados)
    Route::get('/movimentacoes', [MovimentacaoController::class, 'index'])->name('movimentacoes.index');

    // Notificações
    Route::post('/notificacoes/{id}/lida', function (string $id) {
        auth()->user()->notifications()->findOrFail($id)->markAsRead();
        return back();
    })->name('notificacoes.marcar-lida');
    Route::post('/notificacoes/marcar-todas', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    })->name('notificacoes.marcar-todas');

    // Autorizações (professor e admin)
    Route::middleware('role:professor,admin')->prefix('autorizacoes')->name('autorizacoes.')->group(function () {
        Route::get('/',                         [AutorizacaoController::class, 'index'])->name('index');
        Route::get('/criar',                    [AutorizacaoController::class, 'create'])->name('create');
        Route::post('/',                        [AutorizacaoController::class, 'store'])->name('store');
        Route::get('/{autorizacao}/comprovante', [AutorizacaoController::class, 'comprovante'])->name('comprovante');
        Route::patch('/{autorizacao}/aprovar',  [AutorizacaoController::class, 'aprovar'])->name('aprovar');
        Route::patch('/{autorizacao}/revogar',  [AutorizacaoController::class, 'revogar'])->name('revogar');
        Route::delete('/{autorizacao}',         [AutorizacaoController::class, 'destroy'])->name('destroy');
    });

    // Alunos, Responsáveis e Professores (admin)
    Route::middleware('role:admin')->group(function () {
        Route::resource('alunos', AlunoController::class)->except(['show']);
        Route::resource('responsaveis', ResponsavelController::class)->except(['show']);
        Route::resource('usuarios', UserController::class)->except(['show']);
    });
});
