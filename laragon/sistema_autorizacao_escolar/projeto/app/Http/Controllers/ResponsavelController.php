<?php

namespace App\Http\Controllers;

use App\Models\Responsavel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ResponsavelController extends Controller
{
    public function index(): View
    {
        $responsaveis = Responsavel::withCount('alunos')->orderBy('nome')->paginate(15);
        return view('responsaveis.index', compact('responsaveis'));
    }

    public function create(): View
    {
        return view('responsaveis.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nome'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'telefone' => 'required|string|max:20',
        ]);

        Responsavel::create($data);

        return redirect()->route('responsaveis.index')->with('success', 'Responsável cadastrado com sucesso.');
    }

    public function edit(Responsavel $responsavel): View
    {
        return view('responsaveis.edit', compact('responsavel'));
    }

    public function update(Request $request, Responsavel $responsavel): RedirectResponse
    {
        $data = $request->validate([
            'nome'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'telefone' => 'required|string|max:20',
        ]);

        $responsavel->update($data);

        return redirect()->route('responsaveis.index')->with('success', 'Responsável atualizado.');
    }

    public function destroy(Responsavel $responsavel): RedirectResponse
    {
        $responsavel->delete();
        return redirect()->route('responsaveis.index')->with('success', 'Responsável removido.');
    }
}
