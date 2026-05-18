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
                            class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">Matrícula</label>
                            <input type="text" name="matricula" value="{{ old('matricula') }}" required
                                class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">Turma</label>
                            <input type="text" name="turma" value="{{ old('turma') }}" placeholder="Ex: 3º Ano A" required
                                class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card: responsáveis --}}
        <div class="bg-white rounded-2xl shadow-soft border border-slate-100/80 p-6"
             x-data="{ slots: 3 }">
            <h3 class="font-bold text-slate-800 mb-1 flex items-center gap-2">
                <i class="ph ph-users-three text-senai-600"></i>
                Vincular Responsáveis
            </h3>
            <p class="text-xs text-slate-500 mb-5">Selecione os responsáveis e o parentesco</p>

            <div class="space-y-3">
                <template x-for="i in slots" :key="i">
                    <div class="flex gap-3 items-center">
                        <select name="responsaveis[]"
                                class="flex-1 border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
                            <option value="">— Selecione um responsável —</option>
                            @foreach($responsaveis as $r)
                                <option value="{{ $r->id }}">{{ $r->nome }} · {{ $r->telefone }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="parentescos[]" placeholder="Parentesco" value="Responsável"
                            class="w-40 border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
                    </div>
                </template>
            </div>

            <button type="button" @click="slots++" class="mt-3 text-xs text-senai-600 hover:text-senai-700 font-semibold flex items-center gap-1">
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
