<?php

namespace App\Filament\Widgets;

use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Produto;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $clientesNoMes = Cliente::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $clientesChart = collect(range(6, 0))
            ->map(fn ($d) => Cliente::whereDate('created_at', now()->subDays($d))->count())
            ->toArray();

        $pedidosPendentes = Pedido::where('status', 'pendente')->count();

        $pedidosChart = collect(range(6, 0))
            ->map(fn ($d) => Pedido::whereDate('created_at', now()->subDays($d))->count())
            ->toArray();

        $receitaTotal = Pedido::where('status', '!=', 'cancelado')->sum('valor_total');

        $receitaChart = collect(range(6, 0))
            ->map(fn ($d) => (float) Pedido::where('status', '!=', 'cancelado')
                ->whereDate('data_pedido', now()->subDays($d))
                ->sum('valor_total'))
            ->toArray();

        $produtosEstoqueBaixo = Produto::where('estoque', '<', 10)->count();

        return [
            Stat::make('Total de Clientes', Cliente::count())
                ->description('+' . $clientesNoMes . ' cadastrados este mês')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('info')
                ->chart($clientesChart),

            Stat::make('Pedidos', Pedido::count())
                ->description($pedidosPendentes . ' pendentes de produção')
                ->descriptionIcon('heroicon-m-clock')
                ->color($pedidosPendentes > 0 ? 'warning' : 'success')
                ->chart($pedidosChart),

            Stat::make('Receita Total', 'R$ ' . number_format($receitaTotal, 2, ',', '.'))
                ->description('Pedidos não cancelados')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success')
                ->chart($receitaChart),

            Stat::make('Produtos em Estoque', Produto::count())
                ->description($produtosEstoqueBaixo > 0
                    ? $produtosEstoqueBaixo . ' com estoque baixo (< 10)'
                    : 'Estoque saudável')
                ->descriptionIcon($produtosEstoqueBaixo > 0
                    ? 'heroicon-m-exclamation-triangle'
                    : 'heroicon-m-check-circle')
                ->color($produtosEstoqueBaixo > 0 ? 'danger' : 'success'),
        ];
    }
}
