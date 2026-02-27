<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Clientes;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        \App\Models\Clientes::factory(10)->create();
        Clientes::factory()->create([
            'nome' => 'Douglas',
            'cpf' => '123456789-00',
        ]);
        
        User::factory()->create([
            'name' => 'Confecção Douglas',
            'email' => 'test@confeccao.com',
        ]);
    }
}
