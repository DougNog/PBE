<?php

namespace App\Filament\Resources\MovimentacaoEstoque;

use App\Models\MovimentacaoEstoque;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;

class MovimentacaoEstoqueResource extends Resource
{
    protected static ?string $model = MovimentacaoEstoque::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowsRightLeft;

    protected static ?string $navigationLabel = 'Movimentações de Estoque';
    protected static ?string $modelLabel = 'Movimentação de Estoque';
    protected static ?string $pluralModelLabel = 'Movimentações de Estoque';
    public static function getNavigationGroup(): string
{
    return 'Estoque';
}
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('produto_id')
                ->label('Produto')
                ->relationship('produto', 'nome')
                ->required()
                ->searchable(),

            Select::make('tipo')
                ->label('Tipo')
                ->options([
                    'entrada' => 'Entrada',
                    'saida'   => 'Saída',
                ])
                ->required(),

            TextInput::make('quantidade')
                ->label('Quantidade')
                ->numeric()
                ->required()
                ->minValue(1),

            TextInput::make('motivo')
                ->label('Motivo')
                ->maxLength(255),

            DateTimePicker::make('data_movimentacao')
                ->label('Data/Hora')
                ->default(now())
                ->required(),

            Textarea::make('observacao')
                ->label('Observação')
                ->rows(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('produto.nome')
                ->label('Produto')
                ->searchable()
                ->sortable(),

            TextColumn::make('tipo')
                ->label('Tipo')
                ->badge()
                ->color(fn (string $state) => match ($state) {
                    'entrada' => 'success',
                    'saida'   => 'danger',
                }),

            TextColumn::make('quantidade')
                ->label('Quantidade')
                ->sortable(),

            TextColumn::make('motivo')
                ->label('Motivo')
                ->limit(40),

            TextColumn::make('data_movimentacao')
                ->label('Data/Hora')
                ->dateTime('d/m/Y H:i')
                ->sortable(),
        ])->defaultSort('data_movimentacao', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListMovimentacoesEstoque::route('/'),
            'create' => Pages\CreateMovimentacaoEstoque::route('/create'),
            'edit'   => Pages\EditMovimentacaoEstoque::route('/{record}/edit'),
        ];
    }
}