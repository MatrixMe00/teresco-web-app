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
                    ->columnSpanFull()
                    ->columns(1)
                    ->schema([
                        SchemaHelper::featuredImageUpload('image', 'Slide Banner Image', 'hero-slides')
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('title')
                            ->label('Title / Heading')
                            ->placeholder('e.g., Welcome to St. Theresa College')
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('subtitle')
                            ->label('Subheading')
                            ->placeholder('e.g., A Center of Academic Excellence')
                            ->columnSpanFull(),

                        TextInput::make('slogan')
                            ->label('Marketing Slogan')
                            ->placeholder('e.g., Build Skills. Build Futures.')
                            ->columnSpanFull(),

                        TextInput::make('button_text')
                            ->label('Call-to-Action Button Text')
                            ->placeholder('e.g., Apply Now')
                            ->columnSpanFull(),

                        TextInput::make('button_link')
                            ->label('Call-to-Action Link URL')
                            ->placeholder('e.g., /admissions')
                            ->url()
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
