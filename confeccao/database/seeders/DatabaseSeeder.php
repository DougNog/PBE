<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Clientes;
use App\Models\Fornecedor;
use App\Models\Estoque;
use App\Models\Pedido;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // CLIENTES
        Clientes::factory(15)->create();

        Clientes::factory()->create([
            'nome' => 'Douglas',
            'cpf' => '123.456.789-00',
            'telefone' => '(19) 99999-9999',
            'reserva' => 1,
        ]);

        // FORNECEDORES
        Fornecedor::factory(10)->create();

        // ESTOQUE
        Estoque::factory(30)->create();

        // PEDIDOS
        Pedido::factory(20)->create();

        // ADMIN
        User::factory()->create([
            'name' => 'Confecção Douglas',
            'email' => 'admin@confeccao.com',
            'password' => bcrypt('123456'),
        ]);
    }
}