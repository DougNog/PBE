<?php

namespace App\Filament\Resources\Fornecedors\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class FornecedorInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Dados do Fornecedor')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('nome')
                            ->label('Nome'),

                        TextEntry::make('empresa')
                            ->label('Empresa')
                            ->placeholder('Não informado'),

                        TextEntry::make('email')
                            ->label('E-mail')
                            ->placeholder('Não informado'),

                        TextEntry::make('telefone')
                            ->label('Telefone')
                            ->placeholder('Não informado'),

                        TextEntry::make('created_at')
                            ->label('Criado em')
                            ->dateTime('d/m/Y H:i'),
                    ]),
            ]);
    }
}