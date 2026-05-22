@extends('layouts.app')
@section('title', 'Alunos')
@section('subtitle', 'Gestão de alunos cadastrados no sistema')

@section('content')

<div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
    <form method="GET" class="flex-1 max-w-md relative">
        <i class="ph ph-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
        <input type="text" name="busca" value="{{ request('busca') }}" placeholder="Buscar por nome, matrícula ou turma..."
            class="w-full pl-11 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
    </form>
    <a href="{{ route('alunos.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-br from-senai-600 to-senai-700 text-white font-semibold px-5 py-2.5 rounded-xl shadow-lg shadow-senai-600/30 hover:shadow-xl hover:-translate-y-0.5 transition-all">
        <i class="ph-bold ph-plus"></i>
        Novo Aluno
    </a>
</div>

@if($alunos->isEmpty())
    <div class="bg-white rounded-2xl p-12 text-center shadow-soft border border-slate-100/80">
        <i class="ph ph-student text-6xl text-slate-300"></i>
        <p class="mt-3 text-slate-500">Nenhum aluno encontrado.</p>
    </div>
@else
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach($alunos as $aluno)
    <div class="bg-white rounded-2xl p-5 shadow-soft hover:shadow-lg border border-slate-100/80 transition-all group">
        <div class="flex items-start gap-3 mb-4">
            <x-avatar :nome="$aluno->nome" :foto="$aluno->foto_path" size="14" />
            <div class="flex-1 min-w-0">
                <p class="font-bold text-slate-900 truncate">{{ $aluno->nome }}</p>
                <p class="text-xs text-slate-500">Mat. {{ $aluno->matricula }}</p>
                <x-badge variant="brand" class="mt-1.5">{{ $aluno->turma }}</x-badge>
            </div>
            <x-badge :variant="$aluno->ativo ? 'green' : 'gray'">
                {{ $aluno->ativo ? 'Ativo' : 'Inativo' }}
            </x-badge>
        </div>

        <div class="text-xs text-slate-500 mb-4 min-h-[36px]">
            @if($aluno->responsaveis->isNotEmpty())
                <p class="flex items-start gap-1.5">
                    <i class="ph ph-users-three text-slate-400 mt-0.5"></i>
                    <span class="line-clamp-2">{{ $aluno->responsaveis->pluck('nome')->join(', ') }}</span>
                </p>
            @else
                <p class="text-slate-400 italic flex items-center gap-1.5">
                    <i class="ph ph-warning-circle text-amber-500"></i>
                    Nenhum responsável vinculado
                </p>
            @endif
        </div>

        <div class="flex gap-2 pt-4 border-t border-slate-100">
            <a href="{{ route('alunos.edit', $aluno) }}" class="flex-1 text-center bg-senai-50 hover:bg-senai-100 text-senai-700 font-semibold py-2 rounded-lg text-xs flex items-center justify-center gap-1.5">
                <i class="ph ph-pencil-simple"></i> Editar
            </a>
            <form method="POST" action="{{ route('alunos.destroy', $aluno) }}" class="flex-1"
                  id="form-del-aluno-{{ $aluno->id }}">
                @csrf @method('DELETE')
                <button type="button"
                        @click="$store.confirmModal.show('Desativar aluno', 'Tem certeza que deseja desativar este aluno?', 'form-del-aluno-{{ $aluno->id }}')"
                        class="w-full bg-rose-50 hover:bg-rose-100 text-rose-700 font-semibold py-2 rounded-lg text-xs flex items-center justify-center gap-1.5">
                    <i class="ph ph-trash"></i> Desativar
                </button>
            </form>
        </div>
    </div>
    @endforeach
</div>

<div class="mt-6">{{ $alunos->links() }}</div>
@endif

@endsection
