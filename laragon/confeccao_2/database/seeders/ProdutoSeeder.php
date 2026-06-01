<?php

namespace Database\Seeders;

use App\Models\Produto;
use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    public function run(): void
    {
        // estoque reflete o saldo líquido das movimentações seedadas
        $produtos = [
            ['nome' => 'Camiseta Básica',        'referencia' => 'CB-001',  'preco_venda' => 39.90, 'estoque' => 50], // 60 entrada − 10 venda
            ['nome' => 'Calça Jeans Feminina',    'referencia' => 'CJ-001',  'preco_venda' => 89.90, 'estoque' => 42], // 40 entrada + 2 devolução
            ['nome' => 'Vestido Floral',          'referencia' => 'VF-001',  'preco_venda' => 69.90, 'estoque' => 35], // 30 entrada + 5 ajuste
            ['nome' => 'Blusa Social',            'referencia' => 'BS-001',  'preco_venda' => 55.00, 'estoque' => 45], // 50 entrada − 5 venda
            ['nome' => 'Short Feminino',          'referencia' => 'SF-001',  'preco_venda' => 45.00, 'estoque' => 45], // 45 entrada
            ['nome' => 'Camisa Social Masculina', 'referencia' => 'CSM-001', 'preco_venda' => 79.90, 'estoque' => 20], // 25 entrada − 5 venda
            ['nome' => 'Regata Feminina',         'referencia' => 'RF-001',  'preco_venda' => 29.90, 'estoque' => 60], // 70 entrada − 10 avaria
            ['nome' => 'Bermuda Jeans Masculina', 'referencia' => 'BJM-001', 'preco_venda' => 65.00, 'estoque' => 28], // 35 entrada − 7 venda
        ];

        foreach ($produtos as $produto) {
            Produto::create($produto);
        }
    }
}
