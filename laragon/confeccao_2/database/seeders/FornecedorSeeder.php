<?php

namespace Database\Seeders;

use App\Models\Fornecedor;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FornecedorSeeder extends Seeder
{
    public function run(): void
    {
        $fornecedores = [
            ['nome' => 'Roberto Alves',   'email' => 'roberto@textildonorte.com.br', 'telefone' => '(11) 4002-8922', 'empresa' => 'Têxtil do Norte Ltda.'],
            ['nome' => 'Patrícia Lima',   'email' => 'patricia@aviamentossp.com.br', 'telefone' => '(11) 3311-2244', 'empresa' => 'Aviamentos São Paulo'],
            ['nome' => 'Jorge Henrique',  'email' => 'jorge@fabricasfios.com.br',    'telefone' => '(35) 9876-5432', 'empresa' => 'Fábrica de Fios Sul'],
            ['nome' => 'Sandra Oliveira', 'email' => 'sandra@aviabrasil.com.br',     'telefone' => '(19) 3322-4455', 'empresa' => 'Avia Brasil Comércio'],
            ['nome' => 'Marcos Pereira',  'email' => 'marcos@tecidoscentro.com.br',  'telefone' => '(11) 2233-4455', 'empresa' => 'Tecidos Centro Oeste'],
        ];

        foreach ($fornecedores as $dados) {
            Fornecedor::create($dados);
        }

        // define senha conhecida para todos os fornecedores de demo
        User::where('role', 'fornecedor')
            ->update(['password' => Hash::make('password')]);
    }
}
