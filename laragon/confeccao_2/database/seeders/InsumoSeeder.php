<?php

namespace Database\Seeders;

use App\Models\Insumo;
use Illuminate\Database\Seeder;

class InsumoSeeder extends Seeder
{
    public function run(): void
    {
        $insumos = [
            ['nome' => 'Tecido Malha Algodão',  'unidade_medida' => 'kg',    'preco_unitario' => 18.00, 'estoque' => 50.00],
            ['nome' => 'Tecido Jeans',           'unidade_medida' => 'metro', 'preco_unitario' => 22.50, 'estoque' => 30.00],
            ['nome' => 'Tecido Viscolinho',      'unidade_medida' => 'metro', 'preco_unitario' => 15.00, 'estoque' => 25.00],
            ['nome' => 'Linha de Costura 40',    'unidade_medida' => 'rolo',  'preco_unitario' =>  3.50, 'estoque' => 100.00],
            ['nome' => 'Botão 4 Furos',          'unidade_medida' => 'unid',  'preco_unitario' =>  0.15, 'estoque' => 500.00],
            ['nome' => 'Zíper 20cm',             'unidade_medida' => 'unid',  'preco_unitario' =>  1.80, 'estoque' => 200.00],
            ['nome' => 'Elástico 2cm',           'unidade_medida' => 'metro', 'preco_unitario' =>  0.90, 'estoque' => 80.00],
            ['nome' => 'Entretela',              'unidade_medida' => 'metro', 'preco_unitario' =>  7.00, 'estoque' => 15.00],
            ['nome' => 'Etiqueta de Marca',      'unidade_medida' => 'unid',  'preco_unitario' =>  0.25, 'estoque' => 300.00],
            ['nome' => 'Fita de Viés',           'unidade_medida' => 'metro', 'preco_unitario' =>  0.60, 'estoque' => 60.00],
        ];

        foreach ($insumos as $insumo) {
            Insumo::create($insumo);
        }
    }
}
