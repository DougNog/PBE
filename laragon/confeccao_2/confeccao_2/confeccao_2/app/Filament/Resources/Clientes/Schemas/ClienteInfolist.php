<?php

namespace App\Filament\Resources\Clientes\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ClienteInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Dados do Cliente')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('nome')
                            ->label('Nome')
                            ->columnSpan(2),

                        TextEntry::make('documento')
                            ->label('CPF / CNPJ')
                            ->placeholder('Não informado'),

                        TextEntry::make('telefone')
                            ->label('Telefone')
                            ->placeholder('Não informado'),

                        TextEntry::make('email')
                            ->label('E-mail')
                            ->placeholder('Não informado')
                            ->columnSpan(2),

                        TextEntry::make('created_at')
                            ->label('Criado em')
                            ->dateTime('d/m/Y H:i'),
                    ]),
            ]);
    }
}