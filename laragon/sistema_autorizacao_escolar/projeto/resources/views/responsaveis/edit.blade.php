@extends('layouts.app')
@section('title', 'Editar Responsável')
@section('subtitle', $responsavel->nome)

@section('content')
<div class="max-w-lg mx-auto">
    <form method="POST" action="{{ route('responsaveis.update', $responsavel) }}" class="space-y-4">
        @csrf @method('PUT')

        <div class="bg-white rounded-2xl shadow-soft border border-slate-100/80 p-6 space-y-4">
            <div class="flex justify-center mb-2">
                <x-avatar :nome="$responsavel->nome" size="20" />
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">Nome</label>
                <input type="text" name="nome" value="{{ old('nome', $responsavel->nome) }}" required
                    class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">E-mail</label>
                <input type="email" name="email" value="{{ old('email', $responsavel->email) }}" required
                    class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">Telefone</label>
                <input type="text" name="telefone" value="{{ old('telefone', $responsavel->telefone) }}" required
                    class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
            </div>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('responsaveis.index') }}"
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
