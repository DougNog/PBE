<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Autorizacao;
use App\Models\Responsavel;
use App\Models\User;
use App\Notifications\NovaAutorizacaoNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AutorizacaoController extends Controller
{
    public function index(Request $request): View
    {
        $query = Autorizacao::with(['aluno', 'responsavel', 'aprovadoPor'])->latest();

        if ($request->filled('filtro') && $request->filtro !== 'todos') {
            $query->where('status', $request->filtro);
        }

        $autorizacoes = $query->paginate(15)->withQueryString();

        return view('autorizacoes.index', compact('autorizacoes'));
    }

    public function create(): View
    {
        $alunos       = Aluno::where('ativo', true)->orderBy('nome')->get();
        $responsaveis = Responsavel::orderBy('nome')->get();
        $professores  = User::where('role', 'professor')->with('professorTurmas')->orderBy('name')->get()
            ->map(fn($p) => [
                'id'     => $p->id,
                'name'   => $p->name,
                'turmas' => $p->professorTurmas->pluck('turma')->values()->toArray(),
            ]);

        return view('autorizacoes.create', compact('alunos', 'responsaveis', 'professores'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'aluno_id'        => 'required|exists:alunos,id',
            'responsavel_id'  => 'nullable|exists:responsaveis,id',
            'professor_id'    => 'nullable|exists:users,id',
            'validade_inicio' => 'required|date',
            'motivo'          => 'required|string|max:500',
            'faltas'          => 'required|integer|min:1|max:5',
        ]);

        $horario = \Carbon\Carbon::parse($data['validade_inicio']);

        $autorizacao = Autorizacao::create([
            'aluno_id'        => $data['aluno_id'],
            'responsavel_id'  => $data['responsavel_id'] ?? null,
            'professor_id'    => $data['professor_id'] ?? null,
            'tipo'            => 'saida',
            'status'          => 'ativa',
            'motivo'          => $data['motivo'],
            'faltas'          => $data['faltas'],
            'validade_inicio' => $horario,
            'validade_fim'    => $horario->copy()->endOfDay(),
            'aprovado_por'    => auth()->id(),
        ]);

        $autorizacao->load('aluno');

        if ($data['professor_id'] ?? null) {
            User::find($data['professor_id'])->notify(new NovaAutorizacaoNotification($autorizacao));
        } else {
            User::where('role', 'professor')
                ->whereHas('professorTurmas', fn($q) => $q->where('turma', $autorizacao->aluno->turma))
                ->get()
                ->each->notify(new NovaAutorizacaoNotification($autorizacao));
        }

        return redirect()->route('autorizacoes.index')->with('success', 'Autorização de saída criada com sucesso.');
    }

    public function comprovante(Autorizacao $autorizacao): View
    {
        $autorizacao->load(['aluno', 'responsavel', 'aprovadoPor']);
        return view('autorizacoes.comprovante', compact('autorizacao'));
    }

    public function aprovar(Autorizacao $autorizacao): RedirectResponse
    {
        $autorizacao->update([
            'status'       => 'ativa',
            'aprovado_por' => auth()->id(),
        ]);

        return back()->with('success', 'Autorização aprovada.');
    }

    public function revogar(Autorizacao $autorizacao): RedirectResponse
    {
        $autorizacao->update(['status' => 'revogada']);
        return back()->with('success', 'Autorização revogada.');
    }

    public function destroy(Autorizacao $autorizacao): RedirectResponse
    {
        $autorizacao->delete();
        return redirect()->route('autorizacoes.index')->with('success', 'Autorização removida.');
    }
}
