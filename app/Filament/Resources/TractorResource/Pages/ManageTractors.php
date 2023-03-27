<?php

namespace App\Filament\Resources\TractorResource\Pages;

use App\Filament\Resources\TractorResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTractors extends ManageRecords
{
    protected static string $resource = TractorResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
