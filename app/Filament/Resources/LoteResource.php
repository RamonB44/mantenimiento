<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LoteResource\Pages;
use App\Models\Cultivo;
use App\Models\Lote;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class LoteResource extends Resource
{
    protected static ?string $model = Lote::class;

    protected static ?string $navigationGroup = 'Ubicaciones';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('fundo_id')->label("Fundo")->relationship('fundo','fundo')->searchable(),
                Forms\Components\TextInput::make('lote')->unique(),
                Forms\Components\Select::make('cultivo_id')->label("Cultivo")->relationship('cultivo','cultivo')->searchable(),
                Forms\Components\Select::make('encargado')->label('Encargado')->options(User::whereHas('roles',function($q){ $q->where('name','supervisor'); })->pluck('name','id'))->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fundo.sede.sede'),
                Tables\Columns\TextColumn::make('fundo.fundo'),
                Tables\Columns\TextInputColumn::make('lote')->sortable()->rules(['required','unique:lotes,lote,except,id']),
                Tables\Columns\SelectColumn::make('encargado')->options(User::whereHas('roles',function($q){ $q->where('name','supervisor'); })->pluck('name','id'))->rules(['required']),
                Tables\Columns\SelectColumn::make('cultivo_id')->label("Cultivo")->options(Cultivo::all()->pluck('cultivo','id'))->rules(['required'])
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('cultivo_id')->label("Cultivo")->options(Cultivo::all()->pluck('cultivo','id')),
                Tables\Filters\SelectFilter::make('encargado')->options(User::whereHas('roles',function($q){ $q->where('name','supervisor'); })->pluck('name','id'))
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
            'index' => Pages\ManageLotes::route('/'),
        ];
    }
}
