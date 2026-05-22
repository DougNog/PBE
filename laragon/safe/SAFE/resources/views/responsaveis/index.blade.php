@extends('layouts.app')
@section('title', 'Responsáveis')
@section('subtitle', 'Cadastro de pais e responsáveis')

@section('content')

<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-slate-500">{{ $responsaveis->total() }} responsáveis cadastrados</p>
    <a href="{{ route('responsaveis.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-br from-senai-600 to-senai-700 text-white font-semibold px-5 py-2.5 rounded-xl shadow-lg shadow-senai-600/30 hover:-translate-y-0.5 transition-all">
        <i class="ph-bold ph-plus"></i>
        Novo Responsável
    </a>
</div>

@if($responsaveis->isEmpty())
    <div class="bg-white rounded-2xl p-12 text-center shadow-soft border border-slate-100/80">
        <i class="ph ph-users-three text-6xl text-slate-300"></i>
        <p class="mt-3 text-slate-500">Nenhum responsável cadastrado.</p>
    </div>
@else
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach($responsaveis as $r)
    <div class="bg-white rounded-2xl p-5 shadow-soft hover:shadow-lg border border-slate-100/80 transition-all">
        <div class="flex items-center gap-3 mb-4">
            <x-avatar :nome="$r->nome" size="12" />
            <div class="flex-1 min-w-0">
                <p class="font-bold text-slate-900 truncate">{{ $r->nome }}</p>
                <x-badge variant="brand">{{ $r->alunos_count }} {{ Str::plural('aluno', $r->alunos_count) }}</x-badge>
            </div>
        </div>

        <div class="space-y-2 text-sm mb-4">
            <p class="flex items-center gap-2 text-slate-600">
                <i class="ph ph-envelope text-slate-400"></i>
                <span class="truncate">{{ $r->email }}</span>
            </p>
            <p class="flex items-center gap-2 text-slate-600">
                <i class="ph ph-phone text-slate-400"></i>
                {{ $r->telefone }}
            </p>
        </div>

        <div class="flex gap-2 pt-3 border-t border-slate-100">
            <a href="{{ route('responsaveis.edit', $r) }}" class="flex-1 text-center bg-senai-50 hover:bg-senai-100 text-senai-700 font-semibold py-2 rounded-lg text-xs flex items-center justify-center gap-1.5">
                <i class="ph ph-pencil-simple"></i> Editar
            </a>
            <form method="POST" action="{{ route('responsaveis.destroy', $r) }}" class="flex-1"
                  id="form-del-resp-{{ $r->id }}">
                @csrf @method('DELETE')
                <button type="button"
                        @click="$store.confirmModal.show('Remover responsável', 'Tem certeza que deseja remover este responsável?', 'form-del-resp-{{ $r->id }}')"
                        class="w-full bg-rose-50 hover:bg-rose-100 text-rose-700 font-semibold py-2 rounded-lg text-xs flex items-center justify-center gap-1.5">
                    <i class="ph ph-trash"></i> Remover
                </button>
            </form>
        </div>
    </div>
    @endforeach
</div>

<div class="mt-6">{{ $responsaveis->links() }}</div>
@endif

@endsection
