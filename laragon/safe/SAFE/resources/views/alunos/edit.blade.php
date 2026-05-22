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

        {{-- Card: responsáveis --}}
        @php
            $slotsIniciais = $aluno->responsaveis->map(fn($r) => [
                'uid'           => 'e' . $r->id,
                'responsavelId' => (string) $r->id,
                'parentesco'    => $r->pivot->parentesco,
            ])->values();
        @endphp

        <div class="bg-white rounded-2xl shadow-soft border border-slate-100/80 p-6"
             x-data="{
                slots: @json($slotsIniciais),
                nextId: 1,
                add() { this.slots.push({ uid: 'n' + (this.nextId++), responsavelId: '', parentesco: 'Responsável' }); },
                remove(uid) { this.slots = this.slots.filter(s => s.uid !== uid); }
             }">
            <h3 class="font-bold text-slate-800 mb-1 flex items-center gap-2">
                <i class="ph ph-users-three text-senai-600"></i>
                Responsáveis Vinculados
                <span class="text-xs font-normal text-slate-400">(opcional)</span>
            </h3>
            <p class="text-xs text-slate-500 mb-5">Altere, adicione ou remova responsáveis vinculados ao aluno.</p>

            <div class="space-y-3">
                <template x-for="slot in slots" :key="slot.uid">
                    <div class="flex gap-3 items-center">
                        <select name="responsaveis[]" x-model="slot.responsavelId"
                                class="flex-1 border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
                            <option value="">— Selecione um responsável —</option>
                            @foreach($responsaveis as $r)
                                <option value="{{ $r->id }}">{{ $r->nome }} · {{ $r->telefone }}</option>
                            @endforeach
                        </select>
                        <select name="parentescos[]" x-model="slot.parentesco"
                                class="w-40 border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
                            <option value="Mãe">Mãe</option>
                            <option value="Pai">Pai</option>
                            <option value="Responsável">Responsável</option>
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
                        <button type="button" @click="remove(slot.uid)"
                                title="Remover responsável"
                                class="shrink-0 w-9 h-9 flex items-center justify-center rounded-xl text-slate-400 hover:text-red-500 hover:bg-red-50 transition-colors">
                            <i class="ph ph-trash text-lg"></i>
                        </button>
                    </div>
                </template>

                <div x-show="slots.length === 0" class="py-4 text-center text-sm text-slate-400 border border-dashed border-slate-200 rounded-xl">
                    Nenhum responsável vinculado
                </div>
            </div>

            <button type="button" @click="add()" class="mt-3 text-xs text-senai-600 hover:text-senai-700 font-semibold flex items-center gap-1">
                <i class="ph ph-plus-circle"></i> Adicionar responsável
            </button>
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
