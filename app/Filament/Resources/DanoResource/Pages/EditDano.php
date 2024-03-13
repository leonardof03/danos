<?php

namespace App\Filament\Resources\DanoResource\Pages;

use App\Filament\Resources\DanoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDano extends EditRecord
{
    protected static string $resource = DanoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
