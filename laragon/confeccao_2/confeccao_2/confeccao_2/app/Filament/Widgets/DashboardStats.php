<?php

namespace App\Filament\Widgets;

use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Produto;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Clientes', Cliente::count())
                ->description('Total de clientes')
                ->color('info'),

            Stat::make('Pedidos', Pedido::count())
                ->description('Total de pedidos')
                ->color('success'),

            Stat::make('Produtos', Produto::count())
                ->description('Total de produtos')
                ->color('warning'),

            Stat::make('Valor em Pedidos', 'R$ ' . number_format(Pedido::sum('valor_total'), 2, ',', '.'))
                ->description('Soma de todos os pedidos')
                ->color('primary'),
        ];
    }
}