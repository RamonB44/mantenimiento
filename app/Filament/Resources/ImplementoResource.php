<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ImplementoResource\Pages;
use App\Filament\Resources\ImplementoResource\RelationManagers;
use App\Models\CentroDeCosto;
use App\Models\Implemento;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rules\Unique;

class ImplementoResource extends Resource
{
    protected static ?string $model = Implemento::class;

    protected static ?string $navigationGroup = 'Implementos';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('sede_id')->relationship('sede','sede')->required(),
                Forms\Components\Select::make("modelo_de_implemento_id")->relationship('ModeloDelImplemento','modelo_de_implemento')->searchable()->required()->reactive(),
                Forms\Components\TextInput::make('numero')->required()->unique(callback: function (Unique $rule,$get){
                    return $rule->where('modelo_de_implemento_id',$get('modelo_de_implemento_id'))->where('sede_id',$get('sede_id'))->where('numero',$get('numero'));
                }),
                Forms\Components\TextInput::make('horas_de_us')->numeric()->required()->default(0),
                Forms\Components\Select::make('responsable')->options(User::whereHas('roles',function($q){ $q->where('name','operario'); })->pluck('name','id'))->required(),
                Forms\Components\Select::make('centro_de_costo_id')->options(CentroDeCosto::all()->pluck('codigo', 'id'))->required(),
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
