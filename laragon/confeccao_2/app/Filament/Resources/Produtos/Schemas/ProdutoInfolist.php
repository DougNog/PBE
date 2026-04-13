<?php

namespace App\Filament\Resources\Produtos\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProdutoInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Dados do Produto')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('nome')
                            ->label('Nome')
                            ->columnSpan(2),

                        TextEntry::make('referencia')
                            ->label('Referência')
                            ->placeholder('Não informado'),

                        TextEntry::make('preco_venda')
                            ->label('Preço de Venda')
                            ->money('BRL')
                            ->placeholder('Não informado'),

                        TextEntry::make('estoque')
                            ->label('Estoque')
                            ->badge()
                            ->color(fn ($state) => match(true) {
                                $state <= 0  => 'danger',
                                $state <= 5  => 'warning',
                                default      => 'success',
                            })
                            ->suffix(' un'),

                        TextEntry::make('created_at')
                            ->label('Criado em')
                            ->dateTime('d/m/Y H:i'),
                    ]),
            ]);
    }
}