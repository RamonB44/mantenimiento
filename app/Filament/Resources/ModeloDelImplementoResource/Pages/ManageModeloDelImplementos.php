<?php

namespace App\Filament\Resources\ModeloDelImplementoResource\Pages;

use App\Filament\Resources\ModeloDelImplementoResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageModeloDelImplementos extends ManageRecords
{
    protected static string $resource = ModeloDelImplementoResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
