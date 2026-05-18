@extends('layouts.app')
@section('title', 'Autorizações')
@section('subtitle', 'Gerencie as autorizações de saída dos alunos')

@section('content')

@php
    $contadores = [
        'todos'              => \App\Models\Autorizacao::count(),
        'ativa'              => \App\Models\Autorizacao::where('status','ativa')->count(),
        'pendente_professor' => \App\Models\Autorizacao::where('status','pendente_professor')->count(),
        'revogada'           => \App\Models\Autorizacao::where('status','revogada')->count(),
    ];
    $abas = [
        'todos'              => ['label' => 'Todos',     'icon' => 'ph-list',         'cor' => 'text-ink-700'],
        'ativa'              => ['label' => 'Ativas',    'icon' => 'ph-check-circle', 'cor' => 'text-emerald-600'],
        'pendente_professor' => ['label' => 'Pendentes', 'icon' => 'ph-clock',        'cor' => 'text-amber-600'],
        'revogada'           => ['label' => 'Revogadas', 'icon' => 'ph-x-circle',     'cor' => 'text-senai-600'],
    ];
    $filtroAtivo = request('filtro', 'todos');
@endphp

<div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3 mb-5">
    <a href="{{ route('autorizacoes.create') }}" class="lg:order-2 self-start lg:self-auto inline-flex items-center gap-2 bg-gradient-to-br from-senai-600 to-senai-700 text-white font-semibold px-5 py-2.5 rounded-xl shadow-senai hover:-translate-y-0.5 transition-all">
        <i class="ph-bold ph-plus"></i>
        Nova Autorização
    </a>

    {{-- Abas estilo segmented control --}}
    <div class="lg:order-1 inline-flex bg-white p-1 rounded-xl border border-slate-200 shadow-soft overflow-x-auto">
        @foreach($abas as $key => $aba)
            @php $isActive = $filtroAtivo === $key; @endphp
            <a href="?filtro={{ $key }}" class="relative flex items-center gap-1.5 px-3 lg:px-4 py-2 rounded-lg text-sm font-semibold transition-all whitespace-nowrap
                {{ $isActive ? 'bg-senai-600 text-white shadow-senai' : 'text-slate-600 hover:bg-slate-50' }}">
                <i class="ph {{ $aba['icon'] }} {{ $isActive ? 'text-white' : $aba['cor'] }}"></i>
                {{ $aba['label'] }}
                <span class="text-[11px] font-bold ml-1 px-1.5 rounded-md
                    {{ $isActive ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500' }}">
                    {{ $contadores[$key] }}
                </span>
            </a>
        @endforeach
    </div>
</div>

<div class="bg-white rounded-2xl shadow-soft border border-slate-100/80 overflow-hidden">
    @if($autorizacoes->isEmpty())
        <div class="text-center py-16 text-slate-400">
            <i class="ph ph-seal text-6xl text-slate-300"></i>
            <p class="mt-3">Nenhuma autorização encontrada.</p>
        </div>
    @else
    <table class="w-full text-sm">
        <thead class="bg-slate-50/80 text-slate-500 uppercase text-[10px] tracking-wider">
            <tr>
                <th class="px-5 py-3 text-left font-semibold">Aluno</th>
                <th class="px-5 py-3 text-left font-semibold">Tipo</th>
                <th class="px-5 py-3 text-left font-semibold">Responsável</th>
                <th class="px-5 py-3 text-left font-semibold">Motivo</th>
                <th class="px-5 py-3 text-left font-semibold">Validade</th>
                <th class="px-5 py-3 text-left font-semibold">Status</th>
                <th class="px-5 py-3 text-right font-semibold">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-50">
            @foreach($autorizacoes as $aut)
            <tr class="hover:bg-slate-50/50 transition-colors">
                <td class="px-5 py-3.5">
                    <div class="flex items-center gap-3">
                        <x-avatar :nome="$aut->aluno->nome" :foto="$aut->aluno->foto_path" size="9" />
                        <div>
                            <p class="font-semibold text-slate-800">{{ $aut->aluno->nome }}</p>
                            <p class="text-xs text-slate-400">{{ $aut->aluno->turma }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-5 py-3.5">
                    <x-badge variant="brand" icon="{{ $aut->tipo === 'saida' ? 'ph-sign-out' : ($aut->tipo === 'entrada' ? 'ph-sign-in' : 'ph-arrows-left-right') }}">
                        {{ $aut->tipo_label }}
                    </x-badge>
                </td>
                <td class="px-5 py-3.5 text-slate-600">{{ $aut->responsavel->nome }}</td>
                <td class="px-5 py-3.5 max-w-xs">
                    <p class="text-slate-600 truncate" title="{{ $aut->motivo }}">{{ $aut->motivo }}</p>
                </td>
                <td class="px-5 py-3.5 text-xs text-slate-500">
                    @if($aut->validade_fim)
                        até {{ $aut->validade_fim->format('d/m/Y') }}
                    @else
                        <span class="text-slate-400 italic">indefinido</span>
                    @endif
                </td>
                <td class="px-5 py-3.5">
                    @php
                        $variants = ['ativa'=>'green','pendente_professor'=>'yellow','revogada'=>'red','expirada'=>'gray'];
                    @endphp
                    <x-badge :variant="$variants[$aut->status] ?? 'gray'">
                        {{ $aut->status_label }}
                    </x-badge>
                </td>
                <td class="px-5 py-3.5">
                    <div class="flex justify-end gap-1">
                        @if($aut->status === 'pendente_professor')
                        <form method="POST" action="{{ route('autorizacoes.aprovar', $aut) }}">
                            @csrf @method('PATCH')
                            <button class="p-1.5 text-emerald-600 hover:bg-emerald-50 rounded-lg" title="Aprovar">
                                <i class="ph-fill ph-check-circle text-lg"></i>
                            </button>
                        </form>
                        @endif
                        @if($aut->status === 'ativa')
                        <form method="POST" action="{{ route('autorizacoes.revogar', $aut) }}">
                            @csrf @method('PATCH')
                            <button class="p-1.5 text-orange-600 hover:bg-orange-50 rounded-lg" title="Revogar"
                                    onclick="return confirm('Revogar esta autorização?')">
                                <i class="ph ph-x-circle text-lg"></i>
                            </button>
                        </form>
                        @endif
                        <form method="POST" action="{{ route('autorizacoes.destroy', $aut) }}">
                            @csrf @method('DELETE')
                            <button class="p-1.5 text-rose-500 hover:bg-rose-50 rounded-lg" title="Excluir"
                                    onclick="return confirm('Excluir esta autorização?')">
                                <i class="ph ph-trash text-lg"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4 border-t border-slate-100">{{ $autorizacoes->links() }}</div>
    @endif
</div>

@endsection
