@extends('layouts.app')
@section('title', 'Movimentações')
@section('subtitle', 'Histórico completo de entradas e saídas')

@section('content')

<div x-data="{ view: 'timeline' }">

{{-- Filtros + Toggle de visualização --}}
<div class="bg-white rounded-2xl shadow-soft border border-slate-100/80 p-4 mb-5">
    <form method="GET" class="flex flex-wrap gap-2 items-center">
        <div class="relative flex-1 min-w-[180px]">
            <i class="ph ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
            <input type="text" name="aluno" value="{{ request('aluno') }}" placeholder="Aluno ou matrícula..."
                class="w-full pl-10 pr-3 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
        </div>
        <select name="tipo" class="border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
            <option value="">Todos</option>
            <option value="entrada" {{ request('tipo') === 'entrada' ? 'selected' : '' }}>Entradas</option>
            <option value="saida"   {{ request('tipo') === 'saida' ? 'selected' : '' }}>Saídas</option>
        </select>
        <input type="date" name="data" value="{{ request('data') }}"
            class="border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
        <button type="submit" class="bg-senai-600 text-white font-semibold px-4 py-2 rounded-lg text-sm hover:bg-senai-700">
            <i class="ph-bold ph-funnel"></i> Filtrar
        </button>
        @if(request()->hasAny(['aluno','tipo','data']))
        <a href="{{ route('movimentacoes.index') }}" class="text-xs text-slate-500 hover:text-slate-700 ml-1">
            Limpar
        </a>
        @endif

        <div class="ml-auto flex bg-slate-100 rounded-lg p-1">
            <button type="button" @click="view='timeline'" :class="view==='timeline' ? 'bg-white shadow-sm text-senai-700' : 'text-slate-500'"
                    class="px-3 py-1 rounded-md text-xs font-semibold transition-all">
                <i class="ph ph-list-bullets"></i> Timeline
            </button>
            <button type="button" @click="view='table'" :class="view==='table' ? 'bg-white shadow-sm text-senai-700' : 'text-slate-500'"
                    class="px-3 py-1 rounded-md text-xs font-semibold transition-all">
                <i class="ph ph-table"></i> Tabela
            </button>
        </div>
    </form>
</div>

@if($movimentacoes->isEmpty())
    <div class="bg-white rounded-2xl p-16 text-center shadow-soft border border-slate-100/80">
        <i class="ph ph-empty text-6xl text-slate-300"></i>
        <p class="mt-3 text-slate-500">Nenhuma movimentação encontrada.</p>
    </div>
@else

{{-- View: Timeline --}}
<div x-show="view==='timeline'">
    @php $grupos = $movimentacoes->groupBy(fn($m) => $m->created_at->format('d/m/Y')); @endphp
    <div class="space-y-6">
        @foreach($grupos as $data => $movs)
            <div>
                <div class="flex items-center gap-3 mb-3 sticky top-16 bg-slate-50 z-10 py-2">
                    <div class="px-3 py-1 bg-white rounded-lg shadow-sm border border-slate-200 text-xs font-bold text-slate-700">
                        {{ $data }}
                    </div>
                    <div class="flex-1 h-px bg-slate-200"></div>
                    <span class="text-xs text-slate-500">{{ $movs->count() }} {{ Str::plural('registro', $movs->count()) }}</span>
                </div>

                <div class="bg-white rounded-2xl shadow-soft border border-slate-100/80 overflow-hidden">
                    @foreach($movs as $mov)
                    <div class="relative flex items-center gap-4 px-5 py-4 hover:bg-slate-50/50 transition-colors border-b border-slate-50 last:border-0">
                        {{-- Tipo icon --}}
                        <div class="shrink-0 w-12 h-12 rounded-xl flex items-center justify-center
                                    {{ $mov->tipo === 'saida' ? 'bg-orange-100 text-orange-600' : 'bg-emerald-100 text-emerald-600' }}">
                            <i class="ph-fill text-xl {{ $mov->tipo === 'saida' ? 'ph-sign-out' : 'ph-sign-in' }}"></i>
                        </div>

                        {{-- Info --}}
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-3 mb-1">
                                <p class="font-bold text-slate-800">{{ $mov->aluno->nome }}</p>
                                <x-badge :variant="$mov->tipo === 'saida' ? 'orange' : 'green'">
                                    {{ $mov->tipo_label }}
                                </x-badge>
                            </div>
                            <p class="text-xs text-slate-500">
                                <span class="font-medium">{{ $mov->aluno->turma }}</span> ·
                                Registrado por {{ $mov->registradoPor->name }}
                                @if($mov->autorizacao)
                                    · <span class="text-slate-400">Motivo: {{ $mov->autorizacao->motivo }}</span>
                                @endif
                            </p>
                            @if($mov->observacao)
                                <p class="text-xs text-slate-400 mt-1 italic">"{{ $mov->observacao }}"</p>
                            @endif
                        </div>

                        {{-- Hora --}}
                        <div class="text-right shrink-0">
                            <p class="text-base font-bold text-slate-800">{{ $mov->created_at->format('H:i') }}</p>
                            <p class="text-[10px] text-slate-400 uppercase tracking-wider">{{ $mov->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- View: Tabela --}}
<div x-show="view==='table'" x-cloak>
    <div class="bg-white rounded-2xl shadow-soft border border-slate-100/80 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50/80 text-slate-500 uppercase text-[10px] tracking-wider">
                <tr>
                    <th class="px-5 py-3 text-left font-semibold">Aluno</th>
                    <th class="px-5 py-3 text-left font-semibold">Tipo</th>
                    <th class="px-5 py-3 text-left font-semibold">Data/Hora</th>
                    <th class="px-5 py-3 text-left font-semibold">Porteiro</th>
                    <th class="px-5 py-3 text-left font-semibold">Motivo/Obs.</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($movimentacoes as $mov)
                <tr class="hover:bg-slate-50/50">
                    <td class="px-5 py-3">
                        <div class="flex items-center gap-3">
                            <x-avatar :nome="$mov->aluno->nome" :foto="$mov->aluno->foto_path" size="8" />
                            <div>
                                <p class="font-semibold text-slate-800">{{ $mov->aluno->nome }}</p>
                                <p class="text-xs text-slate-400">{{ $mov->aluno->turma }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-3">
                        <x-badge :variant="$mov->tipo === 'saida' ? 'orange' : 'green'"
                                 :icon="$mov->tipo === 'saida' ? 'ph-sign-out' : 'ph-sign-in'">
                            {{ $mov->tipo_label }}
                        </x-badge>
                    </td>
                    <td class="px-5 py-3 text-slate-600 whitespace-nowrap">{{ $mov->created_at->format('d/m/Y H:i') }}</td>
                    <td class="px-5 py-3 text-slate-600">{{ $mov->registradoPor->name }}</td>
                    <td class="px-5 py-3 text-xs text-slate-500 max-w-xs truncate">
                        {{ $mov->autorizacao?->motivo ?? $mov->observacao ?? '—' }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="mt-5">{{ $movimentacoes->links() }}</div>

@endif

</div>

@endsection
