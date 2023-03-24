<?php

namespace App\Filament\Resources\CultivoResource\Pages;

use App\Filament\Resources\CultivoResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCultivos extends ListRecords
{
    protected static string $resource = CultivoResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
