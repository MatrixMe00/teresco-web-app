<?php

namespace App\Filament\Resources\AdmissionLists\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AdmissionListInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextEntry::make('title'),
            TextEntry::make('academic_year'),
            TextEntry::make('description')
                ->markdown(),
            TextEntry::make('pdf_file')
                ->label('PDF File Link')
                ->url(fn ($record) => asset('storage/'.$record->pdf_file))
                ->openUrlInNewTab(),
            IconEntry::make('is_published')
                ->boolean(),
            TextEntry::make('published_at')
                ->dateTime(),
            TextEntry::make('created_at')
                ->dateTime(),
            TextEntry::make('updated_at')
                ->dateTime(),
        ]);
    }
}
