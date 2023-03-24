<?php

namespace App\Filament\Resources\FundoResource\Pages;

use App\Filament\Resources\FundoResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFundo extends EditRecord
{
    protected static string $resource = FundoResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
