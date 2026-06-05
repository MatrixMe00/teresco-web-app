<?php

namespace App\Filament\Resources\Galleries\Schemas;

use App\Filament\Support\SchemaHelper;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class GalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Gallery Album Details')
                    ->schema([
                        TextInput::make('name')
                            ->label('Album Name')
                            ->placeholder('e.g., Graduation 2025')
                            ->required(),

                        Textarea::make('description')
                            ->label('Description')
                            ->placeholder('Brief description of the event or gallery collection...')
                            ->rows(3)
                            ->columnSpanFull(),

                        SchemaHelper::featuredImageUpload('image', 'Cover Photo', 'gallery')
                            ->required(),
                    ]),
            ]);
    }
}
