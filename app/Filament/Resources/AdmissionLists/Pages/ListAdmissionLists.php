<?php

namespace App\Filament\Resources\AdmissionLists\Pages;

use App\Filament\Resources\AdmissionLists\AdmissionListResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAdmissionLists extends ListRecords
{
    protected static string $resource = AdmissionListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
