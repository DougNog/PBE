<?php

namespace App\Filament\Resources\Pedidos\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PedidoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Dados do Pedido')
                    ->columns(2)
                    ->schema([
                        Select::make('cliente_id')
                            ->label('Cliente')
                            ->relationship('cliente', 'nome')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->columnSpan(2),

                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'pendente'    => 'Pendente',
                                'em_producao' => 'Em Produção',
                                'finalizado'  => 'Finalizado',
                                'cancelado'   => 'Cancelado',
                            ])
                            ->default('pendente')
                            ->required(),

                        DatePicker::make('data_pedido')
                            ->label('Data do Pedido')
                            ->displayFormat('d/m/Y')
                            ->default(now())
                            ->required(),

                        TextInput::make('valor_total')
                            ->label('Valor Total')
                            ->numeric()
                            ->prefix('R$')
                            ->default(0)
                            ->minValue(0)
                            ->columnSpan(2),
                    ]),
            ]);
    }
}