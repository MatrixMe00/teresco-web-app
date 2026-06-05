<?php

namespace App\Filament\Resources\NewsCategories\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class NewsCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Category Information')
                    ->description('Create or edit news categories used to organize articles.')
                    ->columnSpan('full')
                    ->schema([
                        TextInput::make('name')
                            ->label('Category Name')
                            ->placeholder('e.g., Campus Life')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $state, $set) => $set('slug', str($state)->slug())),

                        TextInput::make('slug')
                            ->label('Slug / URL segment')
                            ->placeholder('e.g., campus-life')
                            ->required()
                            ->unique(ignoreRecord: true),

                        Textarea::make('description')
                            ->label('Description')
                            ->placeholder('Provide a brief description of this news category...')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(1),
            ]);
    }
}
