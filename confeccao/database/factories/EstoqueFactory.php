<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Estoque;

class EstoqueFactory extends Factory
{
    protected $model = Estoque::class;

    public function definition(): array
    {
        return [
            'nome' => fake()->randomElement([
                'Tecido Algodão',
                'Tecido Jeans',
                'Linha Branca',
                'Botão Preto',
                'Zíper 20cm',
                'Elástico 5mm'
            ]),
            'sku' => fake()->bothify('SKU-###??'),
            'unidade' => fake()->randomElement(['un','m','kg','cx']),
            'quantidade' => fake()->numberBetween(0, 200),
            'custo' => fake()->randomFloat(2, 5, 500),
        ];
    }
}