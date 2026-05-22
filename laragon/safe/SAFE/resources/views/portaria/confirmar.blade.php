@extends('layouts.app')
@section('title', 'Verificar Saída')
@section('subtitle', 'Confirme ou recuse a autorização apresentada')

@section('content')
<div class="max-w-xl mx-auto space-y-5">

    {{-- Card do aluno --}}
    <div class="bg-white rounded-2xl shadow-soft border border-slate-100/80 p-6">
        <div class="flex items-center gap-5">
            <x-avatar :nome="$aluno->nome" :foto="$aluno->foto_path" size="20" />
            <div class="flex-1 min-w-0">
                <h3 class="text-xl font-bold text-slate-900 truncate">{{ $aluno->nome }}</h3>
                <p class="text-sm text-slate-500">
                    Matrícula <strong>{{ $aluno->matricula }}</strong> · {{ $aluno->turma }}
                </p>
                @if($aluno->responsaveis->isNotEmpty())
                <p class="text-xs text-slate-400 mt-1">
                    <i class="ph ph-users-three"></i>
                    {{ $aluno->responsaveis->map(fn($r) => $r->nome.' ('.$r->pivot->parentesco.')')->join(', ') }}
                </p>
                @endif
            </div>
        </div>
    </div>

    {{-- Dados da autorização --}}
    <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-6">
        <div class="flex items-center gap-2 mb-4">
            <i class="ph-fill ph-seal-check text-emerald-600 text-2xl"></i>
            <p class="font-bold text-emerald-900">Autorização de Saída Ativa</p>
        </div>

        <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
                <p class="text-xs text-emerald-600 font-semibold uppercase tracking-wider mb-0.5">Horário de saída</p>
                <p class="text-2xl font-bold text-slate-900">{{ $autorizacao->validade_inicio?->format('H:i') ?? '—' }}</p>
                <p class="text-xs text-slate-500">{{ $autorizacao->validade_inicio?->format('d/m/Y') }}</p>
            </div>
            <div>
                <p class="text-xs text-emerald-600 font-semibold uppercase tracking-wider mb-0.5">Faltas a receber</p>
                <p class="text-2xl font-bold text-slate-900">{{ $autorizacao->faltas ?? 0 }}</p>
                <p class="text-xs text-slate-500">{{ ($autorizacao->faltas ?? 0) == 1 ? 'falta' : 'faltas' }}</p>
            </div>
            <div class="col-span-2">
                <p class="text-xs text-emerald-600 font-semibold uppercase tracking-wider mb-0.5">Motivo</p>
                <p class="text-slate-800 font-medium">{{ $autorizacao->motivo }}</p>
            </div>
            @if($autorizacao->responsavel)
            <div class="col-span-2">
                <p class="text-xs text-emerald-600 font-semibold uppercase tracking-wider mb-0.5">Responsável autorizante</p>
                <p class="text-slate-800">{{ $autorizacao->responsavel->nome }}
                    <span class="text-slate-500">· {{ $autorizacao->responsavel->telefone }}</span>
                </p>
            </div>
            @endif
            @if($autorizacao->aprovadoPor)
            <div class="col-span-2 pt-3 border-t border-emerald-200">
                <p class="text-xs text-emerald-700">
                    <i class="ph ph-user-check"></i>
                    Emitido por <strong>{{ $autorizacao->aprovadoPor->name }}</strong>
                    em {{ $autorizacao->created_at->format('d/m/Y \à\s H:i') }}
                </p>
            </div>
            @endif
        </div>
    </div>

    {{-- Observação (opcional) --}}
    <div class="bg-white rounded-2xl shadow-soft border border-slate-100/80 p-5">
        <label class="block text-sm font-semibold text-slate-700 mb-2">
            Observação <span class="text-slate-400 font-normal">(opcional)</span>
        </label>
        <textarea id="obs" rows="2" placeholder="Ex: documento verificado, responsável confirmou por telefone..."
            class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500 resize-none"></textarea>
    </div>

    {{-- Botões --}}
    <div class="grid grid-cols-2 gap-3">

        {{-- Recusar --}}
        <form method="POST" action="{{ route('portaria.recusar', $aluno) }}"
              onsubmit="return confirm('Recusar a saída de {{ $aluno->nome }}? A autorização será cancelada.')">
            @csrf
            <button type="submit"
                class="w-full bg-white border-2 border-red-200 text-red-600 hover:bg-red-50 hover:border-red-400 font-bold py-4 rounded-xl transition-all flex items-center justify-center gap-2">
                <i class="ph-fill ph-x-circle text-xl"></i>
                Recusar saída
            </button>
        </form>

        {{-- Confirmar --}}
        <form method="POST" action="{{ route('portaria.registrar', $aluno) }}" id="formConfirmar">
            @csrf
            <input type="hidden" name="observacao" id="obsHidden">
            <button type="submit"
                class="w-full bg-gradient-to-br from-emerald-500 to-teal-600 text-white font-bold py-4 rounded-xl shadow-lg shadow-emerald-500/30 hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2">
                <i class="ph-fill ph-check-circle text-xl"></i>
                Confirmar saída
            </button>
        </form>

    </div>

    <a href="{{ route('portaria.index') }}"
       class="block text-center text-sm text-slate-500 hover:text-slate-700 font-medium">
        ← Voltar à portaria
    </a>

</div>
@endsection

@push('scripts')
<script>
document.getElementById('formConfirmar').addEventListener('submit', function () {
    document.getElementById('obsHidden').value = document.getElementById('obs').value;
});
</script>
@endpush
