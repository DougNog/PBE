<?php

namespace App\Filament\Resources\Pedidos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PedidosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('#')
                    ->sortable(),

                TextColumn::make('cliente.nome')
                    ->label('Cliente')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('status')
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

                TextColumn::make('valor_total')
                    ->label('Valor Total')
                    ->money('BRL')
                    ->sortable(),

                TextColumn::make('data_pedido')
                    ->label('Data')
                    ->date('d/m/Y')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pendente'    => 'Pendente',
                        'em_producao' => 'Em Produção',
                        'finalizado'  => 'Finalizado',
                        'cancelado'   => 'Cancelado',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('data_pedido', 'desc');
    }
}