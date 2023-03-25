<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TractorResource\Pages;
use App\Filament\Resources\TractorResource\RelationManagers;
use App\Models\Tractor;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TractorResource extends Resource
{
    protected static ?string $model = Tractor::class;

    protected static ?string $navigationGroup = 'Máquinas';

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
                Tables\Columns\TextColumn::make('ModeloDeTractor.modelo_de_tractor')->label('Modelo de Tractor'),
                Tables\Columns\TextColumn::make('numero')
            ])
            ->filters([
                //
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
            'index' => Pages\ManageTractors::route('/'),
        ];
    }
}
