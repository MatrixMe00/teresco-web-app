<?php

namespace App\Filament\Resources\AdmissionLists\Pages;

use App\Filament\Resources\AdmissionLists\AdmissionListResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAdmissionList extends ViewRecord
{
    protected static string $resource = AdmissionListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            DeleteAction::make(),
        ];
    }
}
