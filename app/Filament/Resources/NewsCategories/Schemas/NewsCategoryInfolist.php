<?php

namespace App\Filament\Resources\NewsCategories\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class NewsCategoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('News Category Details')
                    ->columnSpan('full')
                    ->schema([
                        Grid::make(2)->schema([
                            TextEntry::make('name')
                                ->label('Category Name')
                                ->weight('semibold'),
                            TextEntry::make('slug')
                                ->label('Slug / URL segment'),
                        ]),
                        TextEntry::make('description')
                            ->label('Description')
                            ->placeholder('No description provided.')
                            ->markdown()
                            ->columnSpanFull(),
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
