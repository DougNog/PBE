@extends('layouts.app')
@section('title', 'Novo Responsável')

@section('content')
<div class="max-w-lg mx-auto">
    <form method="POST" action="{{ route('responsaveis.store') }}" class="space-y-4">
        @csrf

        <div class="bg-white rounded-2xl shadow-soft border border-slate-100/80 p-6 space-y-4">
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">Nome completo</label>
                <div class="relative">
                    <i class="ph ph-user absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" name="nome" value="{{ old('nome') }}" required
                        placeholder="Ex: Maria da Silva" maxlength="100" autocomplete="off"
                        class="w-full pl-10 pr-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
                </div>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">E-mail</label>
                <div class="relative">
                    <i class="ph ph-envelope absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full pl-10 pr-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
                </div>
                <p class="text-[11px] text-slate-400 mt-1 flex items-center gap-1">
                    <i class="ph ph-info"></i> Receberá notificações do sistema.
                </p>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">Telefone (WhatsApp)</label>
                <div class="relative">
                    <i class="ph ph-phone absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" name="telefone" value="{{ old('telefone') }}" placeholder="(11) 99999-9999" required
                        maxlength="15" inputmode="numeric"
                        class="w-full pl-10 pr-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
                </div>
                <p class="text-[11px] text-slate-400 mt-1 flex items-center gap-1">
                    <i class="ph ph-info"></i> Usado para notificações simuladas de WhatsApp.
                </p>
            </div>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('responsaveis.index') }}"
                class="flex-1 text-center bg-white border-2 border-slate-200 text-slate-700 font-semibold py-3 rounded-xl hover:bg-slate-50">
                Cancelar
            </a>
            <button type="submit"
                class="flex-1 bg-gradient-to-br from-senai-600 to-senai-700 text-white font-bold py-3 rounded-xl shadow-lg shadow-senai-600/30 hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2">
                <i class="ph-fill ph-check-circle"></i> Salvar
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    function capitalizarPalavras(input) {
        const pos = input.selectionStart;
        input.value = input.value.replace(/(^|\s)\S/g, l => l.toUpperCase());
        input.setSelectionRange(pos, pos);
    }

    function formatarTelefone(input) {
        let v = input.value.replace(/\D/g, '').slice(0, 11);
        if (v.length === 0) { input.value = ''; return; }
        if (v.length <= 2)  { input.value = `(${v}`; return; }
        if (v.length <= 6)  { input.value = `(${v.slice(0,2)}) ${v.slice(2)}`; return; }
        if (v.length <= 10) { input.value = `(${v.slice(0,2)}) ${v.slice(2,6)}-${v.slice(6)}`; return; }
        input.value = `(${v.slice(0,2)}) ${v.slice(2,7)}-${v.slice(7)}`;
    }

    document.querySelector('[name="nome"]')
        ?.addEventListener('input', function () { capitalizarPalavras(this); });

    const tel = document.querySelector('[name="telefone"]');
    tel?.addEventListener('input', function () { formatarTelefone(this); });
});
</script>
@endpush
