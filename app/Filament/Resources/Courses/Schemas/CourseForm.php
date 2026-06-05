<?php

namespace App\Filament\Resources\Courses\Schemas;

use App\Filament\Support\SchemaHelper;
use App\Models\Department;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CourseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columns(3)
                    ->columnSpanFull()
                    ->schema([
                        // Main Column (2/3 width)
                        Section::make('Course Specifications')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Course Name')
                                    ->placeholder('e.g., Diploma in Information Technology')
                                    ->required(),

                                Select::make('department_id')
                                    ->label('Department')
                                    ->options(fn () => Department::pluck('name', 'id'))
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->placeholder('Select department...'),

                                RichEditor::make('requirement')
                                    ->label('Admission Requirements')
                                    ->placeholder('e.g., KCSE Mean Grade C- or equivalent details...')
                                    ->required(),
                            ])
                            ->columnSpan(2),

                        // Sidebar Column (1/3 width)
                        Section::make('Metadata & Media')
                            ->schema([
                                TextInput::make('duration')
                                    ->label('Duration')
                                    ->placeholder('e.g., 2 Years, 4 Semesters')
                                    ->required(),

                                TextInput::make('exam_body')
                                    ->label('Examining Body')
                                    ->placeholder('e.g., KNEC, KASNEB')
                                    ->required(),

                                SchemaHelper::featuredImageUpload('photo', 'Course Cover Image', 'courses'),
                            ])
                            ->columnSpan(1),
                    ]),
            ]);
    }
}
