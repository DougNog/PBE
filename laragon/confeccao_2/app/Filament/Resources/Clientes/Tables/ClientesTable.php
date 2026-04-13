<?php

namespace App\Filament\Resources\Clientes\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ClientesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nome')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('documento')
                    ->label('CPF / CNPJ')
                    ->searchable()
                    ->placeholder('-'),

                TextColumn::make('email')
                    ->label('E-mail')
                    ->searchable()
                    ->placeholder('-'),

                TextColumn::make('telefone')
                    ->label('Telefone')
                    ->placeholder('-'),

                TextColumn::make('pedidos_count')
                    ->label('Pedidos')
                    ->counts('pedidos')
                    ->badge()
                    ->color('info'),
            ])
            ->filters([])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([])
            ->defaultSort('nome');
    }
}