<?php

namespace App\Filament\Resources\NewsItems\Schemas;

use App\Filament\Support\SchemaHelper;
use App\Models\NewsCategory;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class NewsItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make()
                ->columns(3)
                ->columnSpanFull()
                ->schema([
                    // Main Content Column (2/3 width)
                    Section::make('News Content')
                        ->schema([
                            TextInput::make('title')
                                ->label('Title')
                                ->required()
                                ->maxLength(255)
                                ->placeholder('Enter a catchy news title...')
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn (string $state, $set) => $set('slug', str($state)->slug())),

                            TextInput::make('slug')
                                ->label('Slug')
                                ->required()
                                ->maxLength(255)
                                ->placeholder('auto-generated-slug')
                                ->helperText('This determines the URL structure of the news post.')
                                ->unique(ignoreRecord: true),

                            Textarea::make('excerpt')
                                ->label('Short Excerpt')
                                ->rows(3)
                                ->placeholder('Enter a brief summary of this news post for search results...'),

                            RichEditor::make('content')
                                ->label('Article Body')
                                ->required()
                                ->placeholder('Write the full article content here...'),
                        ])
                        ->columnSpan(2),

                    // Sidebar / Settings Column (1/3 width)
                    Section::make('Publishing & Media')
                        ->schema([
                            Select::make('news_category_id')
                                ->label('Category')
                                ->options(fn () => NewsCategory::pluck('name', 'id'))
                                ->searchable()
                                ->required()
                                ->placeholder('Select category'),

                            SchemaHelper::featuredImageUpload('image', 'Cover Image', 'news-images'),

                            Toggle::make('is_published')
                                ->label('Publish Status')
                                ->live()
                                ->afterStateUpdated(function ($state, $set) {
                                    if ($state) {
                                        $set('published_at', now()->toDateTimeString());
                                    } else {
                                        $set('published_at', null);
                                    }
                                }),

                            DateTimePicker::make('published_at')
                                ->label('Published At')
                                ->readonly()
                                ->dehydrated(),
                        ])
                        ->columnSpan(1),
                ]),
        ]);
    }
}
