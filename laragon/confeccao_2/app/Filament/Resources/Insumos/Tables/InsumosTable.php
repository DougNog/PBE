<?php

namespace App\Filament\Resources\Insumos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;

class InsumosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nome')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('unidade_medida')
                    ->label('Unidade')
                    ->badge(),

                TextColumn::make('preco_unitario')
                    ->label('Preço Unitário')
                    ->money('BRL')
                    ->sortable(),

                TextColumn::make('estoque')
                    ->label('Estoque')
                    ->sortable()
                    ->badge()
                    ->color(fn ($state) => match(true) {
                        $state <= 0  => 'danger',
                        $state <= 10 => 'warning',
                        default      => 'success',
                    }),
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