<?php

namespace App\Filament\Resources\ItemPedidos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ItemPedidosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pedido.id')
                    ->label('Pedido #')
                    ->sortable(),

                TextColumn::make('produto.nome')
                    ->label('Produto')
                    ->searchable(),

                TextColumn::make('quantidade')
                    ->label('Qtd')
                    ->sortable(),

                TextColumn::make('preco_unitario')
                    ->label('Preço Unitário')
                    ->money('BRL')
                    ->sortable(),
            ])
            ->filters([])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}