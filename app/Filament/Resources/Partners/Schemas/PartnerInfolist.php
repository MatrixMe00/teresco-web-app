<?php

namespace App\Filament\Resources\Partners\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PartnerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Partner Details')
                    ->columnSpan('full')
                    ->schema([
                        Grid::make(2)->schema([
                            TextEntry::make('name')
                                ->label('Partner Name')
                                ->weight('semibold'),
                            TextEntry::make('website')
                                ->label('Website URL')
                                ->url(fn ($record) => $record->website)
                                ->openUrlInNewTab()
                                ->placeholder('No website listed'),
                        ]),
                        ImageEntry::make('logo')
                            ->label('Partner Logo')
                            ->disk('public'),
                        Grid::make(2)->schema([
                            TextEntry::make('created_at')
                                ->label('Created At')
                                ->dateTime(),
                            TextEntry::make('updated_at')
                                ->label('Last Updated')
                                ->dateTime(),
                        ]),
                    ]),
            ]);
    }
}
