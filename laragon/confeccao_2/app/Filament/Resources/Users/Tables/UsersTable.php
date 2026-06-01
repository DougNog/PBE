<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('E-mail')
                    ->searchable(),

                TextColumn::make('role')
                    ->label('Perfil')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'admin'      => 'danger',
                        'cliente'    => 'info',
                        'fornecedor' => 'warning',
                        default      => 'gray',
                    })
                    ->formatStateUsing(fn (string $state) => match ($state) {
                        'admin'      => 'Administrador',
                        'cliente'    => 'Cliente',
                        'fornecedor' => 'Fornecedor',
                        default      => $state,
                    }),

                TextColumn::make('cliente.nome')
                    ->label('Cliente vinculado')
                    ->placeholder('-')
                    ->toggleable(),

                TextColumn::make('fornecedor.nome')
                    ->label('Fornecedor vinculado')
                    ->placeholder('-')
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([])
            ->defaultSort('name');
    }
}
