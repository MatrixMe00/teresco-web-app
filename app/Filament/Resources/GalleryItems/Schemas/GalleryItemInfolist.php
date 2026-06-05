<?php

namespace App\Filament\Resources\GalleryItems\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class GalleryItemInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Gallery Item Details')
                    ->columnSpan('full')
                    ->schema([
                        Grid::make(3)->schema([
                            TextEntry::make('gallery.name')
                                ->label('Gallery Album')
                                ->weight('semibold'),
                            TextEntry::make('name')
                                ->label('Caption Name'),
                            TextEntry::make('category')
                                ->label('Category Tag')
                                ->badge()
                                ->placeholder('No tag'),
                        ]),
                        TextEntry::make('description')
                            ->label('Description')
                            ->placeholder('No description provided.')
                            ->markdown()
                            ->columnSpanFull(),
                        ImageEntry::make('image')
                            ->label('Photo Preview')
                            ->disk('public')
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
