<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

//* BUSCA ALEATORIA
// class pokemon_controller extends Controller
// {
//     public function index()
//     {
//         $id = rand(1, 1000);
//         $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$id}");

//         if ($response->successful()) {
//             $pokemon = $response->json();

//             return view('pokemon', compact('pokemon'));
//         }

//         return "Erro ao buscar dados da API.";
//     }
// }

//* BUSCA POR NOME
class pokemon_controller extends Controller
{
    public function index(Request $request)
    {
        $busca = $request -> input('pokemon') ?? rand(1,151);
        $nome_ou_id = strtolower($busca);
        $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$nome_ou_id}");

        if ($response->successful()) {
            $pokemon = $response->json();

            return view('pokemon', compact('pokemon'));
        }

        return back() -> with('Erro', "Pokemon não encontrado! Tente outro");
    }
}