<?php

namespace App\Filament\Resources\Downloads\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DownloadInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Download Information')
                    ->columnSpan('full')
                    ->schema([
                        Grid::make(3)->schema([
                            TextEntry::make('title')
                                ->label('Title')
                                ->weight('semibold'),
                            TextEntry::make('category')
                                ->label('Category')
                                ->badge(),
                            IconEntry::make('is_public')
                                ->label('Public Access')
                                ->boolean(),
                        ]),
                        TextEntry::make('description')
                            ->label('Description')
                            ->placeholder('No description provided.')
                            ->markdown()
                            ->columnSpanFull(),
                        TextEntry::make('file_path')
                            ->label('File Attachment')
                            ->url(fn ($record) => $record->file_path ? asset('storage/'.$record->file_path) : null)
                            ->openUrlInNewTab()
                            ->color('primary')
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
