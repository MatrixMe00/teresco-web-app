<?php

namespace App\Filament\Support;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class SchemaHelper
{
    /**
     * Reusable status card section for sidebars.
     */
    public static function statusCard(string $type = 'publish', string $toggleField = 'is_published', string $dateField = 'published_at'): Section
    {
        if ($type === 'state') {
            return Section::make('Status & Settings')
                ->schema([
                    Select::make('status')
                        ->options([
                            'open' => 'Open',
                            'closed' => 'Closed',
                        ])
                        ->default('open')
                        ->required(),
                ]);
        }

        return Section::make('Publishing Settings')
            ->schema([
                Toggle::make($toggleField)
                    ->label('Publish Status')
                    ->live()
                    ->afterStateUpdated(function ($state, $set) use ($dateField) {
                        if ($state) {
                            $set($dateField, now()->toDateTimeString());
                        } else {
                            $set($dateField, null);
                        }
                    }),

                DateTimePicker::make($dateField)
                    ->label('Published At')
                    ->readonly()
                    ->dehydrated(),
            ]);
    }

    /**
     * Standardized featured image upload control.
     */
    public static function featuredImageUpload(string $name = 'photo', string $label = 'Featured Image', string $directory = 'photos'): FileUpload
    {
        return FileUpload::make($name)
            ->label($label)
            ->image()
            ->imageEditor()
            ->disk('public')
            ->directory($directory)
            ->maxSize(2048); // 2MB limit
    }

    /**
     * Standardized PDF document/attachment upload control.
     */
    public static function pdfAttachmentUpload(string $name = 'pdf_file', string $label = 'PDF Document', string $directory = 'attachments'): FileUpload
    {
        return FileUpload::make($name)
            ->label($label)
            ->acceptedFileTypes(['application/pdf'])
            ->disk('public')
            ->directory($directory)
            ->maxSize(10240); // 10MB limit
    }

    /**
     * Standardized Status Badge Column for Tables.
     */
    public static function statusBadge(string $stateField = 'is_published', string $label = 'Status'): TextColumn
    {
        return TextColumn::make($stateField)
            ->label($label)
            ->badge()
            ->state(function ($record) use ($stateField): string {
                $val = $record->{$stateField};
                if (is_bool($val) || is_numeric($val)) {
                    return $val ? 'Published' : 'Draft';
                }

                return ucfirst((string) $val);
            })
            ->color(function ($record) use ($stateField): string {
                $val = $record->{$stateField};
                if (is_bool($val) || is_numeric($val)) {
                    return $val ? 'success' : 'warning';
                }

                return match (strtolower((string) $val)) {
                    'published', 'open', 'approved', 'active' => 'success',
                    'draft', 'pending' => 'warning',
                    'closed', 'rejected', 'inactive', 'cancelled' => 'danger',
                    default => 'gray',
                };
            })
            ->sortable();
    }

    /**
     * Standardized Avatar Column for Tables.
     */
    public static function avatarColumn(string $name = 'photo', string $label = 'Photo'): ImageColumn
    {
        return ImageColumn::make($name)
            ->label($label)
            ->circular()
            ->disk('public');
    }

    /**
     * Standardized Infolist audit trail timestamps grid.
     */
    public static function auditGrid(): Grid
    {
        return Grid::make(3)
            ->schema([
                TextEntry::make('created_at')
                    ->label('Created At')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime(),
                TextEntry::make('published_at')
                    ->label('Published At')
                    ->dateTime()
                    ->placeholder('Not published yet'),
            ]);
    }
}
