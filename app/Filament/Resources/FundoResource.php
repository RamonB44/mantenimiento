<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FundoResource\Pages;
use App\Filament\Resources\FundoResource\RelationManagers;
use App\Models\Fundo;
use App\Models\Sede;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FundoResource extends Resource
{
    protected static ?string $model = Fundo::class;

    protected static ?string $navigationGroup = 'Ubicaciones';

    protected static ?string $navigationIcon = 'heroicon-o-home';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('sede_id')
                ->label('Sede')->options(Sede::all()->pluck('sede','id'))
                ->searchable()
                ->required(),
                Forms\Components\TextInput::make('fundo')->unique()->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sede.sede'),
                Tables\Columns\TextColumn::make('fundo')
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('sede')->relationship('sede','sede')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageFundos::route('/'),
        ];
    }
}
