<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API - pokemon</title>
    <script src="Http://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-2x1 shadow-2x1 text-center w-80" >
        <h1 class="text-2x1 font-bold text-gray-800 mb-4 uppercase">
            {{ $pokemon['name']}}
        </h1>

        <div class="bg-blue-50 rounded-full p-4 mb-4">
            <img src="{{ $pokemon['sprites']['other']['official-artwork']['front_default']}}" alt="{{ $pokemon['name']}}" class="w-full h-auto">
        </div>

        <div class="flex justify-center gap-2 mb-4">
            @foreach($pokemon['types'] as $tipo)
                <span class="px-3 py-1 bg-yellow-400 text-xs font-bold rounded-full uppercase">
                    {{ $tipo['type']['name'] }}
                </span>
            @endforeach
        </div>

        <p class="text-gray-500 text-sm">
            Altura: {{ $pokemon['height']/10}} m | Peso: {{ $pokemon['weight']/10 }}kg
        </p>

        <button onclick="window.location.reload()" class="mt-6 bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg transition">
            Buscar Próximo
        </button>

    </div>

</body>
</html>