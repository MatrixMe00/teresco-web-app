<?php

namespace App\Filament\Resources\AdmissionLists\Pages;

use App\Filament\Resources\AdmissionLists\AdmissionListResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditAdmissionList extends EditRecord
{
    protected static string $resource = AdmissionListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
