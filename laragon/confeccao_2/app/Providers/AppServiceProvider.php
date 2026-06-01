<?php

namespace App\Providers;

use App\Models\Cliente;
use App\Models\Fornecedor;
use App\Observers\ClienteObserver;
use App\Observers\FornecedorObserver;
use Filament\Auth\Http\Responses\Contracts\LoginResponse;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(LoginResponse::class, \App\Http\Responses\LoginResponse::class);
    }

    public function boot(): void
    {
        Cliente::observe(ClienteObserver::class);
        Fornecedor::observe(FornecedorObserver::class);
    }
}
