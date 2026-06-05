<?php

namespace App\Filament\Resources\GalleryItems\Schemas;

use App\Filament\Support\SchemaHelper;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class GalleryItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Gallery Item Details')
                    ->description('Assign images or videos to albums in the media galleries.')
                    ->columnSpanFull()
                    ->columns(1)
                    ->schema([
                        Select::make('gallery_id')
                            ->label('Gallery Album')
                            ->relationship('gallery', 'name')
                            ->required()
                            ->placeholder('Select album...')
                            ->columnSpanFull(),

                        TextInput::make('name')
                            ->label('Caption / Name')
                            ->placeholder('e.g., Graduation Day 2026')
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('category')
                            ->label('Category tag')
                            ->placeholder('e.g., Academics, Sports, Campus')
                            ->nullable()
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->label('Additional Description')
                            ->placeholder('Provide any optional description or context for this photo...')
                            ->rows(3)
                            ->columnSpanFull(),

                        SchemaHelper::featuredImageUpload('image', 'Gallery Photo', 'gallery')
                            ->required()
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
