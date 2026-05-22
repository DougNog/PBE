@extends('layouts.app')
@section('title', 'Professores')
@section('subtitle', 'Gerencie os professores do sistema')

@section('content')
<div class="flex justify-end mb-5">
    <a href="{{ route('usuarios.create') }}"
       class="inline-flex items-center gap-2 bg-gradient-to-br from-senai-600 to-senai-700 text-white font-semibold px-5 py-2.5 rounded-xl shadow-senai hover:-translate-y-0.5 transition-all">
        <i class="ph-bold ph-plus"></i> Novo Professor
    </a>
</div>

<div class="bg-white rounded-2xl shadow-soft border border-slate-100/80 overflow-hidden">
    @if($professores->isEmpty())
        <div class="text-center py-16 text-slate-400">
            <i class="ph ph-chalkboard-teacher text-6xl text-slate-300"></i>
            <p class="mt-3">Nenhum professor cadastrado ainda.</p>
        </div>
    @else
    <table class="w-full text-sm">
        <thead class="bg-slate-50/80 text-slate-500 uppercase text-[10px] tracking-wider">
            <tr>
                <th class="px-5 py-3 text-left font-semibold">Professor</th>
                <th class="px-5 py-3 text-left font-semibold">E-mail</th>
                <th class="px-5 py-3 text-left font-semibold">Turmas responsáveis</th>
                <th class="px-5 py-3 text-right font-semibold">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-50">
            @foreach($professores as $prof)
            <tr class="hover:bg-slate-50/50 transition-colors">
                <td class="px-5 py-3.5">
                    <div class="flex items-center gap-3">
                        <x-avatar :nome="$prof->name" size="9" />
                        <span class="font-semibold text-slate-800">{{ $prof->name }}</span>
                    </div>
                </td>
                <td class="px-5 py-3.5 text-slate-500">{{ $prof->email }}</td>
                <td class="px-5 py-3.5">
                    @if($prof->professorTurmas->isNotEmpty())
                        <div class="flex flex-wrap gap-1.5">
                            @foreach($prof->professorTurmas as $pt)
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-senai-50 text-senai-700 text-xs font-semibold ring-1 ring-senai-200">
                                    <i class="ph ph-chalkboard"></i> {{ $pt->turma }}
                                </span>
                            @endforeach
                        </div>
                    @else
                        <span class="text-slate-400 text-xs italic">Nenhuma atribuída</span>
                    @endif
                </td>
                <td class="px-5 py-3.5">
                    <div class="flex justify-end gap-1">
                        <a href="{{ route('usuarios.edit', $prof) }}"
                           class="p-1.5 text-slate-500 hover:text-senai-600 hover:bg-senai-50 rounded-lg transition-colors" title="Editar">
                            <i class="ph ph-pencil text-lg"></i>
                        </a>
                        <form method="POST" action="{{ route('usuarios.destroy', $prof) }}"
                              id="form-del-prof-{{ $prof->id }}">
                            @csrf @method('DELETE')
                            <button type="button"
                                    @click="$store.confirmModal.show('Remover professor', 'Tem certeza que deseja remover este professor? Esta ação não pode ser desfeita.', 'form-del-prof-{{ $prof->id }}')"
                                    class="p-1.5 text-rose-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors" title="Remover">
                                <i class="ph ph-trash text-lg"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
