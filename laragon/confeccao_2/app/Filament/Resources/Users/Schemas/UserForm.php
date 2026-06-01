<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Dados do Usuário')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nome')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->label('E-mail')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        Select::make('role')
                            ->label('Perfil')
                            ->options([
                                'admin'      => 'Administrador',
                                'cliente'    => 'Cliente',
                                'fornecedor' => 'Fornecedor',
                            ])
                            ->required(),
                    ]),

                Section::make('Segurança')
                    ->description('Deixar em branco para manter a senha atual')
                    ->columns(2)
                    ->schema([
                        TextInput::make('password_input')
                            ->label('Nova senha')
                            ->password()
                            ->revealable()
                            ->helperText('Mínimo de 8 caracteres')
                            ->minLength(8)
                            ->nullable()
                            ->dehydrated(fn ($state) => filled($state))
                            ->columnSpan(2),
                    ]),
            ]);
    }
}
