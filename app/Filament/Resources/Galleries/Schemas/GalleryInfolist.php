<?php

namespace App\Filament\Resources\Galleries\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class GalleryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Gallery Album Information')
                    ->columnSpanFull()
                    ->schema([
                        Grid::make(2)->schema([
                            TextEntry::make('name')
                                ->label('Album Name')
                                ->weight('semibold'),
                            TextEntry::make('created_at')
                                ->label('Created At')
                                ->dateTime(),
                        ]),
                        TextEntry::make('description')
                            ->label('Description')
                            ->placeholder('No description provided.')
                            ->columnSpanFull(),
                        ImageEntry::make('image')
                            ->label('Cover Photo')
                            ->disk('public')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
