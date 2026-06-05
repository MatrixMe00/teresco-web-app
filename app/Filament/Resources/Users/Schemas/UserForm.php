<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('User Details')
                    ->columnSpanFull()
                    ->columns(1)
                    ->schema([
                        TextInput::make('name')
                            ->label('Name')
                            ->placeholder('e.g., Jane Doe')
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('email')
                            ->label('Email Address')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->columnSpanFull(),

                        Select::make('role')
                            ->label('System Role')
                            ->options([
                                'admin' => 'Admin',
                                'editor' => 'Editor',
                            ])
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->placeholder('Enter password...')
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $context): bool => $context === 'create')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
