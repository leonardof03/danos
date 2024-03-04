<?php

namespace App\Filament\Resources\RetomaResource\Pages;

use App\Filament\Resources\RetomaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRetoma extends EditRecord
{
    protected static string $resource = RetomaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
