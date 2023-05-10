<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CultivoResource\Pages;
use App\Filament\Resources\CultivoResource\RelationManagers;
use App\Models\Cultivo;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CultivoResource extends Resource
{
    protected static ?string $model = Cultivo::class;

    protected static ?string $navigationGroup = 'Ubicaciones';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('cultivo')->required()->unique()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextInputColumn::make('cultivo')->rules(['required','unique:cultivos,cultivo,except,id']),
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
            'index' => Pages\ManageCultivos::route('/'),
        ];
    }
}
