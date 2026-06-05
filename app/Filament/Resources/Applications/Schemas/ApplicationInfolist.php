<?php

namespace App\Filament\Resources\Applications\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ApplicationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columns(3)
                    ->columnSpanFull()
                    ->schema([
                        // Main Column (2/3 width)
                        Section::make('Academic & Personal Details')
                            ->schema([
                                Grid::make(2)->schema([
                                    TextEntry::make('full_name')
                                        ->label('Applicant Name')
                                        ->weight('semibold'),
                                    TextEntry::make('gender')
                                        ->label('Gender')
                                        ->state(fn ($record) => ucfirst($record->gender)),
                                    TextEntry::make('id_number')
                                        ->label('ID / Passport Number'),
                                    TextEntry::make('course.name')
                                        ->label('Course Applied For'),
                                    TextEntry::make('start_term')
                                        ->label('Target Intake / Term')
                                        ->columnSpanFull(),
                                ]),

                                Section::make('High School Qualifications')
                                    ->schema([
                                        Grid::make(3)->schema([
                                            TextEntry::make('high_school')
                                                ->label('High School Name'),
                                            TextEntry::make('high_school_grade')
                                                ->label('Mean Grade'),
                                            TextEntry::make('kcse_year')
                                                ->label('Completion Year'),
                                        ]),
                                        Grid::make(2)->schema([
                                            TextEntry::make('kcse_index_number')
                                                ->label('Index Number'),
                                            TextEntry::make('nemis_upi_number')
                                                ->label('NEMIS UPI Number')
                                                ->placeholder('-'),
                                        ]),
                                    ]),
                            ])
                            ->columnSpan(2),

                        // Sidebar Column (1/3 width)
                        Section::make('Contact & Guardian Information')
                            ->schema([
                                TextEntry::make('phone')
                                    ->label('Applicant Phone'),
                                TextEntry::make('alternative_phone')
                                    ->label('Alternative Phone')
                                    ->placeholder('-'),
                                TextEntry::make('parent_name')
                                    ->label('Parent / Guardian'),
                                TextEntry::make('parent_phone')
                                    ->label('Parent Phone'),
                                TextEntry::make('created_at')
                                    ->label('Submitted On')
                                    ->dateTime(),
                                TextEntry::make('updated_at')
                                    ->label('Last Updated')
                                    ->dateTime(),
                            ])
                            ->columnSpan(1),
                    ]),
            ]);
    }
}
