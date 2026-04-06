<?php

namespace App\Filament\Resources\Clientes\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ClienteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Dados do Cliente')
                    ->columns(2)
                    ->schema([
                        TextInput::make('nome')
                            ->label('Nome')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(2),

                        TextInput::make('documento')
                            ->label('CPF / CNPJ')
                            ->maxLength(20),

                        TextInput::make('telefone')
                            ->label('Telefone')
                            ->tel()
                            ->maxLength(20),

                        TextInput::make('email')
                            ->label('E-mail')
                            ->email()
                            ->maxLength(255)
                            ->columnSpan(2),
                    ]),
            ]);
    }
}