<?php

namespace App\Filament\Resources\Insumos\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class InsumoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Dados do Insumo')
                    ->columns(2)
                    ->schema([
                        TextInput::make('nome')
                            ->label('Nome')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(2),

                        Select::make('unidade_medida')
                            ->label('Unidade de Medida')
                            ->options([
                                'un'  => 'Unidade (un)',
                                'kg'  => 'Quilograma (kg)',
                                'g'   => 'Grama (g)',
                                'l'   => 'Litro (l)',
                                'ml'  => 'Mililitro (ml)',
                                'm'   => 'Metro (m)',
                                'cm'  => 'Centímetro (cm)',
                                'pç'  => 'Peça (pç)',
                            ])
                            ->required()
                            ->searchable(),

                        TextInput::make('preco_unitario')
                            ->label('Preço Unitário')
                            ->numeric()
                            ->prefix('R$')
                            ->minValue(0),

                        TextInput::make('estoque')
                            ->label('Estoque Atual')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->default(0),
                    ]),
            ]);
    }
}