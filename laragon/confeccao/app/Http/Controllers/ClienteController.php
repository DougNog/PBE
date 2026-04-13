<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Clientes::latest()->paginate(15);
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome'      => 'required|string|max:255',
            'email'     => 'nullable|email|max:255',
            'telefone'  => 'nullable|string|max:20',
            'cpf'  => 'nullable|string|max:20',
            'ativo'     => 'boolean',
        ]);

        Clientes::create($data);

        return redirect()->route('clientes.index')
                         ->with('success', 'Cliente cadastrado com sucesso!');
    }

    public function show(string $id)
    {
        $cliente = Clientes::findOrFail($id);
        return view('clientes.show', compact('cliente'));
    }

    public function edit(string $id)
    {
        $cliente = Clientes::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, string $id)
    {
        $cliente = Clientes::findOrFail($id);

        $data = $request->validate([
            'nome'      => 'required|string|max:255',
            'email'     => 'nullable|email|max:255',
            'telefone'  => 'nullable|string|max:20',
            'cpf'  => 'nullable|string|max:20',
            'ativo'     => 'boolean',
        ]);

        $cliente->update($data);

        return redirect()->route('clientes.index')
                         ->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy(string $id)
    {
        Clientes::findOrFail($id)->delete();

        return redirect()->route('clientes.index')
                         ->with('success', 'Cliente excluído com sucesso!');
    }
}