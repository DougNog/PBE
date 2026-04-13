<?php

namespace App\Filament\Widgets;

use App\Models\MovimentacaoEstoque;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class MovimentacaoEstoqueWidget extends ChartWidget
{
    public function getHeading(): string
    {
        return 'Movimentações de Estoque';
    }

    public static function getSort(): int
    {
        return 2;
    }

    protected function getData(): array
    {
        $meses = collect(range(1, 12))->map(fn($m) => Carbon::create(now()->year, $m));

        $entradas = $meses->map(fn($m) =>
            MovimentacaoEstoque::where('tipo', 'entrada')
                ->whereMonth('data_movimentacao', $m->month)
                ->whereYear('data_movimentacao', $m->year)
                ->sum('quantidade')
        );

        $saidas = $meses->map(fn($m) =>
            MovimentacaoEstoque::where('tipo', 'saida')
                ->whereMonth('data_movimentacao', $m->month)
                ->whereYear('data_movimentacao', $m->year)
                ->sum('quantidade')
        );

        return [
            'datasets' => [
                [
                    'label' => 'Entradas',
                    'data' => $entradas->values()->toArray(),
                    'backgroundColor' => '#1D9E75',
                ],
                [
                    'label' => 'Saídas',
                    'data' => $saidas->values()->toArray(),
                    'backgroundColor' => '#D85A30',
                ],
            ],
            'labels' => ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}