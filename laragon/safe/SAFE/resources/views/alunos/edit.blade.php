@extends('layouts.app')
@section('title', 'Editar Aluno')
@section('subtitle', $aluno->nome)

@section('content')
<div class="max-w-2xl mx-auto">
    <form method="POST" action="{{ route('alunos.update', $aluno) }}" enctype="multipart/form-data"
          x-data="{ previewFoto: null }" class="space-y-5">
        @csrf @method('PUT')

        <div class="bg-white rounded-2xl shadow-soft border border-slate-100/80 p-6">
            <div class="flex flex-col sm:flex-row gap-6 mb-5">
                <div class="shrink-0">
                    <label class="block">
                        <div class="relative w-32 h-32 rounded-2xl bg-slate-100 border-2 border-dashed border-slate-300 hover:border-senai-500 cursor-pointer overflow-hidden flex items-center justify-center group transition-colors">
                            @if($aluno->foto_path)
                                <img x-show="!previewFoto" src="{{ asset('storage/' . $aluno->foto_path) }}" class="absolute inset-0 w-full h-full object-cover">
                            @else
                                <div x-show="!previewFoto" class="text-center text-slate-400">
                                    <i class="ph-fill ph-camera text-3xl"></i>
                                </div>
                            @endif
                            <img x-show="previewFoto" x-cloak :src="previewFoto" class="absolute inset-0 w-full h-full object-cover">
                        </div>
                        <input type="file" name="foto" accept="image/*" class="hidden"
                               @change="previewFoto = URL.createObjectURL($event.target.files[0])">
                    </label>
                    <p class="text-[10px] text-slate-400 mt-1 text-center">Clique para alterar</p>
                </div>

                <div class="flex-1 space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">Nome</label>
                        <input type="text" name="nome" value="{{ old('nome', $aluno->nome) }}" required
                            maxlength="100" autocomplete="off"
                            class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">Matrícula</label>
                            <input type="text" name="matricula" value="{{ old('matricula', $aluno->matricula) }}" required
                                maxlength="20" autocomplete="off"
                                class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">Turma</label>
                            <input type="text" name="turma" value="{{ old('turma', $aluno->turma) }}" required
                                maxlength="30" autocomplete="off"
                                class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
                        </div>
                    </div>
                    <label class="flex items-center gap-2 pt-2 cursor-pointer">
                        <input type="checkbox" name="ativo" value="1" {{ $aluno->ativo ? 'checked' : '' }}
                            class="rounded text-senai-600 focus:ring-senai-500">
                        <span class="text-sm text-slate-700">Aluno ativo no sistema</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('alunos.index') }}"
                class="flex-1 text-center bg-white border-2 border-slate-200 text-slate-700 font-semibold py-3 rounded-xl hover:bg-slate-50">
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
document.addEventListener('DOMContentLoaded', function () {
    function capitalizarPalavras(input) {
        const pos = input.selectionStart;
        input.value = input.value.replace(/(^|\s)\S/g, l => l.toUpperCase());
        input.setSelectionRange(pos, pos);
    }

    document.querySelector('[name="nome"]')
        ?.addEventListener('input', function () { capitalizarPalavras(this); });

    document.querySelector('[name="matricula"]')
        ?.addEventListener('input', function () {
            const pos = this.selectionStart;
            this.value = this.value.toUpperCase();
            this.setSelectionRange(pos, pos);
        });

    document.querySelector('[name="turma"]')
        ?.addEventListener('input', function () { capitalizarPalavras(this); });
});
</script>
@endpush
