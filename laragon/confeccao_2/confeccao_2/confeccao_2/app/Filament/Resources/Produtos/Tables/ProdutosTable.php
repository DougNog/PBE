<?php

namespace App\Filament\Resources\Produtos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;

class ProdutosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nome')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('referencia')
                    ->label('Referência')
                    ->searchable()
                    ->placeholder('-'),

                TextColumn::make('preco_venda')
                    ->label('Preço de Venda')
                    ->money('BRL')
                    ->sortable(),

                TextColumn::make('estoque')
                    ->label('Estoque')
                    ->sortable()
                    ->badge()
                    ->color(fn ($state) => match(true) {
                        $state <= 0  => 'danger',
                        $state <= 5  => 'warning',
                        default      => 'success',
                    })
                    ->suffix(' un'),
            ])
            ->filters([
                Filter::make('sem_estoque')
                    ->label('Sem estoque')
                    ->query(fn ($query) => $query->where('estoque', '<=', 0)),
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
            ->defaultSort('nome');
    }
}