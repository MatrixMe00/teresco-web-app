<?php

namespace App\Filament\Resources\HeroSlides\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class HeroSlideInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Hero Slide Information')
                    ->columnSpanFull()
                    ->schema([
                        ImageEntry::make('image')
                            ->label('Slide Banner Image')
                            ->disk('public')
                            ->columnSpanFull(),

                        Grid::make(2)->schema([
                            TextEntry::make('title')
                                ->label('Title / Heading')
                                ->weight('semibold'),
                            TextEntry::make('subtitle')
                                ->label('Subheading'),
                            TextEntry::make('slogan')
                                ->label('Slogan'),
                            TextEntry::make('button_text')
                                ->label('Button Text'),
                            TextEntry::make('button_link')
                                ->label('Button Link')
                                ->url(fn ($record) => $record->button_link)
                                ->openUrlInNewTab()
                                ->color('primary'),
                            TextEntry::make('created_at')
                                ->label('Created At')
                                ->dateTime(),
                        ]),
                    ]),
            ]);
    }
}
