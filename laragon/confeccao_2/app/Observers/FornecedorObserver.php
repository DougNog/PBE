<?php

namespace App\Observers;

use App\Models\Fornecedor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FornecedorObserver
{
    public function created(Fornecedor $fornecedor): void
    {
        $this->criarUsuario($fornecedor);
    }

    public function updated(Fornecedor $fornecedor): void
    {
        if ($fornecedor->user_id || ! $fornecedor->email) {
            return;
        }

        $this->criarUsuario($fornecedor);
    }

    private function criarUsuario(Fornecedor $fornecedor): void
    {
        if (! $fornecedor->email) {
            return;
        }

        if (User::where('email', $fornecedor->email)->exists()) {
            return;
        }

        $nome = $fornecedor->empresa
            ? $fornecedor->nome . ' (' . $fornecedor->empresa . ')'
            : $fornecedor->nome;

        $senha = $fornecedor->getAttribute('password_input') ?? Str::random(12);

        $user = User::create([
            'name'     => $nome,
            'email'    => $fornecedor->email,
            'password' => Hash::make($senha),
            'role'     => 'fornecedor',
        ]);

        $fornecedor->forceFill(['user_id' => $user->id])->saveQuietly();
    }
}
