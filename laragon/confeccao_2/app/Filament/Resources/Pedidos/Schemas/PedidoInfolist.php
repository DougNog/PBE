<?php

namespace App\Filament\Resources\Pedidos\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PedidoInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Dados do Pedido')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('cliente.nome')
                            ->label('Cliente')
                            ->columnSpan(2),

                        TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->color(fn (string $state) => match($state) {
                                'pendente'    => 'warning',
                                'em_producao' => 'info',
                                'finalizado'  => 'success',
                                'cancelado'   => 'danger',
                            })
                            ->formatStateUsing(fn (string $state) => match($state) {
                                'pendente'    => 'Pendente',
                                'em_producao' => 'Em Produção',
                                'finalizado'  => 'Finalizado',
                                'cancelado'   => 'Cancelado',
                            }),

                        TextEntry::make('data_pedido')
                            ->label('Data do Pedido')
                            ->date('d/m/Y'),

                        TextEntry::make('valor_total')
                            ->label('Valor Total')
                            ->money('BRL'),

                        TextEntry::make('created_at')
                            ->label('Criado em')
                            ->dateTime('d/m/Y H:i'),
                    ]),
            ]);
    }
}