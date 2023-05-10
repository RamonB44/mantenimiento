<?php

namespace App\Filament\Resources\ImplementoResource\Pages;

use App\Filament\Resources\ImplementoResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageImplementos extends ManageRecords
{
    protected static string $resource = ImplementoResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
