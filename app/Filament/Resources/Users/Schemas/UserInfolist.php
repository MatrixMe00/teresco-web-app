<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('User Account Information')
                    ->columnSpanFull()
                    ->schema([
                        Grid::make(3)->schema([
                            TextEntry::make('name')
                                ->label('Name')
                                ->weight('semibold'),
                            TextEntry::make('email')
                                ->label('Email Address'),
                            TextEntry::make('role')
                                ->label('System Role')
                                ->badge()
                                ->color(fn (string $state): string => match ($state) {
                                    'admin' => 'danger',
                                    'editor' => 'info',
                                    default => 'gray',
                                }),
                        ]),
                        Grid::make(3)->schema([
                            TextEntry::make('email_verified_at')
                                ->label('Email Verified At')
                                ->dateTime()
                                ->placeholder('Not verified'),
                            TextEntry::make('created_at')
                                ->label('Created At')
                                ->dateTime(),
                            TextEntry::make('updated_at')
                                ->label('Last Updated')
                                ->dateTime(),
                        ]),
                    ]),
            ]);
    }
}
