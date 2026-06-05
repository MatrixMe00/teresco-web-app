<?php

namespace App\Filament\Resources\Departments\Schemas;

use App\Filament\Support\SchemaHelper;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DepartmentForm
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
                        Section::make('Department Specifications')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Department Name')
                                    ->placeholder('e.g., Department of Cosmetology')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (string $state, $set) => $set('slug', str($state)->slug())),

                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->placeholder('auto-generated-slug')
                                    ->required()
                                    ->unique(ignoreRecord: true),

                                TextInput::make('short_desc')
                                    ->label('Short Summary')
                                    ->placeholder('Brief one-line summary describing the department...')
                                    ->required(),

                                RichEditor::make('full_desc')
                                    ->label('Full Description')
                                    ->placeholder('Provide rich text details about the department courses, aims, facilities...')
                                    ->required(),
                            ])
                            ->columnSpan(2),

                        // Sidebar Column (1/3 width)
                        Section::make('Department Imagery')
                            ->schema([
                                SchemaHelper::featuredImageUpload('photo', 'Department Icon / Thumbnail Photo', 'departments')
                                    ->required(),

                                SchemaHelper::featuredImageUpload('banner_pic', 'Department Banner Image', 'departments')
                                    ->required(),
                            ])
                            ->columnSpan(1),
                    ]),
            ]);
    }
}
