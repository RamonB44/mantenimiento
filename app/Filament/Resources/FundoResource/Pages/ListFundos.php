<?php

namespace App\Filament\Resources\FundoResource\Pages;

use App\Filament\Resources\FundoResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFundos extends ListRecords
{
    protected static string $resource = FundoResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
