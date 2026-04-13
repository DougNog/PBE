<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::latest()->paginate(15);
        return view('pedidos.index', compact('pedidos'));
    }

    public function create()
    {
        return view('pedidos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'numero'     => 'required|string|max:50',
            'data'       => 'required|date',
            'status'     => 'required|in:aberto,em_producao,entregue,cancelado',
            'observacao' => 'nullable|string|max:256',
        ]);

        Pedido::create($data);

        return redirect()->route('pedidos.index')
                         ->with('success', 'Pedido criado com sucesso!');
    }

    public function show(string $id)
    {
        $pedido = Pedido::findOrFail($id);
        return view('pedidos.show', compact('pedido'));
    }

    public function edit(string $id)
    {
        $pedido = Pedido::findOrFail($id);
        return view('pedidos.edit', compact('pedido'));
    }

    public function update(Request $request, string $id)
    {
        $pedido = Pedido::findOrFail($id);

        $data = $request->validate([
            'numero'     => 'required|string|max:50',
            'data'       => 'required|date',
            'status'     => 'required|in:aberto,em_producao,entregue,cancelado',
            'observacao' => 'nullable|string|max:256',
        ]);

        $pedido->update($data);

        return redirect()->route('pedidos.index')
                         ->with('success', 'Pedido atualizado com sucesso!');
    }

    public function destroy(string $id)
    {
        Pedido::findOrFail($id)->delete();

        return redirect()->route('pedidos.index')
                         ->with('success', 'Pedido excluído com sucesso!');
    }
}