<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        $clientes = [
            ['nome' => 'Boutique da Moda',       'email' => 'boutique@modafashion.com.br', 'telefone' => '(11) 3344-5566', 'documento' => '12.345.678/0001-90'],
            ['nome' => 'Loja Veste Bem',          'email' => 'contato@vestebem.com.br',      'telefone' => '(21) 9988-7766', 'documento' => '98.765.432/0001-11'],
            ['nome' => 'Maria Fernanda Souza',    'email' => 'mariafernanda@gmail.com',       'telefone' => '(31) 99123-4567','documento' => '123.456.789-00'],
            ['nome' => 'Ateliê das Costuras',     'email' => 'atelie@costurasoficial.com.br', 'telefone' => '(41) 3232-1100', 'documento' => '55.667.788/0001-22'],
            ['nome' => 'Carlos Eduardo Ramos',    'email' => 'carloseduardo@hotmail.com',     'telefone' => '(51) 98765-4321','documento' => '987.654.321-00'],
            ['nome' => 'Multimarcas Flor & Arte', 'email' => 'compras@florartemoda.com.br',  'telefone' => '(62) 3456-7890', 'documento' => '33.221.100/0001-44'],
            ['nome' => 'Ana Paula Martins',       'email' => 'anapaula@outlook.com',          'telefone' => '(71) 91234-5678','documento' => '456.789.123-00'],
        ];

        foreach ($clientes as $dados) {
            Cliente::create($dados);
        }

        // define senha conhecida para todos os clientes de demo
        User::where('role', 'cliente')
            ->update(['password' => Hash::make('password')]);
    }
}
