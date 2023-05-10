<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ModeloDeTractorResource\Pages;
use App\Filament\Resources\ModeloDeTractorResource\RelationManagers;
use App\Models\ModeloDeTractor;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ModeloDeTractorResource extends Resource
{
    protected static ?string $model = ModeloDeTractor::class;

    protected static ?string $modelLabel = 'Modelo de Tractor';

    protected static ?string $pluralModelLabel = 'Modelo de Tractores';

    protected static ?string $navigationGroup = 'Tractores';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('modelo_de_tractor')->required()->unique()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextInputColumn::make('modelo_de_tractor')->rules(['required','unique:modelo_de_tractors,modelo_de_tractor,except,id']),
            ])
            ->filters([
                //
            ])
            ->actions([
                //Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageModeloDeTractors::route('/'),
        ];
    }
}
