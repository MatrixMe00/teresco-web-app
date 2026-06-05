<?php

namespace App\Filament\Resources\AdmissionLists\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AdmissionListInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Admission List Information')
                ->columnSpan('full')
                ->schema([
                    Grid::make(3)->schema([
                        TextEntry::make('title')
                            ->label('Title')
                            ->weight('semibold'),
                        TextEntry::make('academic_year')
                            ->label('Academic Year'),
                        IconEntry::make('is_published')
                            ->label('Published')
                            ->boolean(),
                    ]),
                    TextEntry::make('description')
                        ->label('Description')
                        ->placeholder('No description provided.')
                        ->markdown()
                        ->columnSpanFull(),
                    TextEntry::make('pdf_file')
                        ->label('PDF File Link')
                        ->url(fn ($record) => $record->pdf_file ? asset('storage/'.$record->pdf_file) : null)
                        ->openUrlInNewTab()
                        ->color('primary')
                        ->columnSpanFull(),
                    Grid::make(3)->schema([
                        TextEntry::make('published_at')
                            ->label('Published At')
                            ->dateTime()
                            ->placeholder('Not published yet'),
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
