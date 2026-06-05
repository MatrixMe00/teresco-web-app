<?php

namespace App\Filament\Resources\AdmissionLists\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AdmissionListsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('academic_year')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('is_published')
                    ->label('Status')
                    ->badge()
                    ->state(fn ($record): string => $record->is_published ? 'Published' : 'Draft')
                    ->color(fn ($record): string => $record->is_published ? 'success' : 'warning')
                    ->sortable(),
                TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make()->slideOver()->modalWidth('lg')->iconButton()->tooltip('View Admission List'),
                EditAction::make()->slideOver()->modalWidth('lg')->iconButton()->tooltip('Edit Admission List'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
