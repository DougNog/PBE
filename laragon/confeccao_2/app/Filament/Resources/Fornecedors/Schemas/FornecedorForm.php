<?php

namespace App\Filament\Resources\Fornecedors\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class FornecedorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Dados do Fornecedor')
                    ->columns(2)
                    ->schema([
                        TextInput::make('nome')
                            ->label('Nome')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('empresa')
                            ->label('Empresa')
                            ->maxLength(255),

                        TextInput::make('email')
                            ->label('E-mail')
                            ->email()
                            ->maxLength(255),

                        TextInput::make('telefone')
                            ->label('Telefone')
                            ->tel()
                            ->maxLength(20),
                    ]),
            ]);
    }
}