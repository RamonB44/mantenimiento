<?php

namespace App\Filament\Resources\LoteResource\Pages;

use App\Filament\Resources\LoteResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageLotes extends ManageRecords
{
    protected static string $resource = LoteResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
