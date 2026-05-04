<?php

use App\Http\Controllers\pokemon_controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Pokemon;

// Página inicial
Route::get('/', function () {
    return view('welcome');
});

// Listagem visual da Pokédex (PokeAPI)
Route::get('/pokedex', [pokemon_controller::class, 'index']);

// GET — Lista todos os Pokémons salvos no banco
Route::get('/pokemon/banco/todos', function () {
    $pokemons = Pokemon::all();
    return response()->json([
        'total'    => $pokemons->count(),
        'pokemons' => $pokemons,
    ], 200);
});

// POST — Cadastra novo Pokémon e salva no banco de dados
Route::post('/pokemon/novo', function (Request $request) {
    $dados = $request->validate([
        'nome'   => 'required|string|min:3',
        'tipo'   => 'required|string',
        'ataque' => 'required|integer',
    ]);

    $pokemon = Pokemon::create($dados);

    return response()->json([
        'mensagem'     => 'Pokemon Cadastrado com Sucesso!',
        'id_banco'     => $pokemon->id,
        'dados_salvos' => $pokemon,
    ], 201);
});

// DELETE — Remove um Pokémon do banco
Route::delete('/pokemon/deletar/{id}', function ($id) {
    $pokemon = Pokemon::find($id);
    if (!$pokemon) {
        return response()->json(['erro' => 'Pokemon não encontrado'], 404);
    }
    $pokemon->delete();
    return response()->json(['mensagem' => 'Pokemon deletado com sucesso!'], 200);
});

// GET — Busca um Pokémon pelo nome na PokeAPI (deve ficar por último pois usa {nome} dinâmico)
Route::get('/pokemon/{nome}', function ($nome) {
    $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$nome}");

    if ($response->successful()) {
        $dados = $response->json();
        return response()->json([
            'status'     => 'Conectado com Sucesso!',
            'resultados' => [
                'identificador'   => $dados['id'],
                'nome_do_pokemon' => ucfirst($dados['name']),
                'tipo'            => ucfirst($dados['types'][0]['type']['name']),
                'foto'            => $dados['sprites']['front_default'],
            ]
        ], 200);
    }

    return response()->json(['erro' => 'Pokemon não Encontrado'], 404);
});