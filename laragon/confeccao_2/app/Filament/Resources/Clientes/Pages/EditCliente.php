<?php

namespace App\Filament\Resources\Clientes\Pages;

use App\Filament\Resources\Clientes\ClienteResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Hash;

class EditCliente extends EditRecord
{
    protected static string $resource = ClienteResource::class;

    private ?string $novaSenha = null;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->novaSenha = $data['password_input'] ?? null;
        unset($data['password_input']);

        return $data;
    }

    protected function afterSave(): void
    {
        if (! $this->novaSenha) {
            return;
        }

        $this->record->load('user');

        $this->record->user?->update([
            'password' => Hash::make($this->novaSenha),
        ]);
    }
}
