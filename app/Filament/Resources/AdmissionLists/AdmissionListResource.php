<?php

namespace App\Filament\Resources\AdmissionLists;

use App\Filament\Resources\AdmissionLists\Pages\ListAdmissionLists;
use App\Filament\Resources\AdmissionLists\Schemas\AdmissionListForm;
use App\Filament\Resources\AdmissionLists\Schemas\AdmissionListInfolist;
use App\Filament\Resources\AdmissionLists\Tables\AdmissionListsTable;
use App\Models\AdmissionList;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AdmissionListResource extends Resource
{
    protected static ?string $model = AdmissionList::class;

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    protected static ?string $recordTitleAttribute = 'title';

    protected static \UnitEnum|string|null $navigationGroup = 'Admissions & Portal';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return AdmissionListForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AdmissionListInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AdmissionListsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAdmissionLists::route('/'),
        ];
    }
}
