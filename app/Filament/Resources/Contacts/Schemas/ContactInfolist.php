<?php

namespace App\Filament\Resources\Contacts\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Inquiry Details')
                    ->columnSpan('full')
                    ->schema([
                        Grid::make(3)->schema([
                            TextEntry::make('name')
                                ->label('Sender Name')
                                ->weight('semibold'),
                            TextEntry::make('email')
                                ->label('Email Address'),
                            TextEntry::make('subject')
                                ->label('Subject'),
                        ]),
                        TextEntry::make('message')
                            ->label('Message Content')
                            ->placeholder('No message body.')
                            ->markdown()
                            ->columnSpanFull(),
                        Grid::make(2)->schema([
                            TextEntry::make('created_at')
                                ->label('Received At')
                                ->dateTime(),
                            TextEntry::make('updated_at')
                                ->label('Last Update')
                                ->dateTime(),
                        ]),
                    ]),
            ]);
    }
}
