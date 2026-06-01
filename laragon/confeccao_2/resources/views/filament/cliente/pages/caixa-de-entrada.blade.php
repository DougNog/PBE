<x-filament-panels::page>
    @php
        $notificacoes = $this->notifications;
        $naoLidas = $notificacoes->whereNull('read_at')->count();
    @endphp

    <div class="space-y-4">

        {{-- Cabeçalho --}}
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="text-sm text-gray-500 dark:text-gray-400">
                    {{ $notificacoes->count() }} mensagem(s)
                </span>
                @if($naoLidas > 0)
                    <span class="inline-flex items-center rounded-full bg-primary-100 px-2.5 py-0.5 text-xs font-medium text-primary-800 dark:bg-primary-900 dark:text-primary-200">
                        {{ $naoLidas }} não lida(s)
                    </span>
                @endif
            </div>

            @if($naoLidas > 0)
                <button
                    wire:click="markAllAsRead"
                    class="text-sm text-primary-600 hover:text-primary-500 dark:text-primary-400 font-medium"
                >
                    Marcar todas como lidas
                </button>
            @endif
        </div>

        {{-- Lista --}}
        @forelse($notificacoes as $notification)
            @php
                $data     = $notification->data;
                $isUnread = is_null($notification->read_at);
                $status   = $data['status'] ?? $data['iconColor'] ?? 'gray';
            @endphp

            <div class="rounded-xl border p-4 transition-colors {{ $isUnread
                ? 'border-primary-200 bg-primary-50 dark:border-primary-800 dark:bg-primary-950/40'
                : 'border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800' }}">

                <div class="flex items-start gap-4">

                    {{-- Ícone de status --}}
                    <div style="margin-top:0.125rem;flex-shrink:0;">
                        @if($status === 'success')
                            <div style="display:flex;width:2rem;height:2rem;align-items:center;justify-content:center;border-radius:9999px;background-color:rgb(220 252 231);">
                                <x-heroicon-o-check-circle style="width:1.25rem;height:1.25rem;flex-shrink:0;color:rgb(22 163 74);" />
                            </div>
                        @elseif($status === 'info')
                            <div style="display:flex;width:2rem;height:2rem;align-items:center;justify-content:center;border-radius:9999px;background-color:rgb(224 242 254);">
                                <x-heroicon-o-information-circle style="width:1.25rem;height:1.25rem;flex-shrink:0;color:rgb(2 132 199);" />
                            </div>
                        @elseif($status === 'warning')
                            <div style="display:flex;width:2rem;height:2rem;align-items:center;justify-content:center;border-radius:9999px;background-color:rgb(254 249 195);">
                                <x-heroicon-o-exclamation-triangle style="width:1.25rem;height:1.25rem;flex-shrink:0;color:rgb(202 138 4);" />
                            </div>
                        @else
                            <div style="display:flex;width:2rem;height:2rem;align-items:center;justify-content:center;border-radius:9999px;background-color:rgb(243 244 246);">
                                <x-heroicon-o-bell style="width:1.25rem;height:1.25rem;flex-shrink:0;color:rgb(107 114 128);" />
                            </div>
                        @endif
                    </div>

                    {{-- Conteúdo --}}
                    <div class="min-w-0 flex-1">
                        <div class="flex items-start justify-between gap-2">
                            <p class="text-sm font-semibold {{ $isUnread ? 'text-gray-900 dark:text-white' : 'text-gray-700 dark:text-gray-300' }}">
                                {{ $data['title'] ?? 'Notificação' }}
                            </p>
                            <span class="flex-shrink-0 text-xs text-gray-400 dark:text-gray-500">
                                {{ $notification->created_at->diffForHumans() }}
                            </span>
                        </div>

                        @if(!empty($data['body']))
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ $data['body'] }}
                            </p>
                        @endif

                        @if($isUnread)
                            <button
                                wire:click="markAsRead('{{ $notification->id }}')"
                                class="mt-2 text-xs text-primary-600 hover:text-primary-500 dark:text-primary-400"
                            >
                                Marcar como lida
                            </button>
                        @endif
                    </div>

                    {{-- Ponto indicador de não lido --}}
                    @if($isUnread)
                        <div style="margin-top:0.5rem;flex-shrink:0;">
                            <span class="inline-block h-2 w-2 rounded-full bg-primary-500"></span>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="rounded-xl border border-gray-200 bg-white p-12 text-center dark:border-gray-700 dark:bg-gray-800">
                <div style="margin:0 auto;width:3rem;height:3rem;">
                    <x-heroicon-o-inbox style="width:3rem;height:3rem;color:rgb(209 213 219);" />
                </div>
                <p class="mt-4 text-sm font-medium text-gray-500 dark:text-gray-400">Nenhuma notificação ainda</p>
                <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">Você será avisado quando houver novidades no seu pedido.</p>
            </div>
        @endforelse

    </div>
</x-filament-panels::page>
