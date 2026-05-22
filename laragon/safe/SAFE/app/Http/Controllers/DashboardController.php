<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Autorizacao;
use App\Models\Movimentacao;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $hoje  = today();
        $ontem = today()->subDay();

        $movHoje    = Movimentacao::whereDate('created_at', $hoje)->count();
        $movOntem   = Movimentacao::whereDate('created_at', $ontem)->count();
        $trendMov   = $movOntem > 0 ? round((($movHoje - $movOntem) / $movOntem) * 100) : null;

        $stats = [
            'total_alunos'         => Aluno::where('ativo', true)->count(),
            'movimentacoes_hoje'   => $movHoje,
            'saidas_hoje'          => Movimentacao::whereDate('created_at', $hoje)->where('tipo', 'saida')->count(),
            'entradas_hoje'        => Movimentacao::whereDate('created_at', $hoje)->where('tipo', 'entrada')->count(),
            'autorizacoes_ativas'  => Autorizacao::where('status', 'ativa')->count(),
            'pendentes_professor'  => Autorizacao::where('status', 'pendente_professor')->count(),
            'trend_movimentacoes'  => $trendMov,
        ];

        // Gráfico — últimos 7 dias
        $dias = collect();
        for ($i = 6; $i >= 0; $i--) {
            $data = today()->subDays($i);
            $dias->push([
                'label'    => $data->isoFormat('ddd D/MM'),
                'entradas' => Movimentacao::whereDate('created_at', $data)->where('tipo', 'entrada')->count(),
                'saidas'   => Movimentacao::whereDate('created_at', $data)->where('tipo', 'saida')->count(),
            ]);
        }

        $ultimasMovimentacoes = Movimentacao::with(['aluno', 'registradoPor'])
            ->latest()->limit(8)->get();

        $pendentes = Autorizacao::with(['aluno', 'responsavel'])
            ->where('status', 'pendente_professor')
            ->latest()->limit(5)->get();

        return view('dashboard', compact('stats', 'dias', 'ultimasMovimentacoes', 'pendentes'));
    }
}
