<?php

namespace App\Filament\Resources\Partners\Schemas;

use App\Filament\Support\SchemaHelper;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PartnerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Partner Details')
                    ->description('Manage relationships with industry and academic partners.')
                    ->columnSpanFull()
                    ->columns(1)
                    ->schema([
                        TextInput::make('name')
                            ->label('Partner Name')
                            ->placeholder('e.g., Mastercard Foundation')
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('website')
                            ->label('Website URL')
                            ->placeholder('e.g., https://example.com')
                            ->url()
                            ->nullable()
                            ->columnSpanFull(),

                        SchemaHelper::featuredImageUpload('logo', 'Partner Logo', 'partners')
                            ->required()
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
