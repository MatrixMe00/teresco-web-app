<?php

namespace App\Filament\Resources\PastPapers;

use App\Filament\Resources\PastPapers\Pages\ListPastPapers;
use App\Filament\Resources\PastPapers\Schemas\PastPaperForm;
use App\Filament\Resources\PastPapers\Schemas\PastPaperInfolist;
use App\Filament\Resources\PastPapers\Tables\PastPapersTable;
use App\Models\PastPaper;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PastPaperResource extends Resource
{
    protected static ?string $model = PastPaper::class;

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    protected static \UnitEnum|string|null $navigationGroup = 'Academics & Faculty';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return PastPaperForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PastPaperInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PastPapersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPastPapers::route('/'),
        ];
    }
}
