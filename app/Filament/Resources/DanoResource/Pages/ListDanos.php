<?php

namespace App\Filament\Resources\DanoResource\Pages;

use App\Filament\Resources\DanoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDanos extends ListRecords
{
    protected static string $resource = DanoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
