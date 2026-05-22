@extends('layouts.app')
@section('title', 'Dashboard')
@section('subtitle', 'Visão geral do sistema · ' . now()->isoFormat('dddd, D [de] MMMM [de] YYYY'))

@section('content')

{{-- Saudação dinâmica --}}
<div class="mb-6">
    <div class="bg-gradient-to-r from-senai-600 via-senai-500 to-senai-700 rounded-2xl p-6 lg:p-8 text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/4"></div>
        <div class="absolute bottom-0 right-12 w-32 h-32 bg-senai-300/20 rounded-full translate-y-1/2"></div>
        <div class="relative">
            <p class="text-senai-100 text-sm font-medium mb-1">
                @php
                    $h = now()->hour;
                    $saudacao = $h < 12 ? 'Bom dia' : ($h < 18 ? 'Boa tarde' : 'Boa noite');
                @endphp
                {{ $saudacao }},
            </p>
            <h2 class="text-2xl lg:text-3xl font-bold mb-2">{{ explode(' ', auth()->user()->name)[0] }} 👋</h2>
            <p class="text-senai-100 max-w-xl">Acompanhe em tempo real o fluxo de entrada e saída de alunos.</p>

            @if(auth()->user()->isPorteiro() || auth()->user()->isAdmin())
            <a href="{{ route('portaria.index') }}" class="inline-flex items-center gap-2 mt-5 bg-white text-senai-700 font-semibold px-5 py-2.5 rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
                <i class="ph-fill ph-door-open"></i>
                Abrir Portaria
            </a>
            @endif
        </div>
    </div>
</div>

{{-- Stats cards --}}
<div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-6">
    <x-stat-card label="Alunos Ativos"        value="{{ $stats['total_alunos'] }}"        icon="ph-student"           color="brand" />
    <x-stat-card label="Saídas Hoje"          value="{{ $stats['saidas_hoje'] }}"         icon="ph-sign-out"          color="orange" />
    <x-stat-card label="Movimentações Hoje"   value="{{ $stats['movimentacoes_hoje'] }}"  icon="ph-arrows-left-right" color="purple"
        :trend="$stats['trend_movimentacoes'] !== null ? abs($stats['trend_movimentacoes']) . '%' : null"
        :trendUp="($stats['trend_movimentacoes'] ?? 0) >= 0" />
    <x-stat-card label="Autorizações Ativas"  value="{{ $stats['autorizacoes_ativas'] }}" icon="ph-seal-check"        color="cyan" />
    <x-stat-card label="Pendentes Aprovação"  value="{{ $stats['pendentes_professor'] }}" icon="ph-clock-countdown"   color="rose" />
</div>

