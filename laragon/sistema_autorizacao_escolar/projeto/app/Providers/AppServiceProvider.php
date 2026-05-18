<?php

namespace App\Providers;

use App\Events\AlunoMovimentado;
use App\Listeners\NotificarResponsavelListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Event::listen(
            AlunoMovimentado::class,
            NotificarResponsavelListener::class,
        );
    }
}
