<?php

namespace App\Filament\Resources\PastPapers\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PastPaperInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Past Paper Information')
                    ->columnSpan('full')
                    ->schema([
                        Grid::make(3)->schema([
                            TextEntry::make('title')
                                ->label('Title')
                                ->weight('semibold'),
                            TextEntry::make('course.name')
                                ->label('Course Name'),
                            TextEntry::make('unit_name')
                                ->label('Unit Name / Code'),
                        ]),
                        Grid::make(3)->schema([
                            TextEntry::make('exam_type')
                                ->label('Exam Type')
                                ->badge()
                                ->state(fn ($record) => ucfirst($record->exam_type)),
                            TextEntry::make('exam_year')
                                ->label('Exam Year'),
                            TextEntry::make('term')
                                ->label('Term / Semester')
                                ->placeholder('-'),
                        ]),
                        TextEntry::make('file_path')
                            ->label('PDF Document')
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
