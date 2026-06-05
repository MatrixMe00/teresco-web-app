<?php

namespace App\Filament\Resources\HeroSlides\Schemas;

use App\Filament\Support\SchemaHelper;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class HeroSlideForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Hero Slide Details')
                    ->columns(2)
                    ->columnSpanFull()
                    ->schema([
                        SchemaHelper::featuredImageUpload('image', 'Slide Banner Image', 'hero-slides')
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('title')
                            ->label('Title / Heading')
                            ->placeholder('e.g., Welcome to St. Theresa College')
                            ->required(),

                        TextInput::make('subtitle')
                            ->label('Subheading')
                            ->placeholder('e.g., A Center of Academic Excellence'),

                        TextInput::make('slogan')
                            ->label('Marketing Slogan')
                            ->placeholder('e.g., Build Skills. Build Futures.'),

                        TextInput::make('button_text')
                            ->label('Call-to-Action Button Text')
                            ->placeholder('e.g., Apply Now'),

                        TextInput::make('button_link')
                            ->label('Call-to-Action Link URL')
                            ->placeholder('e.g., /admissions')
                            ->url(),
                    ]),
            ]);
    }
}
