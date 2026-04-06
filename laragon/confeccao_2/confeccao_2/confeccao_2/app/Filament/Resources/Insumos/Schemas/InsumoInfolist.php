<?php

namespace App\Filament\Resources\Insumos\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class InsumoInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Dados do Insumo')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('nome')
                            ->label('Nome')
                            ->columnSpan(2),

                        TextEntry::make('unidade_medida')
                            ->label('Unidade de Medida')
                            ->badge(),

                        TextEntry::make('preco_unitario')
                            ->label('Preço Unitário')
                            ->money('BRL')
                            ->placeholder('Não informado'),

                        TextEntry::make('estoque')
                            ->label('Estoque')
                            ->badge()
                            ->color(fn ($state) => match(true) {
                                $state <= 0  => 'danger',
                                $state <= 10 => 'warning',
                                default      => 'success',
                            }),

                        TextEntry::make('created_at')
                            ->label('Criado em')
                            ->dateTime('d/m/Y H:i'),
                    ]),
            ]);
    }
}