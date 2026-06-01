<?php

namespace App\Filament\Widgets;

use App\Models\Pedido;
use Filament\Widgets\ChartWidget;

class MyWidget extends ChartWidget
{
    protected ?string $heading = 'Pedidos por Status';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'data' => [
                        Pedido::where('status', 'pendente')->count(),
                        Pedido::where('status', 'em_producao')->count(),
                        Pedido::where('status', 'finalizado')->count(),
                        Pedido::where('status', 'cancelado')->count(),
                    ],
                    'backgroundColor' => ['#F59E0B', '#3B82F6', '#10B981', '#EF4444'],
                    'borderWidth' => 2,
                    'borderColor' => '#ffffff',
                    'hoverOffset' => 8,
                ],
            ],
            'labels' => ['Pendente', 'Em Produção', 'Finalizado', 'Cancelado'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
