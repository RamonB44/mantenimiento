<?php

namespace App\Filament\Resources\CultivoResource\Pages;

use App\Filament\Resources\CultivoResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCultivo extends EditRecord
{
    protected static string $resource = CultivoResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
