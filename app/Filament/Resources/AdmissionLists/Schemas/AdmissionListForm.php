<?php

namespace App\Filament\Resources\AdmissionLists\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AdmissionListForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Admission List Details')
                ->columns(2)
                ->schema([
                    TextInput::make('title')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('e.g. First Batch Admissions'),

                    TextInput::make('academic_year')
                        ->required()
                        ->maxLength(50)
                        ->placeholder('e.g. 2025/2026'),

                    Textarea::make('description')
                        ->rows(3)
                        ->columnSpanFull()
                        ->placeholder('Optional description or notes for applicants...'),

                    FileUpload::make('pdf_file')
                        ->label('Admission List PDF')
                        ->required()
                        ->acceptedFileTypes(['application/pdf'])
                        ->disk('public')
                        ->directory('admission-lists')
                        ->maxSize(10240) // 10MB
                        ->columnSpanFull(),

                    Toggle::make('is_published')
                        ->label('Publish List')
                        ->live()
                        ->afterStateUpdated(function ($state, $set) {
                            if ($state) {
                                $set('published_at', now()->toDateTimeString());
                            } else {
                                $set('published_at', null);
                            }
                        }),

                    DateTimePicker::make('published_at')
                        ->label('Publishing Date')
                        ->readonly()
                        ->dehydrated(),
                ]),
        ]);
    }
}
