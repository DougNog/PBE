<?php

namespace App\Filament\Resources\ItemPedidos\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ItemPedidoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Dados do Item')
                    ->columns(2)
                    ->schema([
                        Select::make('pedido_id')
                            ->label('Pedido')
                            ->relationship('pedido', 'id')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->columnSpan(2),

                        Select::make('produto_id')
                            ->label('Produto')
                            ->relationship('produto', 'nome')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->columnSpan(2),

                        TextInput::make('quantidade')
                            ->label('Quantidade')
                            ->numeric()
                            ->minValue(1)
                            ->default(1)
                            ->required(),

                        TextInput::make('preco_unitario')
                            ->label('Preço Unitário')
                            ->numeric()
                            ->prefix('R$')
                            ->minValue(0)
                            ->required(),
                    ]),
            ]);
    }
}