@extends('layouts.app')
@section('title', 'Nova Autorização de Saída')
@section('subtitle', 'Preencha os dados do aluno que sairá antecipadamente')

@section('content')
<div class="max-w-2xl mx-auto">
    <form method="POST" action="{{ route('autorizacoes.store') }}" class="space-y-5"
          x-data="formAutorizacao()">
        @csrf

        {{-- Card: aluno --}}
        <div class="bg-white rounded-2xl shadow-soft border border-slate-100/80 p-6">
            <h3 class="font-bold text-slate-800 mb-1 flex items-center gap-2">
                <i class="ph ph-student text-senai-600"></i>
                Dados do Aluno
            </h3>
            <p class="text-xs text-slate-500 mb-5">Selecione o aluno — turma e matrícula são preenchidos automaticamente</p>

            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">Aluno</label>
                    <select name="aluno_id" required @change="selecionarAluno($event.target.value)"
                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
                        <option value="">— Selecione o aluno —</option>
                        @foreach($alunos as $aluno)
                        <option value="{{ $aluno->id }}" {{ old('aluno_id') == $aluno->id ? 'selected' : '' }}>
                            {{ $aluno->nome }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">Turma</label>
                        <input type="text" :value="turma" readonly placeholder="Selecionado automaticamente"
                            class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm bg-slate-50 text-slate-500 cursor-not-allowed focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">Matrícula</label>
                        <input type="text" :value="matricula" readonly placeholder="Selecionado automaticamente"
                            class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm bg-slate-50 text-slate-500 cursor-not-allowed focus:outline-none">
                    </div>
                </div>
            </div>
        </div>

        {{-- Card: autorização --}}
        <div class="bg-white rounded-2xl shadow-soft border border-slate-100/80 p-6">
            <h3 class="font-bold text-slate-800 mb-1 flex items-center gap-2">
                <i class="ph ph-seal-check text-senai-600"></i>
                Dados da Saída
            </h3>
            <p class="text-xs text-slate-500 mb-5">Horário, motivo e quantidade de faltas</p>

            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">Horário de saída</label>
                        <input type="datetime-local" name="validade_inicio" value="{{ old('validade_inicio') }}" required
                            class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">
                            Faltas a receber
                        </label>
                        <select name="faltas" required
                            class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
                            @foreach(range(1, 5) as $n)
                                <option value="{{ $n }}" {{ old('faltas', 1) == $n ? 'selected' : '' }}>{{ $n }} {{ $n === 1 ? 'falta' : 'faltas' }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">Motivo</label>
                    <textarea name="motivo" rows="2" required placeholder="Ex: Consulta médica, compromisso familiar..."
                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500 resize-none">{{ old('motivo') }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">
                        Professor a notificar
                        <span class="font-normal text-slate-400 normal-case">(selecione o aluno primeiro)</span>
                    </label>
                    <select name="professor_id"
                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500 disabled:bg-slate-50 disabled:text-slate-400 disabled:cursor-not-allowed"
                        :disabled="professoresFiltrados.length === 0">
                        <option value="">— Notificar todos da turma —</option>
                        <template x-for="p in professoresFiltrados" :key="p.id">
                            <option :value="p.id" :selected="p.id == {{ old('professor_id', 'null') }}" x-text="p.name"></option>
                        </template>
                    </select>
                    <p class="text-xs text-slate-400 mt-1" x-show="professoresFiltrados.length === 0 && turma !== ''">
                        Nenhum professor cadastrado para a turma <span x-text="turma" class="font-semibold"></span>.
                    </p>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">
                        Responsável autorizante
                        <span class="font-normal text-slate-400 normal-case">(obrigatório para menores de idade)</span>
                    </label>
                    <select name="responsavel_id"
                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500">
                        <option value="">— Não informado —</option>
                        @foreach($responsaveis as $r)
                        <option value="{{ $r->id }}" {{ old('responsavel_id') == $r->id ? 'selected' : '' }}>
                            {{ $r->nome }} · {{ $r->telefone }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('autorizacoes.index') }}"
                class="flex-1 text-center bg-white border-2 border-slate-200 text-slate-700 font-semibold py-3 rounded-xl hover:bg-slate-50 transition-colors">
                Cancelar
            </a>
            <button type="submit"
                class="flex-1 bg-gradient-to-br from-senai-600 to-senai-700 text-white font-bold py-3 rounded-xl shadow-lg shadow-senai-600/30 hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2">
                <i class="ph-fill ph-check-circle"></i> Gerar Autorização
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
function formAutorizacao() {
    return {
        alunos: @json($alunos->map(fn($a) => ['id' => $a->id, 'turma' => $a->turma, 'matricula' => $a->matricula])),
        todosProfessores: @json($professores),
        turma: '',
        matricula: '',
        professoresFiltrados: [],
        selecionarAluno(id) {
            const a = this.alunos.find(a => a.id == id);
            this.turma = a ? a.turma : '';
            this.matricula = a ? a.matricula : '';
            this.professoresFiltrados = a
                ? this.todosProfessores.filter(p => p.turmas.includes(a.turma))
                : [];
        }
    };
}
</script>
@endpush
