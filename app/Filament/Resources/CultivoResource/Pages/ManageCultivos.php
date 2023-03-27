<?php

namespace App\Filament\Resources\CultivoResource\Pages;

use App\Filament\Resources\CultivoResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCultivos extends ManageRecords
{
    protected static string $resource = CultivoResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
