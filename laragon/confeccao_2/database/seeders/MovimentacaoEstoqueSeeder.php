<?php

namespace Database\Seeders;

use App\Models\MovimentacaoEstoque;
use Illuminate\Database\Seeder;

class MovimentacaoEstoqueSeeder extends Seeder
{
    public function run(): void
    {
        $movimentacoes = [
            // Entradas iniciais de estoque
            ['produto_id' => 1, 'tipo' => 'entrada', 'quantidade' => 60, 'motivo' => 'Compra',          'data_movimentacao' => '2026-03-01 08:00:00', 'observacao' => 'Estoque inicial - Camiseta Básica'],
            ['produto_id' => 2, 'tipo' => 'entrada', 'quantidade' => 40, 'motivo' => 'Compra',          'data_movimentacao' => '2026-03-01 08:00:00', 'observacao' => 'Estoque inicial - Calça Jeans Feminina'],
            ['produto_id' => 3, 'tipo' => 'entrada', 'quantidade' => 30, 'motivo' => 'Compra',          'data_movimentacao' => '2026-03-01 08:00:00', 'observacao' => 'Estoque inicial - Vestido Floral'],
            ['produto_id' => 4, 'tipo' => 'entrada', 'quantidade' => 50, 'motivo' => 'Compra',          'data_movimentacao' => '2026-03-01 08:00:00', 'observacao' => 'Estoque inicial - Blusa Social'],
            ['produto_id' => 5, 'tipo' => 'entrada', 'quantidade' => 45, 'motivo' => 'Compra',          'data_movimentacao' => '2026-03-01 08:00:00', 'observacao' => 'Estoque inicial - Short Feminino'],
            ['produto_id' => 6, 'tipo' => 'entrada', 'quantidade' => 25, 'motivo' => 'Compra',          'data_movimentacao' => '2026-03-01 08:00:00', 'observacao' => 'Estoque inicial - Camisa Social Masculina'],
            ['produto_id' => 7, 'tipo' => 'entrada', 'quantidade' => 70, 'motivo' => 'Compra',          'data_movimentacao' => '2026-03-01 08:00:00', 'observacao' => 'Estoque inicial - Regata Feminina'],
            ['produto_id' => 8, 'tipo' => 'entrada', 'quantidade' => 35, 'motivo' => 'Compra',          'data_movimentacao' => '2026-03-01 08:00:00', 'observacao' => 'Estoque inicial - Bermuda Jeans Masculina'],

            // Saídas por pedidos finalizados
            ['produto_id' => 1, 'tipo' => 'saida',   'quantidade' => 10, 'motivo' => 'Venda',           'data_movimentacao' => '2026-04-10 10:00:00', 'observacao' => 'Pedido #1 - Boutique da Moda'],
            ['produto_id' => 4, 'tipo' => 'saida',   'quantidade' =>  5, 'motivo' => 'Venda',           'data_movimentacao' => '2026-04-10 10:00:00', 'observacao' => 'Pedido #1 - Boutique da Moda'],
            ['produto_id' => 6, 'tipo' => 'saida',   'quantidade' =>  5, 'motivo' => 'Venda',           'data_movimentacao' => '2026-05-12 17:00:00', 'observacao' => 'Pedido #4 - Ateliê das Costuras'],
            ['produto_id' => 8, 'tipo' => 'saida',   'quantidade' =>  7, 'motivo' => 'Venda',           'data_movimentacao' => '2026-05-12 17:00:00', 'observacao' => 'Pedido #4 - Ateliê das Costuras'],

            // Ajuste de inventário
            ['produto_id' => 3, 'tipo' => 'entrada', 'quantidade' =>  5, 'motivo' => 'Ajuste',          'data_movimentacao' => '2026-05-01 09:00:00', 'observacao' => 'Acerto de inventário mensal'],
            ['produto_id' => 7, 'tipo' => 'saida',   'quantidade' => 10, 'motivo' => 'Ajuste',          'data_movimentacao' => '2026-05-01 09:00:00', 'observacao' => 'Avaria identificada no inventário'],

            // Devolução
            ['produto_id' => 2, 'tipo' => 'entrada', 'quantidade' =>  2, 'motivo' => 'Devolução',       'data_movimentacao' => '2026-05-20 14:00:00', 'observacao' => 'Devolução cliente - defeito de costura'],
        ];

        foreach ($movimentacoes as $mov) {
            MovimentacaoEstoque::create($mov);
        }
    }
}
