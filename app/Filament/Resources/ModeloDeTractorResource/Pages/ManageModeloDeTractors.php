<?php

namespace App\Filament\Resources\ModeloDeTractorResource\Pages;

use App\Filament\Resources\ModeloDeTractorResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageModeloDeTractors extends ManageRecords
{
    protected static string $resource = ModeloDeTractorResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
