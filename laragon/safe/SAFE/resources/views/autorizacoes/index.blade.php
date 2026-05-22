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
                <th class="px-5 py-3 text-left font-semibold">Horário de saída</th>
                <th class="px-5 py-3 text-left font-semibold">Faltas</th>
                <th class="px-5 py-3 text-left font-semibold">Motivo</th>
                <th class="px-5 py-3 text-left font-semibold">Responsável</th>
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
                            <p class="text-xs text-slate-400">{{ $aut->aluno->turma }} · Mat. {{ $aut->aluno->matricula }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-5 py-3.5">
                    @if($aut->validade_inicio)
                        <p class="font-semibold text-slate-800">{{ $aut->validade_inicio->format('H:i') }}</p>
                        <p class="text-xs text-slate-400">{{ $aut->validade_inicio->format('d/m/Y') }}</p>
                    @else
                        <span class="text-slate-400 italic text-xs">não informado</span>
                    @endif
                </td>
                <td class="px-5 py-3.5">
                    <span class="inline-flex items-center gap-1 font-bold text-slate-800">
                        {{ $aut->faltas ?? 0 }}
                        <span class="text-xs font-normal text-slate-400">{{ ($aut->faltas ?? 0) == 1 ? 'falta' : 'faltas' }}</span>
                    </span>
                </td>
                <td class="px-5 py-3.5 max-w-xs">
                    <p class="text-slate-600 truncate text-sm" title="{{ $aut->motivo }}">{{ $aut->motivo }}</p>
                </td>
                <td class="px-5 py-3.5 text-slate-600 text-sm">
                    {{ $aut->responsavel?->nome ?? '—' }}
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
                        <a href="{{ route('autorizacoes.comprovante', $aut) }}" target="_blank"
                           class="p-1.5 text-slate-500 hover:text-slate-800 hover:bg-slate-100 rounded-lg" title="Ver comprovante">
                            <i class="ph ph-printer text-lg"></i>
                        </a>
                        @if($aut->status === 'ativa')
                        <form method="POST" action="{{ route('autorizacoes.revogar', $aut) }}"
                              id="form-revogar-{{ $aut->id }}">
                            @csrf @method('PATCH')
                            <button type="button"
                                    @click="$store.confirmModal.show('Revogar autorização', 'Tem certeza que deseja revogar esta autorização?', 'form-revogar-{{ $aut->id }}', 'warning')"
                                    class="p-1.5 text-orange-600 hover:bg-orange-50 rounded-lg" title="Revogar">
                                <i class="ph ph-x-circle text-lg"></i>
                            </button>
                        </form>
                        @endif
                        @if(auth()->user()->isAdmin())
                        <form method="POST" action="{{ route('autorizacoes.destroy', $aut) }}"
                              id="form-excluir-{{ $aut->id }}">
                            @csrf @method('DELETE')
                            <button type="button"
                                    @click="$store.confirmModal.show('Excluir autorização', 'Tem certeza que deseja excluir permanentemente esta autorização? Esta ação não pode ser desfeita.', 'form-excluir-{{ $aut->id }}')"
                                    class="p-1.5 text-rose-500 hover:bg-rose-50 rounded-lg" title="Excluir">
                                <i class="ph ph-trash text-lg"></i>
                            </button>
                        </form>
                        @endif
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
