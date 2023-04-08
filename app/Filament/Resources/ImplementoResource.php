<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ImplementoResource\Pages;
use App\Filament\Resources\ImplementoResource\RelationManagers;
use App\Models\Implemento;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ImplementoResource extends Resource
{
    protected static ?string $model = Implemento::class;

    protected static ?string $navigationGroup = 'Implementos';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sede.sede'),
                Tables\Columns\TextColumn::make('modelodelimplemento.modelo_de_implemento'),
                Tables\Columns\TextColumn::make('numero'),
                Tables\Columns\TextColumn::make('horas_de_uso'),
                Tables\Columns\TextColumn::make('ResponsableModel.name'),
                Tables\Columns\TextColumn::make('centrodecosto.codigo')->label("Centro de costo"),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                //Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageImplementos::route('/'),
        ];
    }
}
