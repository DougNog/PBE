<?php

namespace App\Filament\Resources\ItemPedidos\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ItemPedidoInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Dados do Item')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('pedido.id')
                            ->label('Pedido #'),

                        TextEntry::make('produto.nome')
                            ->label('Produto'),

                        TextEntry::make('quantidade')
                            ->label('Quantidade'),

                        TextEntry::make('preco_unitario')
                            ->label('Preço Unitário')
                            ->money('BRL'),

                        TextEntry::make('created_at')
                            ->label('Criado em')
                            ->dateTime('d/m/Y H:i'),
                    ]),
            ]);
    }
}