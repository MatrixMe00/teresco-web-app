<?php

namespace App\Filament\Resources\Downloads\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DownloadForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Download File Details')
                    ->description('Upload files that visitors can download from the portal.')
                    ->columnSpan('full')
                    ->schema([
                        TextInput::make('title')
                            ->label('Title')
                            ->placeholder('e.g., Student Handbook 2026')
                            ->required(),

                        TextInput::make('category')
                            ->label('Category')
                            ->placeholder('e.g., Handbook, Form, Guide')
                            ->required(),

                        Textarea::make('description')
                            ->label('Description')
                            ->placeholder('Briefly describe the contents of this file...')
                            ->rows(3)
                            ->columnSpanFull(),

                        FileUpload::make('file_path')
                            ->label('File Attachment')
                            ->disk('public')
                            ->directory('downloads')
                            ->required()
                            ->columnSpanFull(),

                        Toggle::make('is_public')
                            ->label('Publicly Visible')
                            ->default(true)
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }
}
