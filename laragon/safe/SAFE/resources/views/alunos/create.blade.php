@extends('layouts.app')
@section('title', 'Novo Aluno')
@section('subtitle', 'Cadastre um novo aluno no sistema')

@section('content')
<div class="max-w-3xl mx-auto">
    <form method="POST" action="{{ route('alunos.store') }}" enctype="multipart/form-data"
          x-data="{ previewFoto: null }" class="space-y-5">
        @csrf

        {{-- Card: dados básicos --}}
        <div class="bg-white rounded-2xl shadow-soft border border-slate-100/80 p-6">
            <h3 class="font-bold text-slate-800 mb-1 flex items-center gap-2">
                <i class="ph ph-identification-card text-senai-600"></i>
                Dados do aluno
            </h3>
            <p class="text-xs text-slate-500 mb-5">Informações básicas e foto de perfil</p>

            <div class="flex flex-col sm:flex-row gap-6 mb-5">
                {{-- Upload de foto --}}
                <div class="shrink-0">
                    <label class="block">
                        <div class="relative w-32 h-32 rounded-2xl bg-slate-100 border-2 border-dashed border-slate-300 hover:border-senai-500 cursor-pointer overflow-hidden flex items-center justify-center group transition-colors">
                            <template x-if="!previewFoto">
                                <div class="text-center text-slate-400 group-hover:text-senai-500 transition-colors">
                                    <i class="ph-fill ph-camera text-3xl"></i>
                                    <p class="text-[10px] mt-1 font-semibold uppercase tracking-wider">Foto</p>
                                </div>
                            </template>
                            <img x-show="previewFoto" x-cloak :src="previewFoto" class="absolute inset-0 w-full h-full object-cover">
                        </div>
                        <input type="file" name="foto" accept="image/*" class="hidden"
                               @change="previewFoto = URL.createObjectURL($event.target.files[0])">
                    </label>
                </div>

                <div class="flex-1 space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">Nome completo</label>
                        <input type="text" name="nome" value="{{ old('nome') }}" required
                            placeholder="Ex: João da Silva" maxlength="100" autocomplete="off"
                            class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">Matrícula</label>
                            <input type="text" name="matricula" value="{{ old('matricula') }}" required
                                placeholder="Ex: 2024001" maxlength="20" autocomplete="off"
                                class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">Turma</label>
                            <input type="text" name="turma" value="{{ old('turma') }}" placeholder="Ex: 3º Ano A" required
                                maxlength="30" autocomplete="off"
                                class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card: responsáveis --}}
        <div class="bg-white rounded-2xl shadow-soft border border-slate-100/80 p-6"
             x-data="{
                slots: [{ id: 1 }, { id: 2 }],
                nextId: 3,
                add() { this.slots.push({ id: this.nextId++ }); },
                remove(id) { if (this.slots.length > 2) this.slots = this.slots.filter(s => s.id !== id); }
             }">
            <h3 class="font-bold text-slate-800 mb-1 flex items-center gap-2">
                <i class="ph ph-users-three text-senai-600"></i>
                Vincular Responsáveis
            </h3>
            <p class="text-xs text-slate-500 mb-5">Selecione os responsáveis e o parentesco <span class="text-senai-600 font-semibold">(mínimo 2)</span></p>

            <div class="space-y-3">
                <template x-for="slot in slots" :key="slot.id">
                    <div class="flex gap-3 items-center">
                        <select name="responsaveis[]"
                                class="flex-1 border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
                            <option value="">— Selecione um responsável —</option>
                            @foreach($responsaveis as $r)
                                <option value="{{ $r->id }}">{{ $r->nome }} · {{ $r->telefone }}</option>
                            @endforeach
                        </select>
                        <select name="parentescos[]"
                                class="w-40 border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
                            <option value="Mãe">Mãe</option>
                            <option value="Pai">Pai</option>
                            <option value="Responsável" selected>Responsável</option>
                            <option value="Avó">Avó</option>
                            <option value="Avô">Avô</option>
                            <option value="Tia">Tia</option>
                            <option value="Tio">Tio</option>
                            <option value="Madrasta">Madrasta</option>
                            <option value="Padrasto">Padrasto</option>
                            <option value="Irmã">Irmã</option>
                            <option value="Irmão">Irmão</option>
                            <option value="Tutor(a)">Tutor(a)</option>
                        </select>
                        <button type="button" @click="remove(slot.id)"
                                x-show="slots.length > 2"
                                x-cloak
                                title="Remover responsável"
                                class="shrink-0 w-9 h-9 flex items-center justify-center rounded-xl text-slate-400 hover:text-red-500 hover:bg-red-50 transition-colors">
                            <i class="ph ph-trash text-lg"></i>
                        </button>
                        <div x-show="slots.length <= 2" class="w-9 shrink-0"></div>
                    </div>
                </template>
            </div>

            <button type="button" @click="add()" class="mt-3 text-xs text-senai-600 hover:text-senai-700 font-semibold flex items-center gap-1">
                <i class="ph ph-plus-circle"></i> Adicionar outro responsável
            </button>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('alunos.index') }}"
                class="flex-1 text-center bg-white border-2 border-slate-200 text-slate-700 font-semibold py-3 rounded-xl hover:bg-slate-50 transition-colors">
                Cancelar
            </a>
            <button type="submit"
                class="flex-1 bg-gradient-to-br from-senai-600 to-senai-700 text-white font-bold py-3 rounded-xl shadow-lg shadow-senai-600/30 hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2">
                <i class="ph-fill ph-check-circle"></i> Salvar Aluno
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
