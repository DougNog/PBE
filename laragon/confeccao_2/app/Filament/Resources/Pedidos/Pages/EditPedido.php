<?php

namespace App\Filament\Resources\Pedidos\Pages;

use App\Filament\Resources\Pedidos\PedidoResource;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Collection;

class EditPedido extends EditRecord
{
    protected static string $resource = PedidoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $pedido = $this->record;

        if (! $pedido->wasChanged('status')) {
            return;
        }

        $statusLabels = [
            'pendente'    => 'Pendente',
            'em_producao' => 'Em Produção',
            'finalizado'  => 'Finalizado',
            'cancelado'   => 'Cancelado',
        ];

        $label = $statusLabels[$pedido->status] ?? $pedido->status;

        $pedido->loadMissing('cliente.user');

        /** @var Collection<int, User> $destinatarios */
        $destinatarios = User::where('role', 'admin')->get();

        if ($pedido->cliente?->user) {
            $destinatarios->push($pedido->cliente->user);
        }

        Notification::make()
            ->title('Pedido #' . $pedido->id . ': status atualizado')
            ->body('Novo status: ' . $label . ' — ' . ($pedido->cliente->nome ?? ''))
            ->icon(Heroicon::OutlinedArrowPath)
            ->info()
            ->sendToDatabase($destinatarios->unique('id'));
    }
}
