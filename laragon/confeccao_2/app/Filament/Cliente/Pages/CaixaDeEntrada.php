<?php

namespace App\Filament\Cliente\Pages;

use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;

class CaixaDeEntrada extends Page
{
    protected string $view = 'filament.cliente.pages.caixa-de-entrada';

    protected static ?string $navigationLabel = 'Caixa de Entrada';

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedInbox;

    protected static ?string $title = 'Caixa de Entrada';

    #[Computed]
    public function notifications(): Collection
    {
        return auth()->user()
            ->notifications()
            ->latest()
            ->get();
    }

    public function markAllAsRead(): void
    {
        auth()->user()->unreadNotifications->markAsRead();
        unset($this->notifications);
    }

    public function markAsRead(string $id): void
    {
        auth()->user()->notifications()->where('id', $id)->update(['read_at' => now()]);
        unset($this->notifications);
    }
}
