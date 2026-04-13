<?php

namespace App\Filament\Resources\Produtos\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProdutoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Dados do Produto')
                    ->columns(2)
                    ->schema([
                        TextInput::make('nome')
                            ->label('Nome')
                            ->required()
                            ->maxLength(100)
                            ->columnSpan(2),

                        TextInput::make('referencia')
                            ->label('Referência')
                            ->maxLength(100),

                        TextInput::make('preco_venda')
                            ->label('Preço de Venda')
                            ->numeric()
                            ->prefix('R$')
                            ->minValue(0),

                        TextInput::make('estoque')
                            ->label('Estoque Atual')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->default(0)
                            ->suffix('un'),
                    ]),
            ]);
    }
}