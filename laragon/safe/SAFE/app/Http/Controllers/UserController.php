<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $professores = User::where('role', 'professor')->with('professorTurmas')->orderBy('name')->get();
        return view('usuarios.index', compact('professores'));
    }

    public function create(): View
    {
        $turmasExistentes = \App\Models\Aluno::distinct()->orderBy('turma')->pluck('turma');
        return view('usuarios.create', compact('turmasExistentes'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'turmas'   => 'nullable|array',
            'turmas.*' => 'string|max:50',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'role'     => 'professor',
            'password' => Hash::make($data['password']),
        ]);

        $user->syncTurmas($data['turmas'] ?? []);

        return redirect()->route('usuarios.index')->with('success', 'Professor cadastrado com sucesso.');
    }

    public function edit(User $usuario): View
    {
        abort_unless($usuario->isProfessor(), 403);
        $usuario->load('professorTurmas');
        $turmasExistentes = \App\Models\Aluno::distinct()->orderBy('turma')->pluck('turma');
        return view('usuarios.edit', compact('usuario', 'turmasExistentes'));
    }

    public function update(Request $request, User $usuario): RedirectResponse
    {
        abort_unless($usuario->isProfessor(), 403);

        $data = $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => "required|email|unique:users,email,{$usuario->id}",
            'turmas'   => 'nullable|array',
            'turmas.*' => 'string|max:50',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $usuario->update([
            'name'  => $data['name'],
            'email' => $data['email'],
        ]);

        $usuario->syncTurmas($data['turmas'] ?? []);

        if (!empty($data['password'])) {
            $usuario->update(['password' => Hash::make($data['password'])]);
        }

        return redirect()->route('usuarios.index')->with('success', 'Professor atualizado com sucesso.');
    }

    public function destroy(User $usuario): RedirectResponse
    {
        abort_unless($usuario->isProfessor(), 403);
        $usuario->delete();
        return redirect()->route('usuarios.index')->with('success', 'Professor removido.');
    }
}
