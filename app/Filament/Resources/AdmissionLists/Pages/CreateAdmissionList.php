<?php

namespace App\Filament\Resources\AdmissionLists\Pages;

use App\Filament\Resources\AdmissionLists\AdmissionListResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAdmissionList extends CreateRecord
{
    protected static string $resource = AdmissionListResource::class;
}
