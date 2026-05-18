<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Responsavel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AlunoController extends Controller
{
    public function index(Request $request): View
    {
        $query = Aluno::with('responsaveis')->orderBy('nome');

        if ($request->filled('busca')) {
            $busca = $request->busca;
            $query->where(fn ($q) => $q
                ->where('nome', 'like', "%{$busca}%")
                ->orWhere('matricula', 'like', "%{$busca}%")
                ->orWhere('turma', 'like', "%{$busca}%")
            );
        }

        $alunos = $query->paginate(12)->withQueryString();

        return view('alunos.index', compact('alunos'));
    }

    public function create(): View
    {
        $responsaveis = Responsavel::orderBy('nome')->get();
        return view('alunos.create', compact('responsaveis'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nome'           => 'required|string|max:255',
            'matricula'      => 'required|string|max:50|unique:alunos',
            'turma'          => 'required|string|max:50',
            'foto'           => 'nullable|image|max:2048',
            'responsaveis'   => 'nullable|array',
            'responsaveis.*' => 'exists:responsaveis,id',
            'parentescos'    => 'nullable|array',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto_path'] = $request->file('foto')->store('alunos', 'public');
        }
        unset($data['foto'], $data['responsaveis'], $data['parentescos']);

        $aluno = Aluno::create($data);

        if (! empty($request->responsaveis)) {
            $pivot = [];
            foreach (array_filter($request->responsaveis) as $i => $responsavelId) {
                $pivot[$responsavelId] = ['parentesco' => $request->parentescos[$i] ?? 'Responsável'];
            }
            if ($pivot) {
                $aluno->responsaveis()->attach($pivot);
            }
        }

        return redirect()->route('alunos.index')->with('success', 'Aluno cadastrado com sucesso.');
    }

    public function edit(Aluno $aluno): View
    {
        $responsaveis = Responsavel::orderBy('nome')->get();
        $aluno->load('responsaveis');
        return view('alunos.edit', compact('aluno', 'responsaveis'));
    }

    public function update(Request $request, Aluno $aluno): RedirectResponse
    {
        $data = $request->validate([
            'nome'      => 'required|string|max:255',
            'matricula' => "required|string|max:50|unique:alunos,matricula,{$aluno->id}",
            'turma'     => 'required|string|max:50',
            'foto'      => 'nullable|image|max:2048',
            'ativo'     => 'sometimes|boolean',
        ]);

        if ($request->hasFile('foto')) {
            if ($aluno->foto_path) {
                Storage::disk('public')->delete($aluno->foto_path);
            }
            $data['foto_path'] = $request->file('foto')->store('alunos', 'public');
        }
        unset($data['foto']);

        $data['ativo'] = $request->boolean('ativo');

        $aluno->update($data);

        return redirect()->route('alunos.index')->with('success', 'Aluno atualizado com sucesso.');
    }

    public function destroy(Aluno $aluno): RedirectResponse
    {
        $aluno->update(['ativo' => false]);
        return redirect()->route('alunos.index')->with('success', 'Aluno desativado.');
    }
}
