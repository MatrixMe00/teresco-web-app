<?php

namespace App\Filament\Resources\Departments\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DepartmentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columns(3)
                    ->columnSpanFull()
                    ->schema([
                        // Main Column (2/3 width)
                        Section::make('Department Specifications')
                            ->schema([
                                Grid::make(2)->schema([
                                    TextEntry::make('name')
                                        ->label('Department Name')
                                        ->weight('semibold'),
                                    TextEntry::make('slug')
                                        ->label('Slug'),
                                ]),

                                TextEntry::make('short_desc')
                                    ->label('Short Summary')
                                    ->columnSpanFull(),

                                TextEntry::make('full_desc')
                                    ->label('Full Description')
                                    ->markdown()
                                    ->columnSpanFull(),
                            ])
                            ->columnSpan(2),

                        // Sidebar Column (1/3 width)
                        Section::make('Department Imagery & Metadata')
                            ->schema([
                                ImageEntry::make('photo')
                                    ->label('Thumbnail / Photo')
                                    ->disk('public')
                                    ->circular(),

                                ImageEntry::make('banner_pic')
                                    ->label('Banner Photo')
                                    ->disk('public'),

                                TextEntry::make('created_at')
                                    ->label('Created At')
                                    ->dateTime(),

                                TextEntry::make('updated_at')
                                    ->label('Last Updated')
                                    ->dateTime(),
                            ])
                            ->columnSpan(1),
                    ]),
            ]);
    }
}
