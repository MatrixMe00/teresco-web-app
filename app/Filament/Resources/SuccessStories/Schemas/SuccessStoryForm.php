<?php

namespace App\Filament\Resources\SuccessStories\Schemas;

use App\Filament\Support\SchemaHelper;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SuccessStoryForm
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
                        Section::make('Student Testimonial')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Alumni Name')
                                    ->placeholder('e.g., John Doe')
                                    ->required(),

                                Select::make('department_id')
                                    ->label('Department')
                                    ->relationship('department', 'name')
                                    ->required()
                                    ->placeholder('Select department...'),

                                TextInput::make('course')
                                    ->label('Course Studied')
                                    ->placeholder('e.g., Diploma in Automotive Engineering')
                                    ->required(),

                                Textarea::make('statement')
                                    ->label('Testimonial Statement')
                                    ->placeholder('Type the success story statement here...')
                                    ->rows(5)
                                    ->required()
                                    ->columnSpanFull(),
                            ])
                            ->columnSpan(2),

                        // Sidebar Column (1/3 width)
                        Section::make('Metadata & Media')
                            ->schema([
                                SchemaHelper::featuredImageUpload('photo', 'Student Photo', 'success-stories')
                                    ->required(),

                                TextInput::make('year')
                                    ->label('Graduation Year')
                                    ->placeholder('e.g., 2024')
                                    ->required(),

                                TextInput::make('occupation')
                                    ->label('Current Job Position')
                                    ->placeholder('e.g., Mechanical Engineer')
                                    ->required(),

                                TextInput::make('company')
                                    ->label('Current Employer')
                                    ->placeholder('e.g., Toyota Kenya')
                                    ->required(),

                                TextInput::make('rating')
                                    ->label('Rating (1-5 Stars)')
                                    ->numeric()
                                    ->minValue(1)
                                    ->maxValue(5)
                                    ->default(5)
                                    ->required(),

                                Toggle::make('is_approved')
                                    ->label('Approve and Publish')
                                    ->default(false)
                                    ->required(),
                            ])
                            ->columnSpan(1),
                    ]),
            ]);
    }
}
