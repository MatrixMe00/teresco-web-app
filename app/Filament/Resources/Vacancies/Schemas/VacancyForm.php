<?php

namespace App\Filament\Resources\Vacancies\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class VacancyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make()
                ->columns(3)
                ->columnSpanFull()
                ->schema([
                    // Main Content Column (2/3 width)
                    Section::make('Vacancy Details')
                        ->schema([
                            TextInput::make('title')
                                ->required()
                                ->maxLength(255)
                                ->placeholder('e.g. Lecturer in Cosmetology'),

                            TextInput::make('reference_number')
                                ->required()
                                ->maxLength(100)
                                ->placeholder('e.g. TCOE/HR/2026/04'),

                            Select::make('department_id')
                                ->relationship('department', 'name')
                                ->required()
                                ->placeholder('Select department'),

                            RichEditor::make('description')
                                ->label('Job Description')
                                ->required()
                                ->placeholder('Provide key responsibilities, requirements, and information on how to apply...'),
                        ])
                        ->columnSpan(2),

                    // Sidebar Settings Column (1/3 width)
                    Section::make('Schedule & Settings')
                        ->schema([
                            Select::make('status')
                                ->options([
                                    'open' => 'Open',
                                    'closed' => 'Closed',
                                ])
                                ->default('open')
                                ->required(),

                            DatePicker::make('published_at')
                                ->label('Publish Date')
                                ->default(now()->toDateString()),

                            DatePicker::make('application_deadline')
                                ->label('Deadline')
                                ->required(),

                            FileUpload::make('attachment_path')
                                ->label('Details PDF Attachment')
                                ->disk('public')
                                ->directory('vacancies')
                                ->acceptedFileTypes(['application/pdf'])
                                ->maxSize(5120), // 5MB
                        ])
                        ->columnSpan(1),
                ]),
        ]);
    }
}
