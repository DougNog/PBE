<?php

namespace App\Filament\Widgets;

use App\Models\Pedido;
use Filament\Widgets\ChartWidget;

class ReceitaMensalWidget extends ChartWidget
{
    protected ?string $heading = 'Receita por Mês (R$)';

    protected static ?int $sort = 4;

    protected function getData(): array
    {
        $meses = collect(range(5, 0))->map(fn ($m) => now()->subMonths($m));

        $receita = $meses->map(fn ($m) => (float) Pedido::where('status', '!=', 'cancelado')
            ->whereMonth('data_pedido', $m->month)
            ->whereYear('data_pedido', $m->year)
            ->sum('valor_total'));

        return [
            'datasets' => [
                [
                    'label'           => 'Receita (R$)',
                    'data'            => $receita->values()->toArray(),
                    'borderColor'     => '#10B981',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.12)',
                    'fill'            => true,
                    'tension'         => 0.4,
                    'pointBackgroundColor' => '#10B981',
                    'pointRadius'     => 4,
                ],
            ],
            'labels' => $meses->map(fn ($m) => $m->locale('pt_BR')->isoFormat('MMM/YYYY'))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
