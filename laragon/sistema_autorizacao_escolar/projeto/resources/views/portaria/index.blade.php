@extends('layouts.app')
@section('title', 'Portaria')
@section('subtitle', 'Registro de entrada e saída de alunos')

@section('content')

<div x-data="portaria()" class="space-y-6">

    {{-- Busca principal --}}
    <div class="bg-gradient-to-br from-white to-slate-50 rounded-2xl shadow-soft border border-slate-100/80 p-6 lg:p-8">
        <div class="text-center mb-5">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-gradient-to-br from-senai-500 to-senai-700 shadow-lg shadow-senai-600/30 mb-3">
                <i class="ph-fill ph-magnifying-glass text-white text-2xl"></i>
            </div>
            <h2 class="text-xl font-bold text-slate-900">Buscar aluno</h2>
            <p class="text-sm text-slate-500">Digite o nome ou matrícula para localizar</p>
        </div>

        <div class="relative max-w-2xl mx-auto">
            <i class="ph ph-magnifying-glass absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 text-xl"></i>
            <input type="text" x-model="query" @input.debounce.300ms="buscar()"
                   placeholder="Nome ou matrícula do aluno..."
                   autofocus
                   class="w-full pl-14 pr-14 py-4 text-base bg-white border-2 border-slate-200 rounded-2xl focus:outline-none focus:border-senai-500 focus:ring-4 focus:ring-senai-100 transition-all">
            <div x-show="carregando" x-cloak class="absolute right-5 top-1/2 -translate-y-1/2">
                <svg class="animate-spin w-5 h-5 text-senai-500" fill="none" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3" class="opacity-25"/>
                    <path fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z" class="opacity-75"/>
                </svg>
            </div>
            <button x-show="query.length" @click="limpar()" x-cloak class="absolute right-5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
                <i class="ph ph-x-circle text-xl"></i>
            </button>
        </div>

        {{-- Indicador --}}
        <div class="mt-5 flex items-center justify-center gap-2 text-xs text-slate-500">
            <span class="flex items-center gap-1"><i class="ph-fill ph-check-circle text-emerald-500"></i> Autorização ativa</span>
            <span class="text-slate-300">·</span>
            <span class="flex items-center gap-1"><i class="ph-fill ph-lock-key text-slate-400"></i> Saída bloqueada</span>
        </div>
    </div>

    {{-- Resultados --}}
    <div x-show="query.length >= 2" x-cloak class="space-y-3 animate-fade-in">
        <template x-if="resultados.length === 0 && !carregando">
            <div class="bg-white rounded-2xl p-8 text-center text-slate-400 border border-slate-100 shadow-soft">
                <i class="ph ph-binoculars text-5xl text-slate-300"></i>
                <p class="mt-2 text-sm">Nenhum aluno encontrado para <strong x-text="`'${query}'`" class="text-slate-600"></strong></p>
            </div>
        </template>

        <template x-for="aluno in resultados" :key="aluno.id">
            <div class="bg-white rounded-2xl p-5 shadow-soft hover:shadow-lg border border-slate-100/80 transition-all flex items-center gap-4 animate-slide-up">
                {{-- Avatar --}}
                <template x-if="aluno.foto">
                    <img :src="aluno.foto" :alt="aluno.nome" class="w-14 h-14 rounded-full object-cover ring-2 ring-white shadow-md">
                </template>
                <template x-if="!aluno.foto">
                    <div class="w-14 h-14 rounded-full text-white font-bold flex items-center justify-center shadow-md ring-2 ring-white bg-gradient-to-br"
                         :class="aluno.cor">
                        <span x-text="aluno.iniciais"></span>
                    </div>
                </template>

                {{-- Info --}}
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2">
                        <p class="font-bold text-slate-900 text-base truncate" x-text="aluno.nome"></p>
                        <template x-if="aluno.tem_autorizacao">
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200">
                                <i class="ph-fill ph-check-circle"></i> Autorizado
                            </span>
                        </template>
                    </div>
                    <p class="text-xs text-slate-500">
                        <span x-text="aluno.matricula"></span> ·
                        <span x-text="aluno.turma"></span>
                    </p>
                    <p class="text-[11px] text-slate-400 mt-0.5 truncate" x-show="aluno.responsaveis"
                       x-text="`Resp.: ${aluno.responsaveis}`"></p>
                </div>

                {{-- Ações --}}
                <div class="flex gap-2 shrink-0">
                    <a :href="aluno.url_entrada"
                       class="px-4 py-2.5 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 font-semibold rounded-xl text-sm flex items-center gap-1.5 transition-colors">
                        <i class="ph-fill ph-sign-in"></i> Entrada
                    </a>
                    <template x-if="aluno.tem_autorizacao">
                        <a :href="aluno.url_saida"
                           class="px-4 py-2.5 bg-orange-50 hover:bg-orange-100 text-orange-700 font-semibold rounded-xl text-sm flex items-center gap-1.5 transition-colors">
                            <i class="ph-fill ph-sign-out"></i> Saída
                        </a>
                    </template>
                    <template x-if="!aluno.tem_autorizacao">
                        <span class="px-4 py-2.5 bg-slate-100 text-slate-400 font-semibold rounded-xl text-sm flex items-center gap-1.5 cursor-not-allowed" title="Sem autorização ativa">
                            <i class="ph-fill ph-lock-key"></i> Saída
                        </span>
                    </template>
                </div>
            </div>
        </template>
    </div>

    {{-- Estado inicial: movimentações de hoje --}}
    <div x-show="query.length < 2" x-cloak>
        <div class="bg-white rounded-2xl shadow-soft border border-slate-100/80 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-slate-800">Movimentações de hoje</h3>
                    <p class="text-xs text-slate-500">{{ now()->isoFormat('dddd, D [de] MMMM') }}</p>
                </div>
                <a href="{{ route('movimentacoes.index') }}" class="text-xs font-semibold text-senai-600 hover:text-senai-700 flex items-center gap-1">
                    Ver tudo <i class="ph ph-arrow-right"></i>
                </a>
            </div>

            @if($recentes->isEmpty())
                <div class="text-center py-12 text-slate-400">
                    <i class="ph ph-empty text-5xl"></i>
                    <p class="mt-2 text-sm">Nenhuma movimentação registrada hoje ainda.</p>
                </div>
            @else
                <div class="divide-y divide-slate-50">
                @foreach($recentes as $mov)
                    <div class="px-6 py-3.5 flex items-center gap-3 hover:bg-slate-50/50">
                        <x-avatar :nome="$mov->aluno->nome" size="10" />
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-slate-800">{{ $mov->aluno->nome }}</p>
                            <p class="text-xs text-slate-500">{{ $mov->aluno->turma }}</p>
                        </div>
                        <x-badge :variant="$mov->tipo === 'saida' ? 'orange' : 'green'"
                                 :icon="$mov->tipo === 'saida' ? 'ph-sign-out' : 'ph-sign-in'">
                            {{ $mov->tipo_label }}
                        </x-badge>
                        <p class="text-xs text-slate-400 w-12 text-right">{{ $mov->created_at->format('H:i') }}</p>
                    </div>
                @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
function portaria() {
    return {
        query: '',
        resultados: [],
        carregando: false,
        async buscar() {
            if (this.query.length < 2) { this.resultados = []; return; }
            this.carregando = true;
            try {
                const res = await fetch(`{{ route('portaria.buscar.json') }}?q=${encodeURIComponent(this.query)}`, {
                    headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
                });
                const data = await res.json();
                this.resultados = data.alunos;
            } finally {
                this.carregando = false;
            }
        },
        limpar() { this.query = ''; this.resultados = []; }
    }
}
</script>
@endpush

@endsection
