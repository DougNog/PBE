<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-900">
            Estoque
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-5xl px-4">

            @if($itens->isEmpty())
                <div class="rounded-lg bg-yellow-50 border p-6 text-center">
                    Nenhum item no estoque.
                </div>
            @else
                <div class="bg-white rounded-xl shadow ring-1 ring-gray-200 overflow-hidden">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-50 text-left">
                            <tr>
                                <th class="px-4 py-3">Nome</th>
                                <th class="px-4 py-3">SKU</th>
                                <th class="px-4 py-3">Unidade</th>
                                <th class="px-4 py-3">Quantidade</th>
                                <th class="px-4 py-3">Custo</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach($itens as $i)
                                <tr>
                                    <td class="px-4 py-3 font-semibold">{{ $i->nome }}</td>
                                    <td class="px-4 py-3">{{ $i->sku ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $i->unidade ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $i->quantidade }}</td>
                                    <td class="px-4 py-3">
                                        {{ number_format($i->custo, 2, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>