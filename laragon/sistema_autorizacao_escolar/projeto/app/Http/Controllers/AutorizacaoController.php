<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Autorizacao;
use App\Models\Responsavel;
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

        return view('autorizacoes.create', compact('alunos', 'responsaveis'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'aluno_id'        => 'required|exists:alunos,id',
            'responsavel_id'  => 'required|exists:responsaveis,id',
            'tipo'            => 'required|in:saida,entrada,ambos',
            'motivo'          => 'required|string|max:500',
            'validade_inicio' => 'nullable|date',
            'validade_fim'    => 'nullable|date|after_or_equal:validade_inicio',
            'status'          => 'required|in:ativa,pendente_professor',
        ]);

        if ($data['status'] === 'ativa' && auth()->user()->isProfessor()) {
            $data['aprovado_por'] = auth()->id();
        }

        Autorizacao::create($data);

        return redirect()->route('autorizacoes.index')->with('success', 'Autorização criada com sucesso.');
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
