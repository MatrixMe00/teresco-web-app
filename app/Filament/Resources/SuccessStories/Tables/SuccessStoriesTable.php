<?php

namespace App\Filament\Resources\SuccessStories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SuccessStoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')
                    ->circular()
                    ->label('Photo')
                    ->disk('public'),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('department.name')
                    ->sortable(),
                TextColumn::make('course')
                    ->searchable(),
                TextColumn::make('year')
                    ->searchable(),
                TextColumn::make('occupation')
                    ->searchable(),
                TextColumn::make('company')
                    ->searchable(),
                TextColumn::make('rating')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('is_approved')
                    ->label('Status')
                    ->badge()
                    ->state(fn ($record): string => $record->is_approved ? 'Approved' : 'Pending')
                    ->color(fn ($record): string => $record->is_approved ? 'success' : 'warning')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make()->iconButton()->tooltip('View Success Story'),
                EditAction::make()->iconButton()->tooltip('Edit Success Story'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
