<?php

namespace App\Filament\Resources\Vacancies\Schemas;

use App\Filament\Support\SchemaHelper;
use Filament\Forms\Components\DatePicker;
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
                                ->label('Job Title')
                                ->required()
                                ->maxLength(255)
                                ->placeholder('e.g., Lecturer in Cosmetology'),

                            TextInput::make('reference_number')
                                ->label('Reference Number')
                                ->required()
                                ->maxLength(100)
                                ->placeholder('e.g., TCOE/HR/2026/04'),

                            Select::make('department_id')
                                ->label('Department')
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
                    Section::make()
                        ->schema([
                            SchemaHelper::statusCard('state', 'status'),

                            Section::make('Schedule & Documents')
                                ->schema([
                                    DatePicker::make('published_at')
                                        ->label('Publish Date')
                                        ->default(now()->toDateString()),

                                    DatePicker::make('application_deadline')
                                        ->label('Application Deadline')
                                        ->required(),

                                    SchemaHelper::pdfAttachmentUpload('attachment_path', 'Job Details PDF', 'vacancies'),
                                ]),
                        ])
                        ->columnSpan(1),
                ]),
        ]);
    }
}
