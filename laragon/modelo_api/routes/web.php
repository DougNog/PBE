<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

//* Exemplo 1 - GET (Pokemon)
Route::get('/pokemon/{nome}', function ($nome) {
    $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$nome}");

    if ($response->successful()) {
        $dados = $response->json();
        return response()->json([
            'status' => 'Conectado com Sucesso!',
            'resultados' => [
                'identificador' => $dados['id'],
                'nome_do_pokemon' => ucfirst($dados['name']),
                'foto' => $dados['sprites'],['front_default']
            ]
        ], 200);
    }
    return response()->json(['erro' => 'Pokemon não Encontrado'],404);
});

//* Exemplo 2 - POST (Pokemon)
Route::post('/pokemon/novo', function (Request $request) {
    $dados = $request -> validate([
        'nome' => 'required|string|min:3',
        'tipo' => 'required|string',
        'ataque' => 'required|integer'
    ]);

    return response() -> json([
        'mensagem' => 'Pokemon Cadasrado com Sucesso!',
        'id_gerado' => rand(1000,9999),
        'dados_recebidos' => $dados
    ], 201);

});

//* Exemplo 1  - GET (User)
Route::get('/user/{id}', function ($id) {
    $response = Http::get("https://dummyjson.com/user/{$id}");

    if ($response->successful()) {
        $dados = $response->json();
        return response()->json([
            'status'=> 'Conectado com Sucesso!',
            'Resultados'=> [
                'id' => $dados['id'],
                'primeiro_nome' => ucfirst($dados['firstName']),
                'sobrenome' => $dados['lastName'],
                'email' => $dados['email'],
            ]
        ], 200);
    }
    return response()->json(['Erro'=> 'Usuario não Encontrado'],404);
});

//* Exemplo 2 - POST (User)
Route::post('/user/novo', function (Request $request) {
    $dados = $request -> validate([
        'id' => 'required|string|min:1',
        'primeiro_nome' => 'required|string',
        'sobrenome' => 'required|string',
        'email' => 'required|email'
    ]);

    return response() -> json([
        'mensagem' => 'Usuario cadastrado com Sucesso!',
        'id_gerado' => rand(1000,9999),
        'dados_recebidos' => $dados
    ], 201);

});

// Route::get('/', function () {
//     return view('welcome');
// });
