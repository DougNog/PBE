<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;

class FornecedorController extends Controller
{
    public function index()
    {
        $fornecedores = Fornecedor::latest()->paginate(15);
        return view('fornecedores.index', compact('fornecedores'));
    }

    public function create()
    {
        return view('fornecedores.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome'     => 'required|string|max:255',
            'cnpj'     => 'nullable|string|max:18',
            'telefone' => 'nullable|string|max:20',
            'email'    => 'nullable|email|max:255',
        ]);

        Fornecedor::create($data);

        return redirect()->route('fornecedores.index')
                         ->with('success', 'Fornecedor cadastrado com sucesso!');
    }

    public function show(string $id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        return view('fornecedores.show', compact('fornecedor'));
    }

    public function edit(string $id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        return view('fornecedores.edit', compact('fornecedor'));
    }

    public function update(Request $request, string $id)
    {
        $fornecedor = Fornecedor::findOrFail($id);

        $data = $request->validate([
            'nome'     => 'required|string|max:255',
            'cnpj'     => 'nullable|string|max:18',
            'telefone' => 'nullable|string|max:20',
            'email'    => 'nullable|email|max:255',
        ]);

        $fornecedor->update($data);

        return redirect()->route('fornecedores.index')
                         ->with('success', 'Fornecedor atualizado com sucesso!');
    }

    public function destroy(string $id)
    {
        Fornecedor::findOrFail($id)->delete();

        return redirect()->route('fornecedores.index')
                         ->with('success', 'Fornecedor excluído com sucesso!');
    }
}