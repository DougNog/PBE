<?php

namespace App\Http\Controllers;

use App\Models\Movimentacao;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MovimentacaoController extends Controller
{
    public function index(Request $request): View
    {
        $query = Movimentacao::with(['aluno', 'registradoPor'])->latest();

        if ($request->filled('tipo')) {
            $query->where('tipo', $request->tipo);
        }

        if ($request->filled('data')) {
            $query->whereDate('created_at', $request->data);
        }

        if ($request->filled('aluno')) {
            $query->whereHas('aluno', fn ($q) =>
                $q->where('nome', 'like', "%{$request->aluno}%")
                  ->orWhere('matricula', 'like', "%{$request->aluno}%")
            );
        }

        $movimentacoes = $query->paginate(20)->withQueryString();

        return view('movimentacoes.index', compact('movimentacoes'));
    }
}
