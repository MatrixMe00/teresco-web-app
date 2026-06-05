<?php

namespace App\Filament\Resources\Vacancies\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VacanciesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('reference_number')
                    ->searchable(),
                TextColumn::make('department.name')
                    ->sortable(),
                TextColumn::make('published_at')
                    ->date()
                    ->sortable(),
                TextColumn::make('application_deadline')
                    ->date()
                    ->sortable(),
                TextColumn::make('attachment_path')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match (strtolower($state)) {
                        'open', 'active' => 'success',
                        'closed', 'expired' => 'danger',
                        'draft' => 'warning',
                        default => 'gray',
                    })
                    ->searchable(),
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
                ViewAction::make()->iconButton()->tooltip('View Vacancy'),
                EditAction::make()->iconButton()->tooltip('Edit Vacancy'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
