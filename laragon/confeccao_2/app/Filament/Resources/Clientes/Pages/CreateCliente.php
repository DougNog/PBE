<?php

namespace App\Filament\Resources\Clientes\Pages;

use App\Filament\Resources\Clientes\ClienteResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;

class CreateCliente extends CreateRecord
{
    protected static string $resource = ClienteResource::class;

    private ?string $senhaDefinida = null;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->senhaDefinida = $data['password_input'] ?? null;
        unset($data['password_input']);

        return $data;
    }

    protected function afterCreate(): void
    {
        if (! $this->senhaDefinida) {
            return;
        }

        $this->record->loadMissing('user');

        $this->record->user?->update([
            'password' => Hash::make($this->senhaDefinida),
        ]);
    }
}
