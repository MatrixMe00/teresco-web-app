<?php

namespace App\Filament\Resources\Institutions\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class InstitutionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Institution Profile & Branding')
                    ->description('Basic institutional profile, theme colors and official logo')
                    ->columns(2)
                    ->schema([
                        Grid::make(3)->schema([
                            TextEntry::make('name')
                                ->label('Institution Name')
                                ->weight('semibold'),
                            TextEntry::make('motto')
                                ->label('Official Motto'),
                            TextEntry::make('established_year')
                                ->label('Established Year'),
                            TextEntry::make('primary_color')
                                ->label('Primary Color Theme'),
                            TextEntry::make('primary_font')
                                ->label('Primary Font'),
                        ]),
                        ImageEntry::make('logo')
                            ->label('Institution Logo')
                            ->disk('public')
                            ->circular(),
                    ]),

                Section::make('About Us & Stats')
                    ->description('Campus profile, history, and core values')
                    ->schema([
                        TextEntry::make('about_us')
                            ->label('About Us Text')
                            ->html()
                            ->columnSpanFull(),

                        ImageEntry::make('about_us_image')
                            ->label('Campus Cover Image')
                            ->disk('public')
                            ->columnSpanFull(),

                        RepeatableEntry::make('stats')
                            ->label('Institutional Stats')
                            ->schema([
                                TextEntry::make('value')
                                    ->label('Value')
                                    ->weight('bold')
                                    ->formatStateUsing(fn ($state, $record) => $state.($record['suffix'] ?? '')),
                                TextEntry::make('label')->label('Label'),
                            ])
                            ->columns(2)
                            ->columnSpanFull(),

                        RepeatableEntry::make('timeline')
                            ->label('Institutional History Timeline')
                            ->schema([
                                TextEntry::make('year')->label('Year')->weight('bold'),
                                TextEntry::make('title')->label('Title'),
                                TextEntry::make('desc')->label('Description'),
                            ])
                            ->columns(3)
                            ->columnSpanFull(),

                        RepeatableEntry::make('core_values')
                            ->label('Core Values')
                            ->schema([
                                TextEntry::make('title')->label('Title')->weight('bold'),
                                TextEntry::make('desc')->label('Description'),
                                TextEntry::make('icon')->label('Icon'),
                            ])
                            ->columns(3)
                            ->columnSpanFull(),
                    ]),

                Section::make('Leadership Profiles')
                    ->description('Principal, Vice Principal, and Registrar details')
                    ->schema([
                        // Principal
                        Section::make("Principal's Profile")
                            ->columns(2)
                            ->schema([
                                TextEntry::make('principal_name')->label('Name'),
                                ImageEntry::make('principal_photo')->label('Photo')->circular()->disk('public'),
                                TextEntry::make('principal_qualifications')->label('Qualifications')->columnSpanFull(),
                                TextEntry::make('principal_message')->label('Message / Quote')->columnSpanFull(),
                                TextEntry::make('principal_bio')->label('Full Bio')->columnSpanFull(),
                            ]),

                        // Vice Principal
                        Section::make("Vice Principal's Profile")
                            ->columns(2)
                            ->schema([
                                TextEntry::make('vice_principal_name')->label('Name'),
                                ImageEntry::make('vice_principal_photo')->label('Photo')->circular()->disk('public'),
                                TextEntry::make('vice_principal_qualifications')->label('Qualifications')->columnSpanFull(),
                                TextEntry::make('vice_principal_message')->label('Message / Quote')->columnSpanFull(),
                                TextEntry::make('vice_principal_bio')->label('Full Bio')->columnSpanFull(),
                            ]),
                    ]),

                Section::make('Admissions Configuration')
                    ->schema([
                        Grid::make(2)->schema([
                            IconEntry::make('admission_open')
                                ->label('Admissions Portal Open')
                                ->boolean(),
                            TextEntry::make('admission_link')
                                ->label('External Admission Link')
                                ->url(fn ($record) => $record->admission_link)
                                ->openUrlInNewTab()
                                ->color('primary'),
                        ]),
                        TextEntry::make('admission_description')
                            ->label('Admission Instructions')
                            ->html()
                            ->columnSpanFull(),
                    ]),

                Section::make('Contact & Social Media Settings')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('phone')->label('Phone Number'),
                        TextEntry::make('email')->label('Email Address'),
                        TextEntry::make('address')->label('Physical Address')->columnSpanFull(),
                        TextEntry::make('latitude')->label('Latitude'),
                        TextEntry::make('longitude')->label('Longitude'),
                        TextEntry::make('facebook')->label('Facebook URL')->url(fn ($record) => $record->facebook)->openUrlInNewTab()->color('primary'),
                        TextEntry::make('tiktok')->label('TikTok URL')->url(fn ($record) => $record->tiktok)->openUrlInNewTab()->color('primary'),
                        TextEntry::make('x')->label('X (Twitter) URL')->url(fn ($record) => $record->x)->openUrlInNewTab()->color('primary'),
                        TextEntry::make('youtube')->label('YouTube URL')->url(fn ($record) => $record->youtube)->openUrlInNewTab()->color('primary'),
                    ]),
            ]);
    }
}
