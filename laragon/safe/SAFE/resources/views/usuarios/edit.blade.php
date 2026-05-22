@extends('layouts.app')
@section('title', 'Editar Professor')
@section('subtitle', $usuario->name)

@section('content')
<div class="max-w-lg mx-auto">
    <form method="POST" action="{{ route('usuarios.update', $usuario) }}" class="space-y-4">
        @csrf @method('PUT')

        <div class="bg-white rounded-2xl shadow-soft border border-slate-100/80 p-6 space-y-4">

            <div class="flex justify-center mb-2">
                <x-avatar :nome="$usuario->name" size="20" />
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">Nome completo</label>
                <input type="text" name="name" value="{{ old('name', $usuario->name) }}" required
                    maxlength="100" autocomplete="off"
                    class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">E-mail</label>
                <input type="email" name="email" value="{{ old('email', $usuario->email) }}" required
                    class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
            </div>

            <div x-data="turmasInput({{ json_encode(old('turmas', $usuario->professorTurmas->pluck('turma')->toArray())) }})">
                <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">
                    Turmas responsáveis
                    <span class="font-normal text-slate-400 normal-case">(notificações de saída)</span>
                </label>

                <div class="flex flex-wrap gap-2 mb-2" x-show="turmas.length > 0">
                    <template x-for="(t, i) in turmas" :key="i">
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-senai-50 text-senai-700 text-xs font-semibold ring-1 ring-senai-200">
                            <i class="ph ph-chalkboard"></i>
                            <span x-text="t"></span>
                            <input type="hidden" name="turmas[]" :value="t">
                            <button type="button" @click="remover(i)"
                                class="ml-0.5 text-senai-400 hover:text-senai-700 transition-colors">
                                <i class="ph ph-x text-[10px]"></i>
                            </button>
                        </span>
                    </template>
                </div>

                <div class="relative">
                    <i class="ph ph-chalkboard absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" x-model="nova" list="turmas-lista"
                        @keydown.enter.prevent="adicionar()"
                        @keydown.comma.prevent="adicionar()"
                        placeholder="Digite a turma e pressione Enter" maxlength="50" autocomplete="off"
                        class="w-full pl-10 pr-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
                    <datalist id="turmas-lista">
                        @foreach($turmasExistentes as $t)
                            <option value="{{ $t }}">
                        @endforeach
                    </datalist>
                </div>
                <p class="text-xs text-slate-400 mt-1">Pressione <kbd class="px-1 py-0.5 bg-slate-100 rounded text-[10px]">Enter</kbd> ou <kbd class="px-1 py-0.5 bg-slate-100 rounded text-[10px]">,</kbd> para adicionar cada turma.</p>
            </div>

            <div class="pt-2 border-t border-slate-100">
                <p class="text-xs text-slate-400 mb-3">Deixe em branco para manter a senha atual</p>
                <div class="space-y-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">Nova senha</label>
                        <input type="password" name="password" minlength="6"
                            class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">Confirmar nova senha</label>
                        <input type="password" name="password_confirmation" minlength="6"
                            class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
                    </div>
                </div>
            </div>

        </div>

        <div class="flex gap-3">
            <a href="{{ route('usuarios.index') }}"
                class="flex-1 text-center bg-white border-2 border-slate-200 text-slate-700 font-semibold py-3 rounded-xl hover:bg-slate-50 transition-colors">
                Cancelar
            </a>
            <button type="submit"
                class="flex-1 bg-gradient-to-br from-senai-600 to-senai-700 text-white font-bold py-3 rounded-xl shadow-lg shadow-senai-600/30 hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2">
                <i class="ph-fill ph-floppy-disk"></i> Atualizar
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
function turmasInput(initial) {
    return {
        turmas: initial,
        nova: '',
        adicionar() {
            const t = this.nova.trim().replace(/,$/, '');
            if (t && !this.turmas.includes(t)) this.turmas.push(t);
            this.nova = '';
        },
        remover(i) {
            this.turmas.splice(i, 1);
        }
    };
}
</script>
@endpush
