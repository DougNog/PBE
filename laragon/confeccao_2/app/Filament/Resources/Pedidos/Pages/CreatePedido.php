<?php

namespace App\Filament\Resources\Pedidos\Pages;

use App\Filament\Resources\Pedidos\PedidoResource;
use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Icons\Heroicon;

class CreatePedido extends CreateRecord
{
    protected static string $resource = PedidoResource::class;

    protected function afterCreate(): void
    {
        $pedido = $this->record;
        $pedido->loadMissing('cliente.user');

        $admins = User::where('role', 'admin')->get();

        Notification::make()
            ->title('Novo pedido #' . $pedido->id . ' criado')
            ->body('Cliente: ' . ($pedido->cliente->nome ?? '') . ' — R$ ' . number_format($pedido->valor_total, 2, ',', '.'))
            ->icon(Heroicon::OutlinedShoppingCart)
            ->success()
            ->sendToDatabase($admins);

        if ($pedido->cliente?->user) {
            Notification::make()
                ->title('Seu pedido #' . $pedido->id . ' foi criado')
                ->body('Valor: R$ ' . number_format($pedido->valor_total, 2, ',', '.') . ' — Acompanhe o status pelo painel.')
                ->icon(Heroicon::OutlinedShoppingCart)
                ->success()
                ->sendToDatabase($pedido->cliente->user);
        }
    }
}
