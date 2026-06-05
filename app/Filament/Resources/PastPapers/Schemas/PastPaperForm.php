<?php

namespace App\Filament\Resources\PastPapers\Schemas;

use App\Filament\Support\SchemaHelper;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PastPaperForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Past Paper Details')
                    ->description('Upload academic past papers for courses and study levels.')
                    ->columnSpan('full')
                    ->schema([
                        TextInput::make('title')
                            ->label('Title')
                            ->placeholder('e.g., Introduction to Programming - Final')
                            ->required(),

                        Select::make('course_id')
                            ->label('Course Name')
                            ->relationship('course', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        TextInput::make('unit_name')
                            ->label('Unit Name / Code')
                            ->placeholder('e.g., CSC 1101')
                            ->required(),

                        Select::make('exam_type')
                            ->label('Exam Type')
                            ->required()
                            ->options([
                                'final' => 'Final Exam',
                                'midterm' => 'Midterm Exam',
                            ]),

                        TextInput::make('exam_year')
                            ->label('Exam Year')
                            ->placeholder('e.g., 2025')
                            ->required()
                            ->numeric(),

                        TextInput::make('term')
                            ->label('Term / Semester')
                            ->placeholder('e.g., Semester 1')
                            ->nullable(),

                        SchemaHelper::pdfAttachmentUpload('file_path', 'Past Paper PDF Document', 'past-papers')
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