{{-- Gráfico + Pendências --}}
<div class="grid lg:grid-cols-3 gap-4 mb-6">
    <div class="lg:col-span-2 bg-white rounded-2xl p-6 shadow-soft border border-slate-100/80">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h3 class="font-bold text-slate-800">Movimentações dos últimos 7 dias</h3>
                <p class="text-xs text-slate-500">Entradas e saídas por dia</p>
            </div>
            <div class="flex items-center gap-4 text-xs">
                <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span> Entradas</span>
                <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-orange-500"></span> Saídas</span>
            </div>
        </div>
        <div class="relative h-64 lg:h-72">
            <canvas id="chartMov"></canvas>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-soft border border-slate-100/80">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-bold text-slate-800">Pendências</h3>
            @if($pendentes->isNotEmpty())
                <x-badge variant="rose">{{ $pendentes->count() }}</x-badge>
            @endif
        </div>
        @if($pendentes->isEmpty())
            <div class="text-center py-8 text-slate-400">
                <i class="ph-fill ph-check-circle text-4xl text-emerald-300"></i>
                <p class="text-sm mt-2">Sem pendências.</p>
            </div>
        @else
            <div class="space-y-3">
                @foreach($pendentes as $p)
                <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-slate-50 transition-colors">
                    <x-avatar :nome="$p->aluno->nome" size="9" />
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-slate-800 truncate">{{ $p->aluno->nome }}</p>
                        <p class="text-xs text-slate-500 truncate">{{ $p->motivo }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            @if(auth()->user()->isProfessor() || auth()->user()->isAdmin())
            <a href="{{ route('autorizacoes.index') }}" class="mt-3 block text-center text-xs font-semibold text-senai-600 hover:text-senai-700 py-2">
                Ver todas →
            </a>
            @endif
        @endif
    </div>
</div>

{{-- Timeline --}}
<div class="bg-white rounded-2xl shadow-soft border border-slate-100/80 overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
        <div>
            <h3 class="font-bold text-slate-800">Últimas Movimentações</h3>
            <p class="text-xs text-slate-500">Atividade mais recente</p>
        </div>
        <a href="{{ route('movimentacoes.index') }}" class="text-xs font-semibold text-senai-600 hover:text-senai-700 flex items-center gap-1">
            Ver tudo <i class="ph ph-arrow-right"></i>
        </a>
    </div>

    @if($ultimasMovimentacoes->isEmpty())
        <div class="text-center py-12 text-slate-400">
            <i class="ph ph-empty text-5xl"></i>
            <p class="mt-2 text-sm">Nenhuma movimentação ainda.</p>
        </div>
    @else
        <div class="divide-y divide-slate-50">
        @foreach($ultimasMovimentacoes as $mov)
            <div class="px-6 py-4 hover:bg-slate-50/50 transition-colors flex items-center gap-4">
                <div class="relative">
                    <x-avatar :nome="$mov->aluno->nome" size="10" />
                    <span class="absolute -bottom-1 -right-1 w-5 h-5 rounded-full ring-2 ring-white flex items-center justify-center text-[10px]
                        {{ $mov->tipo === 'saida' ? 'bg-orange-500 text-white' : 'bg-emerald-500 text-white' }}">
                        <i class="ph-fill {{ $mov->tipo === 'saida' ? 'ph-sign-out' : 'ph-sign-in' }}"></i>
                    </span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-slate-800">{{ $mov->aluno->nome }}</p>
                    <p class="text-xs text-slate-500">{{ $mov->aluno->turma }} · Por {{ $mov->registradoPor->name }}</p>
                </div>
                <div class="text-right">
                    <x-badge :variant="$mov->tipo === 'saida' ? 'orange' : 'green'">
                        {{ $mov->tipo_label }}
                    </x-badge>
                    <p class="text-xs text-slate-400 mt-1">{{ $mov->created_at->diffForHumans() }}</p>
                </div>
            </div>
        @endforeach
        </div>
    @endif
</div>

@push('scripts')
<script>
    const ctx = document.getElementById('chartMov').getContext('2d');
    const gradEntrada = ctx.createLinearGradient(0, 0, 0, 240);
    gradEntrada.addColorStop(0, 'rgba(16, 185, 129, 0.35)');
    gradEntrada.addColorStop(1, 'rgba(16, 185, 129, 0.02)');
    const gradSaida = ctx.createLinearGradient(0, 0, 0, 240);
    gradSaida.addColorStop(0, 'rgba(249, 115, 22, 0.35)');
    gradSaida.addColorStop(1, 'rgba(249, 115, 22, 0.02)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($dias->pluck('label')),
            datasets: [
                {
                    label: 'Entradas',
                    data: @json($dias->pluck('entradas')),
                    borderColor: '#10b981',
                    backgroundColor: gradEntrada,
                    borderWidth: 2.5, fill: true, tension: 0.4,
                    pointBackgroundColor: '#10b981', pointRadius: 4, pointHoverRadius: 6,
                },
                {
                    label: 'Saídas',
                    data: @json($dias->pluck('saidas')),
                    borderColor: '#f97316',
                    backgroundColor: gradSaida,
                    borderWidth: 2.5, fill: true, tension: 0.4,
                    pointBackgroundColor: '#f97316', pointRadius: 4, pointHoverRadius: 6,
                },
            ]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#0f172a', padding: 12, cornerRadius: 8,
                    titleFont: { weight: 'bold' }, bodySpacing: 6,
                }
            },
            scales: {
                x: { grid: { display: false }, ticks: { font: { size: 11 }, color: '#64748b' } },
                y: { beginAtZero: true, grid: { color: '#f1f5f9' }, ticks: { font: { size: 11 }, color: '#94a3b8', stepSize: 1 } },
            }
        }
    });
</script>
@endpush

@endsection
