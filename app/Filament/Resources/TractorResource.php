<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TractorResource\Pages;
use App\Filament\Resources\TractorResource\RelationManagers;
use App\Models\Tractor;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rules\Unique;
use Closure;

class TractorResource extends Resource
{
    protected static ?string $model = Tractor::class;

    protected static ?string $pluralModelLabel = 'Tractores';

    protected static ?string $navigationGroup = 'Tractores';

    protected static ?string $navigationIcon = 'heroicon-o-collection';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([Forms\Components\Select::make('sede_id')->relationship('sede','sede')->label("Sede")->reactive(),
                Forms\Components\Select::make('modelo_de_tractor_id')->relationship('modelodetractor','modelo_de_tractor')->searchable()->label("Modelo de Tractor")->reactive(),
                Forms\Components\TextInput::make('numero')->required()->unique(callback: function (Unique $rule,$get){
                    return $rule->where('modelo_de_tractor_id',$get('modelo_de_tractor_id'))->where('sede_id',$get('sede_id'))->where('numero',$get('numero'));
                })->reactive(),
                Forms\Components\TextInput::make('horometro')->label("Horómetro")->numeric()->required()->default(0),
                Forms\Components\Select::make('supervisor')->label('Supervisor')->options(User::whereHas('roles',function($q){ $q->where('name','supervisor'); })->pluck('name','id'))->searchable()->required(),
                Forms\Components\Select::make('fundo_id')->label("Fundo")->relationship('fundo','fundo')->searchable(),
                Forms\Components\Select::make('cultivo_id')->label("Cultivo")->relationship('cultivo','cultivo')->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sede.sede')->label('Sede'),
                Tables\Columns\TextColumn::make('modelodetractor.modelo_de_tractor')->label('Modelo de Tractor'),
                Tables\Columns\TextColumn::make('numero'),
                Tables\Columns\TextColumn::make('horometro'),
                Tables\Columns\TextColumn::make('supervisormodel.name')->label('Supervisor'),
                Tables\Columns\TextColumn::make('fundo.fundo')->label('Fundo'),
                Tables\Columns\TextColumn::make('cultivo.cultivo')->label('Cultivo'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('sede')->relationship('sede','sede'),
                Tables\Filters\SelectFilter::make('modelo_de_tractor')->relationship('modelodetractor','modelo_de_tractor'),
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
            'index' => Pages\ManageTractors::route('/'),
        ];
    }
}
