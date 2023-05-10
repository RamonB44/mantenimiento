<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ModeloDelImplementoResource\Pages;
use App\Filament\Resources\ModeloDelImplementoResource\RelationManagers;
use App\Models\ModeloDelImplemento;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ModeloDelImplementoResource extends Resource
{
    protected static ?string $model = ModeloDelImplemento::class;

    protected static ?string $modelLabel = 'Modelo del Implemento';

    protected static ?string $pluralModelLabel = 'Modelo de los Implementos';

    protected static ?string $navigationGroup = 'Implementos';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('modelo_de_implemento')->required()->unique(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextInputColumn::make('modelo_de_implemento')->rules(['required','unique:modelo_del_implementos,modelo_de_implemento,except,id'])
            ])
            ->filters([
                //
            ])
            ->actions([
                //Tables\Actions\EditAction::make(),
                //Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageModeloDelImplementos::route('/'),
        ];
    }
}
