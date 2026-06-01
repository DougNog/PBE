<?php

namespace Database\Seeders;

use App\Models\ItemPedido;
use App\Models\Pedido;
use Illuminate\Database\Seeder;

class PedidoSeeder extends Seeder
{
    public function run(): void
    {
        $pedidos = [
            [
                'cliente_id'  => 1,
                'status'      => 'finalizado',
                'data_pedido' => '2026-04-10 09:00:00',
                'itens' => [
                    ['produto_id' => 1, 'quantidade' => 10, 'preco_unitario' => 39.90],
                    ['produto_id' => 4, 'quantidade' =>  5, 'preco_unitario' => 55.00],
                ],
            ],
            [
                'cliente_id'  => 2,
                'status'      => 'em_producao',
                'data_pedido' => '2026-04-22 14:30:00',
                'itens' => [
                    ['produto_id' => 2, 'quantidade' =>  8, 'preco_unitario' => 89.90],
                    ['produto_id' => 3, 'quantidade' =>  6, 'preco_unitario' => 69.90],
                ],
            ],
            [
                'cliente_id'  => 3,
                'status'      => 'pendente',
                'data_pedido' => '2026-05-05 10:15:00',
                'itens' => [
                    ['produto_id' => 5, 'quantidade' =>  4, 'preco_unitario' => 45.00],
                    ['produto_id' => 7, 'quantidade' =>  3, 'preco_unitario' => 29.90],
                ],
            ],
            [
                'cliente_id'  => 4,
                'status'      => 'finalizado',
                'data_pedido' => '2026-05-12 16:00:00',
                'itens' => [
                    ['produto_id' => 6, 'quantidade' =>  5, 'preco_unitario' => 79.90],
                    ['produto_id' => 8, 'quantidade' =>  7, 'preco_unitario' => 65.00],
                ],
            ],
            [
                'cliente_id'  => 5,
                'status'      => 'cancelado',
                'data_pedido' => '2026-05-18 11:00:00',
                'itens' => [
                    ['produto_id' => 1, 'quantidade' =>  2, 'preco_unitario' => 39.90],
                ],
            ],
            [
                'cliente_id'  => 6,
                'status'      => 'em_producao',
                'data_pedido' => '2026-05-25 09:45:00',
                'itens' => [
                    ['produto_id' => 3, 'quantidade' =>  4, 'preco_unitario' => 69.90],
                    ['produto_id' => 4, 'quantidade' =>  6, 'preco_unitario' => 55.00],
                    ['produto_id' => 7, 'quantidade' =>  5, 'preco_unitario' => 29.90],
                ],
            ],
        ];

        foreach ($pedidos as $dado) {
            $itens = $dado['itens'];

            $valorTotal = round(
                collect($itens)->sum(fn ($i) => $i['quantidade'] * $i['preco_unitario']),
                2
            );

            $pedido = Pedido::create([
                'cliente_id'  => $dado['cliente_id'],
                'status'      => $dado['status'],
                'data_pedido' => $dado['data_pedido'],
                'valor_total' => $valorTotal,
            ]);

            foreach ($itens as $item) {
                ItemPedido::create([
                    'pedido_id'      => $pedido->id,
                    'produto_id'     => $item['produto_id'],
                    'quantidade'     => $item['quantidade'],
                    'preco_unitario' => $item['preco_unitario'],
                ]);
            }
        }
    }
}
