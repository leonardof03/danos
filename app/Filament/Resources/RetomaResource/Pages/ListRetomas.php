<?php

namespace App\Filament\Resources\RetomaResource\Pages;

use App\Filament\Resources\RetomaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRetomas extends ListRecords
{
    protected static string $resource = RetomaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
