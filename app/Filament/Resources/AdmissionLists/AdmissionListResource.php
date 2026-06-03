<?php

namespace App\Filament\Resources\AdmissionLists;

use App\Filament\Resources\AdmissionLists\Pages\CreateAdmissionList;
use App\Filament\Resources\AdmissionLists\Pages\EditAdmissionList;
use App\Filament\Resources\AdmissionLists\Pages\ListAdmissionLists;
use App\Filament\Resources\AdmissionLists\Pages\ViewAdmissionList;
use App\Filament\Resources\AdmissionLists\Schemas\AdmissionListForm;
use App\Filament\Resources\AdmissionLists\Schemas\AdmissionListInfolist;
use App\Filament\Resources\AdmissionLists\Tables\AdmissionListsTable;
use App\Models\AdmissionList;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AdmissionListResource extends Resource
{
    protected static ?string $model = AdmissionList::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?int $navigationSort = 11;

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
            'create' => CreateAdmissionList::route('/create'),
            'view' => ViewAdmissionList::route('/{record}'),
            'edit' => EditAdmissionList::route('/{record}/edit'),
        ];
    }
}
