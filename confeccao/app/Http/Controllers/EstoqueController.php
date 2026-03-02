<?php
namespace App\Http\Controllers;

use App\Models\Estoque;
use Illuminate\Http\Request;

class EstoqueController extends Controller
{
    public function index()
    {
        $itens = Estoque::latest()->paginate(12);
        return view('estoque.index', compact('itens'));
    }

    public function create()
    {
        return view('estoque.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome'       => ['required','string','max:255'],
            'sku'        => ['nullable','string','max:100'],
            'unidade'    => ['nullable','string','max:20'],
            'quantidade' => ['required','integer','min:0'],
            'custo'      => ['nullable','numeric','min:0'],
        ]);

        Estoque::create($data);

        return redirect()->route('estoque.index')->with('success', 'Item criado com sucesso!');
    }

    public function edit(Estoque $estoque)
    {
        return view('estoque.edit', compact('estoque'));
    }

    public function update(Request $request, Estoque $estoque)
    {
        $data = $request->validate([
            'nome'       => ['required','string','max:255'],
            'sku'        => ['nullable','string','max:100'],
            'unidade'    => ['nullable','string','max:20'],
            'quantidade' => ['required','integer','min:0'],
            'custo'      => ['nullable','numeric','min:0'],
        ]);

        $estoque->update($data);

        return redirect()->route('estoque.index')->with('success', 'Item atualizado!');
    }

    public function destroy(Estoque $estoque)
    {
        $estoque->delete();
        return redirect()->route('estoque.index')->with('success', 'Item removido!');
    }
}