<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estoque;

class EstoqueController extends Controller
{
    public function index()
    {
        $itens = Estoque::latest()->paginate(15);
        return view('estoque.index', compact('itens'));
    }

    public function create()
    {
        return view('estoque.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome'       => 'required|string|max:255',
            'produto'    => 'required|string|max:255',
            'quantidade' => 'required|integer|min:0',
            'custo'      => 'required|numeric|min:0',
        ]);

        Estoque::create($data);

        return redirect()->route('estoque.index')
                         ->with('success', 'Item cadastrado no estoque com sucesso!');
    }

    public function show(string $id)
    {
        $item = Estoque::findOrFail($id);
        return view('estoque.show', compact('item'));
    }

    public function edit(string $id)
    {
        $item = Estoque::findOrFail($id);
        return view('estoque.edit', compact('item'));
    }

    public function update(Request $request, string $id)
    {
        $item = Estoque::findOrFail($id);

        $data = $request->validate([
            'nome'       => 'required|string|max:255',
            'produto'    => 'required|string|max:255',
            'quantidade' => 'required|integer|min:0',
            'custo'      => 'required|numeric|min:0',
        ]);

        $item->update($data);

        return redirect()->route('estoque.index')
                         ->with('success', 'Item atualizado com sucesso!');
    }

    public function destroy(string $id)
    {
        Estoque::findOrFail($id)->delete();

        return redirect()->route('estoque.index')
                         ->with('success', 'Item excluído do estoque com sucesso!');
    }
}