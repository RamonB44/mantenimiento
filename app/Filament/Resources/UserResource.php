<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Sede;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('sede_id')->label('Sede')->options(Sede::all()->pluck('sede','id'))->searchable()
                    ->required(),
                Forms\Components\Select::make('supervisor')->options(User::whereHas('roles',function($q){ $q->where('name','supervisor'); })->get()->pluck('name','id'))->searchable(),
                Forms\Components\TextInput::make('codigo')
                    ->required()
                    ->maxLength(6),
                Forms\Components\TextInput::make('dni')
                    ->required()
                    ->maxLength(12),
                Forms\Components\TextInput::make('name')->label('Nombre')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_active')->label('¿Está activo?')
                    ->required(),
                Forms\Components\Toggle::make('is_admin')->label('¿Es administrador?')
                    ->required(),
                Forms\Components\TextInput::make('profile_photo_path')->label('Foto de Perfil')
                    ->maxLength(2048),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sede.sede'),
                Tables\Columns\TextColumn::make('supervisormodel.name')->label('Supervisor'),
                Tables\Columns\TextColumn::make('codigo'),
                Tables\Columns\TextColumn::make('dni'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\IconColumn::make('is_active')->label('¿Activo?')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_admin')->label('¿Admin?')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
