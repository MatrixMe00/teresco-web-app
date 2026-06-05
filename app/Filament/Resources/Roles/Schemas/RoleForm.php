<?php

namespace App\Filament\Resources\Roles\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RoleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Role Details')
                    ->description('Define user groups and access levels.')
                    ->columnSpan('full')
                    ->schema([
                        TextInput::make('name')
                            ->label('Role Name')
                            ->placeholder('e.g., Administrator, Editor')
                            ->required()
                            ->unique(ignoreRecord: true),
                    ]),
            ]);
    }
}
