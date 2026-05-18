<?php

namespace App\Http\Controllers;

use App\Events\AlunoMovimentado;
use App\Models\Aluno;
use App\Models\Movimentacao;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PortariaController extends Controller
{
    public function index(): View
    {
        $recentes = Movimentacao::with('aluno')
            ->whereDate('created_at', today())
            ->latest()
            ->limit(6)
            ->get();

        return view('portaria.index', compact('recentes'));
    }

    public function buscarJson(Request $request): JsonResponse
    {
        $q = trim($request->input('q', ''));
        if (mb_strlen($q) < 2) {
            return response()->json(['alunos' => []]);
        }

        $alunos = Aluno::where('ativo', true)
            ->where(fn ($query) => $query
                ->where('nome', 'like', "%{$q}%")
                ->orWhere('matricula', 'like', "%{$q}%")
            )
            ->with('responsaveis')
            ->limit(10)
            ->get()
            ->map(function (Aluno $aluno) {
                $aut = $aluno->autorizacaoAtiva('saida');
                return [
                    'id'                  => $aluno->id,
                    'nome'                => $aluno->nome,
                    'matricula'           => $aluno->matricula,
                    'turma'               => $aluno->turma,
                    'foto'                => $aluno->foto_path ? asset('storage/' . $aluno->foto_path) : null,
                    'iniciais'            => $this->iniciais($aluno->nome),
                    'cor'                 => $this->corGradiente($aluno->nome),
                    'responsaveis'        => $aluno->responsaveis->pluck('nome')->join(', '),
                    'tem_autorizacao'     => (bool) $aut,
                    'motivo_autorizacao'  => $aut?->motivo,
                    'url_entrada'         => route('portaria.confirmar', [$aluno, 'entrada']),
                    'url_saida'           => $aut ? route('portaria.confirmar', [$aluno, 'saida']) : null,
                ];
            });

        return response()->json(['alunos' => $alunos]);
    }

    public function confirmar(Aluno $aluno, string $tipo): View
    {
        abort_unless(in_array($tipo, ['entrada', 'saida']), 404);

        $autorizacao = $tipo === 'saida' ? $aluno->autorizacaoAtiva('saida') : null;
        $aluno->load('responsaveis');

        return view('portaria.confirmar', compact('aluno', 'tipo', 'autorizacao'));
    }

    public function registrar(Request $request, Aluno $aluno): RedirectResponse
    {
        $data = $request->validate([
            'tipo'       => 'required|in:entrada,saida',
            'observacao' => 'nullable|string|max:500',
        ]);

        $autorizacao = null;
        if ($data['tipo'] === 'saida') {
            $autorizacao = $aluno->autorizacaoAtiva('saida');
            if (! $autorizacao) {
                return back()->withErrors(['tipo' => 'Nenhuma autorização de saída ativa para este aluno.']);
            }
        }

        $movimentacao = Movimentacao::create([
            'aluno_id'       => $aluno->id,
            'autorizacao_id' => $autorizacao?->id,
            'registrado_por' => auth()->id(),
            'tipo'           => $data['tipo'],
            'observacao'     => $data['observacao'] ?? null,
        ]);

        AlunoMovimentado::dispatch($movimentacao);

        $tipoLabel = $data['tipo'] === 'saida' ? 'Saída' : 'Entrada';

        return redirect()->route('portaria.index')
            ->with('success', "{$tipoLabel} de {$aluno->nome} registrada. Responsáveis notificados.");
    }

    private function iniciais(string $nome): string
    {
        return collect(explode(' ', trim($nome)))
            ->filter()->take(2)
            ->map(fn ($w) => mb_strtoupper(mb_substr($w, 0, 1)))
            ->join('');
    }

    private function corGradiente(string $nome): string
    {
        $palette = [
            'from-pink-500 to-rose-500',
            'from-blue-500 to-indigo-600',
            'from-emerald-500 to-teal-600',
            'from-amber-500 to-orange-600',
            'from-purple-500 to-violet-600',
            'from-cyan-500 to-sky-600',
        ];
        return $palette[abs(crc32($nome)) % count($palette)];
    }
}
