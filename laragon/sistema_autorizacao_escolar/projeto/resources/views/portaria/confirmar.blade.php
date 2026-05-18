@extends('layouts.app')
@section('title', $tipo === 'saida' ? 'Confirmar Saída' : 'Confirmar Entrada')
@section('subtitle', 'Revise os dados e confirme o registro')

@section('content')
<div class="max-w-2xl mx-auto">

    @php
        $isSaida = $tipo === 'saida';
        $cor = $isSaida ? 'orange' : 'emerald';
        $gradient = $isSaida ? 'from-orange-500 to-amber-600' : 'from-emerald-500 to-teal-600';
    @endphp

    {{-- Cabeçalho com tipo --}}
    <div class="bg-gradient-to-br {{ $gradient }} rounded-2xl p-6 text-white mb-5 shadow-lg shadow-{{ $cor }}-500/20 relative overflow-hidden">
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full"></div>
        <div class="relative flex items-center gap-4">
            <div class="w-16 h-16 rounded-2xl bg-white/20 backdrop-blur flex items-center justify-center">
                <i class="ph-fill {{ $isSaida ? 'ph-sign-out' : 'ph-sign-in' }} text-3xl"></i>
            </div>
            <div>
                <p class="text-sm text-white/80 uppercase tracking-wider font-semibold">Registro de</p>
                <h2 class="text-3xl font-bold">{{ $isSaida ? 'Saída' : 'Entrada' }}</h2>
            </div>
        </div>
    </div>

    {{-- Card do aluno --}}
    <div class="bg-white rounded-2xl shadow-soft border border-slate-100/80 p-6 mb-5">
        <div class="flex items-center gap-5 mb-5">
            <x-avatar :nome="$aluno->nome" :foto="$aluno->foto_path" size="20" />
            <div class="flex-1">
                <h3 class="text-xl font-bold text-slate-900">{{ $aluno->nome }}</h3>
                <p class="text-sm text-slate-500">Matrícula <strong>{{ $aluno->matricula }}</strong> · {{ $aluno->turma }}</p>
                @if($aluno->responsaveis->isNotEmpty())
                <div class="flex items-center gap-1 mt-2">
                    <i class="ph ph-users-three text-slate-400 text-sm"></i>
                    <p class="text-xs text-slate-500">
                        {{ $aluno->responsaveis->map(fn($r) => $r->nome . ' (' . $r->pivot->parentesco . ')')->join(', ') }}
                    </p>
                </div>
                @endif
            </div>
        </div>

        @if($isSaida && $autorizacao)
        <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4">
            <div class="flex items-start gap-3">
                <i class="ph-fill ph-seal-check text-emerald-600 text-2xl shrink-0"></i>
                <div class="flex-1 text-sm">
                    <p class="font-bold text-emerald-900 mb-2">Autorização de Saída Ativa</p>
                    <div class="space-y-1 text-emerald-800">
                        <p><strong>Motivo:</strong> {{ $autorizacao->motivo }}</p>
                        <p><strong>Autorizado por:</strong> {{ $autorizacao->responsavel->nome }}</p>
                        @if($autorizacao->aprovadoPor)
                            <p><strong>Aprovado por:</strong> {{ $autorizacao->aprovadoPor->name }} (Professor)</p>
                        @endif
                        @if($autorizacao->validade_fim)
                            <p class="text-emerald-700 text-xs mt-2 pt-2 border-t border-emerald-200">
                                <i class="ph ph-clock"></i> Válido até {{ $autorizacao->validade_fim->format('d/m/Y H:i') }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @elseif(!$isSaida)
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
            <div class="flex items-start gap-3">
                <i class="ph-fill ph-info text-blue-600 text-2xl shrink-0"></i>
                <div>
                    <p class="font-semibold text-blue-900 mb-0.5">Registrar entrada na escola</p>
                    <p class="text-sm text-blue-700">Os responsáveis serão notificados automaticamente por e-mail e WhatsApp.</p>
                </div>
            </div>
        </div>
        @endif
    </div>

    {{-- Formulário --}}
    <form method="POST" action="{{ route('portaria.registrar', $aluno) }}">
        @csrf
        <input type="hidden" name="tipo" value="{{ $tipo }}">

        <div class="bg-white rounded-2xl shadow-soft border border-slate-100/80 p-6 mb-4">
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                <i class="ph ph-note-pencil"></i> Observação <span class="text-slate-400 font-normal">(opcional)</span>
            </label>
            <textarea name="observacao" rows="3" placeholder="Ex: Saída antecipada por consulta médica..."
                class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500"></textarea>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('portaria.index') }}"
                class="flex-1 text-center bg-white border-2 border-slate-200 text-slate-700 font-semibold py-3.5 rounded-xl hover:bg-slate-50 transition-colors">
                Cancelar
            </a>
            <button type="submit"
                class="flex-1 bg-gradient-to-br {{ $gradient }} text-white font-bold py-3.5 rounded-xl shadow-lg shadow-{{ $cor }}-500/30 hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2">
                <i class="ph-fill ph-check-circle text-lg"></i>
                Confirmar {{ $isSaida ? 'Saída' : 'Entrada' }}
            </button>
        </div>
    </form>
</div>
@endsection
