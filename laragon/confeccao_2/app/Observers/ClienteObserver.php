<?php

namespace App\Observers;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ClienteObserver
{
    public function created(Cliente $cliente): void
    {
        $this->criarUsuario($cliente);
    }

    public function updated(Cliente $cliente): void
    {
        if ($cliente->user_id || ! $cliente->email) {
            return;
        }

        $this->criarUsuario($cliente);
    }

    private function criarUsuario(Cliente $cliente): void
    {
        if (! $cliente->email) {
            return;
        }

        if (User::where('email', $cliente->email)->exists()) {
            return;
        }

        $senha = $cliente->getAttribute('password_input') ?? Str::random(12);

        $user = User::create([
            'name'     => $cliente->nome,
            'email'    => $cliente->email,
            'password' => Hash::make($senha),
            'role'     => 'cliente',
        ]);

        $cliente->forceFill(['user_id' => $user->id])->saveQuietly();
    }
}
