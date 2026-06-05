<?php

namespace App\Filament\Resources\TeamMembers\Schemas;

use App\Filament\Support\SchemaHelper;
use App\Models\Department;
use App\Models\Role;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TeamMemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make()
                ->columns(3)
                ->columnSpanFull()
                ->schema([
                    // Main Column (2/3 width)
                    Section::make('Profile Information')
                        ->schema([
                            TextInput::make('name')
                                ->label('Full Name')
                                ->placeholder('e.g., Prof. Jane Doe')
                                ->required(),

                            TextInput::make('email')
                                ->label('Email Address')
                                ->email()
                                ->placeholder('e.g., jane.doe@example.com')
                                ->nullable(),

                            TextInput::make('qualification')
                                ->label('Professional Qualifications')
                                ->placeholder('e.g., PhD in Education, MSc in Computer Science')
                                ->required(),

                            TextInput::make('section_assigned')
                                ->label('Section Assigned')
                                ->placeholder('e.g., Main Campus, Academic Registry')
                                ->nullable(),

                            Select::make('department_id')
                                ->label('Department')
                                ->options(fn () => Department::pluck('name', 'id'))
                                ->searchable()
                                ->preload()
                                ->required()
                                ->placeholder('Select department'),

                            Select::make('role_id')
                                ->label('Staff / System Role')
                                ->options(fn () => Role::pluck('name', 'id'))
                                ->searchable()
                                ->preload()
                                ->required()
                                ->placeholder('Select role'),
                        ])
                        ->columnSpan(2),

                    // Sidebar Column (1/3 width)
                    Section::make('Profile Photo & Joining details')
                        ->schema([
                            SchemaHelper::featuredImageUpload('photo', 'Profile Photo', 'team_members')
                                ->required(),

                            TextInput::make('graduation_year')
                                ->label('Graduation / Joining Year')
                                ->numeric()
                                ->default(now()->year)
                                ->required(),
                        ])
                        ->columnSpan(1),
                ]),
        ]);
    }
}
