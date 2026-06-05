<?php

namespace App\Filament\Resources\Applications\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ApplicationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columns(3)
                    ->columnSpanFull()
                    ->schema([
                        // Main Details Column (2/3 width)
                        Section::make('Academic & Personal Details')
                            ->schema([
                                TextInput::make('full_name')
                                    ->label('Applicant Full Name')
                                    ->placeholder('e.g., John Doe')
                                    ->required(),

                                Select::make('gender')
                                    ->label('Gender')
                                    ->required()
                                    ->options([
                                        'male' => 'Male',
                                        'female' => 'Female',
                                        'other' => 'Other',
                                    ]),

                                TextInput::make('id_number')
                                    ->label('ID / Passport / Birth Certificate Number')
                                    ->placeholder('e.g., 38294029')
                                    ->required(),

                                Select::make('course_id')
                                    ->label('Course Applied For')
                                    ->relationship('course', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required(),

                                TextInput::make('start_term')
                                    ->label('Target Intake / Term')
                                    ->placeholder('e.g., September 2026')
                                    ->required(),

                                Section::make('High School Qualifications')
                                    ->schema([
                                        TextInput::make('high_school')
                                            ->label('High School Name')
                                            ->placeholder('e.g., Alliance High School')
                                            ->required(),

                                        TextInput::make('high_school_grade')
                                            ->label('Mean Grade Obtained')
                                            ->placeholder('e.g., B+')
                                            ->required(),

                                        TextInput::make('kcse_index_number')
                                            ->label('Index Number')
                                            ->placeholder('e.g., 41209302001')
                                            ->required(),

                                        TextInput::make('kcse_year')
                                            ->label('Completion Year')
                                            ->placeholder('e.g., 2025')
                                            ->required(),

                                        TextInput::make('nemis_upi_number')
                                            ->label('NEMIS UPI Number')
                                            ->placeholder('e.g., ABC123XYZ')
                                            ->nullable(),
                                    ])
                                    ->columns(2),
                            ])
                            ->columnSpan(2),

                        // Contact & Guardian Column (1/3 width)
                        Section::make('Contact & Guardian Information')
                            ->schema([
                                TextInput::make('phone')
                                    ->label('Applicant Phone Number')
                                    ->tel()
                                    ->required(),

                                TextInput::make('alternative_phone')
                                    ->label('Alternative Phone')
                                    ->tel()
                                    ->nullable(),

                                TextInput::make('parent_name')
                                    ->label('Parent / Guardian Name')
                                    ->placeholder('e.g., Mary Doe')
                                    ->required(),

                                TextInput::make('parent_phone')
                                    ->label('Parent / Guardian Phone')
                                    ->tel()
                                    ->required(),
                            ])
                            ->columnSpan(1),
                    ]),
            ]);
    }
}
