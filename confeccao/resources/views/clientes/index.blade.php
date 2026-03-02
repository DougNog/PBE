<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-900">
            Lista de Clientes
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-5xl px-4">

            @if($clientes->isEmpty())
                <div class="rounded-lg bg-yellow-50 border border-yellow-200 p-6 text-center">
                    Nenhum cliente encontrado.
                </div>
            @else
                <div class="overflow-hidden rounded-xl bg-white shadow ring-1 ring-gray-200">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-50 text-left text-gray-600">
                            <tr>
                                <th class="px-4 py-3">Nome</th>
                                <th class="px-4 py-3">CPF</th>
                                <th class="px-4 py-3">Telefone</th>
                                <th class="px-4 py-3">Reserva</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">
                            @foreach($clientes as $c)
                                <tr>
                                    <td class="px-4 py-3 font-semibold text-gray-900">
                                        {{ $c->nome }}
                                    </td>

                                    <td class="px-4 py-3">
                                        {{ $c->cpf ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3">
                                        {{ $c->telefone ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3">
                                        {{ $c->reserva ? 'Sim' : 'Não' }}
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