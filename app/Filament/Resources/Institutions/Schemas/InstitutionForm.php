<?php

namespace App\Filament\Resources\Institutions\Schemas;

use Filament\Actions\Action;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class InstitutionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('College Settings')
                ->persistTabInQueryString()
                ->columnSpanFull()
                ->tabs([

                    // TAB 1: IDENTITY & BRANDING
                    Tab::make('Identity & Branding')
                        ->icon(Heroicon::OutlinedBuildingOffice2)
                        ->schema([
                            Section::make('Institution Identity & Branding')
                                ->description('Basic institutional profile, colors, fonts and logo')
                                ->columns(2)
                                ->schema([
                                    TextInput::make('name')
                                        ->label('Institution Name')
                                        ->required(),

                                    TextInput::make('motto')
                                        ->label('Official Motto')
                                        ->maxLength(255)
                                        ->placeholder('e.g. Build Skills. Build Futures.'),

                                    TextInput::make('established_year')
                                        ->label('Established Year')
                                        ->maxLength(10)
                                        ->placeholder('e.g. 2019'),

                                    ColorPicker::make('primary_color')
                                        ->label('Primary Color Theme')
                                        ->default('#7a4b7d'),

                                    Select::make('primary_font')
                                        ->label('Primary Font')
                                        ->options([
                                            'Inter' => 'Inter',
                                            'Instrument Sans' => 'Instrument Sans',
                                            'Poppins' => 'Poppins',
                                            'Nunito' => 'Nunito',
                                            'Open Sans' => 'Open Sans',
                                            'Roboto' => 'Roboto',
                                        ])
                                        ->searchable()
                                        ->placeholder('Choose primary font'),

                                    FileUpload::make('logo')
                                        ->label('Institution Logo')
                                        ->image()
                                        ->disk('public')
                                        ->imageEditor()
                                        ->directory('logos')
                                        ->previewable()
                                        ->maxSize(2048),
                                ]),

                            Section::make('Footer Settings')
                                ->description('Update institutional copyright details and descriptions')
                                ->schema([
                                    Textarea::make('footer_description')
                                        ->label('Footer Institutional Statement')
                                        ->rows(3)
                                        ->columnSpanFull(),

                                    TextInput::make('footer_note')
                                        ->label('Footer Copyright Note')
                                        ->placeholder('e.g. St. Theresa\'s College of Education. All Rights Reserved.')
                                        ->columnSpanFull(),
                                ]),
                        ]),

                    // TAB: HOMEPAGE SETTINGS
                    Tab::make('Homepage Settings')
                        ->icon(Heroicon::OutlinedHome)
                        ->schema([
                            Section::make('Hero Customization')
                                ->description('Update the homepage hero section text details')
                                ->columns(2)
                                ->schema([
                                    TextInput::make('hero_badge')
                                        ->label('Hero Accent Badge Text')
                                        ->placeholder('e.g. KNQA Accredited Institution')
                                        ->maxLength(255)
                                        ->columnSpan(1),

                                    Textarea::make('hero_description')
                                        ->label('Hero Section Description')
                                        ->placeholder('e.g. St. Theresa\'s College of Education offers world-class technical education...')
                                        ->rows(3)
                                        ->columnSpan(1),
                                ]),

                            Section::make('Our History (Homepage)')
                                ->description('Customize the brief history section shown on the homepage')
                                ->schema([
                                    Grid::make(2)
                                        ->schema([
                                            TextInput::make('history_title')
                                                ->label('History Section Title')
                                                ->placeholder('e.g. Building the Future')
                                                ->columnSpan(1),

                                            FileUpload::make('history_image')
                                                ->label('History Cover Image')
                                                ->image()
                                                ->disk('public')
                                                ->directory('homepage')
                                                ->columnSpan(1),
                                        ]),

                                    Textarea::make('history_description')
                                        ->label('History Brief Description')
                                        ->placeholder('Enter history brief description...')
                                        ->rows(4)
                                        ->columnSpanFull(),
                                ]),

                            Section::make('Homepage Stats Strip')
                                ->description('Manage the 4 stats cards displayed on the homepage')
                                ->schema([
                                    Repeater::make('homepage_stats')
                                        ->label('Stats Cards')
                                        ->grid(2)
                                        ->schema([
                                            Grid::make(3)
                                                ->schema([
                                                    TextInput::make('value')
                                                        ->label('Stat Value (Counter)')
                                                        ->required()
                                                        ->placeholder('e.g. 92'),
                                                    TextInput::make('suffix')
                                                        ->label('Suffix Symbol')
                                                        ->placeholder('e.g. % or +'),
                                                    TextInput::make('label')
                                                        ->label('Stat Description')
                                                        ->required()
                                                        ->placeholder('e.g. Graduation Rate'),
                                                    TextInput::make('icon')
                                                        ->label('FontAwesome Icon Name')
                                                        ->required()
                                                        ->placeholder('e.g. fa-graduation-cap')
                                                        ->columnSpanFull(),
                                                ]),
                                        ])
                                        ->columnSpanFull()
                                        ->maxItems(4),
                                ]),
                        ]),

                    // TAB 2: ABOUT US PAGE
                    Tab::make('About Us Page')
                        ->icon(Heroicon::OutlinedBookOpen)
                        ->schema([
                            Section::make('Hero & Introduction')
                                ->description('Customize the page hero subtitle and Who We Are details')
                                ->schema([
                                    Grid::make(2)
                                        ->schema([
                                            TextInput::make('about_hero_subtitle')
                                                ->label('Hero Section Subtitle')
                                                ->placeholder('e.g. Empowering futures through technical education excellence since 2019')
                                                ->columnSpan(1),

                                            TextInput::make('about_us_title')
                                                ->label('Who We Are Section Title')
                                                ->placeholder('e.g. Building the Future Through Technical Excellence')
                                                ->columnSpan(1),
                                        ]),

                                    RichEditor::make('about_us')
                                        ->label('About Us Text')
                                        ->columnSpanFull(),

                                    FileUpload::make('about_us_image')
                                        ->label('Campus / About Us Cover Image')
                                        ->image()
                                        ->disk('public')
                                        ->directory('about')
                                        ->previewable()
                                        ->maxSize(4096)
                                        ->columnSpanFull(),
                                ]),

                            Section::make('Core Values Settings')
                                ->description('Customize core values section title, description, and cards')
                                ->headerActions([
                                    Action::make('toggle_values_section')
                                        ->label(fn (Get $get) => (bool) $get('show_values_section') ? 'Enabled' : 'Disabled')
                                        ->icon(fn (Get $get) => (bool) $get('show_values_section') ? 'heroicon-m-eye' : 'heroicon-m-eye-slash')
                                        ->color(fn (Get $get) => (bool) $get('show_values_section') ? 'success' : 'gray')
                                        ->tooltip(fn (Get $get) => (bool) $get('show_values_section') ? 'Click to hide this section on the About page' : 'Click to show this section on the About page')
                                        ->action(function (Set $set, Get $get) {
                                            $set('show_values_section', ! (bool) $get('show_values_section'));
                                        }),
                                ])
                                ->schema([
                                    Toggle::make('show_values_section')
                                        ->default(true)
                                        ->hidden(),

                                    Grid::make(2)
                                        ->schema([
                                            TextInput::make('values_title')
                                                ->label('Core Values Title')
                                                ->placeholder('e.g. Core Values That Guide Us'),

                                            Textarea::make('values_description')
                                                ->label('Core Values Description')
                                                ->rows(2)
                                                ->placeholder('e.g. These principles define who we are and how we approach technical education.'),
                                        ])
                                        ->visible(fn (Get $get): bool => (bool) $get('show_values_section')),

                                    Repeater::make('core_values')
                                        ->label('Core Value Cards')
                                        ->grid(2)
                                        ->schema([
                                            Grid::make(2)
                                                ->schema([
                                                    TextInput::make('title')
                                                        ->required()
                                                        ->placeholder('e.g. Excellence'),
                                                    TextInput::make('icon')
                                                        ->required()
                                                        ->placeholder('e.g. fa-check-circle'),
                                                    Textarea::make('desc')
                                                        ->required()
                                                        ->rows(2)
                                                        ->placeholder('Value description...')
                                                        ->columnSpanFull(),
                                                ]),
                                        ])
                                        ->columnSpanFull()
                                        ->visible(fn (Get $get): bool => (bool) $get('show_values_section')),
                                ]),

                            Section::make('Statistics Counters')
                                ->description('Customize statistical counter numbers on the about page')
                                ->headerActions([
                                    Action::make('toggle_stats_section')
                                        ->label(fn (Get $get) => (bool) $get('show_stats_section') ? 'Enabled' : 'Disabled')
                                        ->icon(fn (Get $get) => (bool) $get('show_stats_section') ? 'heroicon-m-eye' : 'heroicon-m-eye-slash')
                                        ->color(fn (Get $get) => (bool) $get('show_stats_section') ? 'success' : 'gray')
                                        ->tooltip(fn (Get $get) => (bool) $get('show_stats_section') ? 'Click to hide this section on the About page' : 'Click to show this section on the About page')
                                        ->action(function (Set $set, Get $get) {
                                            $set('show_stats_section', ! (bool) $get('show_stats_section'));
                                        }),
                                ])
                                ->schema([
                                    Toggle::make('show_stats_section')
                                        ->default(true)
                                        ->hidden(),

                                    Repeater::make('stats')
                                        ->label('Stats Counters')
                                        ->grid(2)
                                        ->schema([
                                            Grid::make(4)
                                                ->schema([
                                                    TextInput::make('value')
                                                        ->required()
                                                        ->placeholder('e.g. 500'),
                                                    TextInput::make('suffix')
                                                        ->placeholder('e.g. + or %'),
                                                    TextInput::make('label')
                                                        ->required()
                                                        ->placeholder('e.g. Students Enrolled'),
                                                    TextInput::make('icon')
                                                        ->required()
                                                        ->placeholder('e.g. fa-user-graduate'),
                                                ]),
                                        ])
                                        ->columnSpanFull()
                                        ->visible(fn (Get $get): bool => (bool) $get('show_stats_section')),
                                ]),

                            Section::make('Our Journey Timeline')
                                ->description('Customize history section title, description, and timeline milestones')
                                ->headerActions([
                                    Action::make('toggle_journey_section')
                                        ->label(fn (Get $get) => (bool) $get('show_journey_section') ? 'Enabled' : 'Disabled')
                                        ->icon(fn (Get $get) => (bool) $get('show_journey_section') ? 'heroicon-m-eye' : 'heroicon-m-eye-slash')
                                        ->color(fn (Get $get) => (bool) $get('show_journey_section') ? 'success' : 'gray')
                                        ->tooltip(fn (Get $get) => (bool) $get('show_journey_section') ? 'Click to hide this section on the About page' : 'Click to show this section on the About page')
                                        ->action(function (Set $set, Get $get) {
                                            $set('show_journey_section', ! (bool) $get('show_journey_section'));
                                        }),
                                ])
                                ->schema([
                                    Toggle::make('show_journey_section')
                                        ->default(true)
                                        ->hidden(),

                                    Grid::make(2)
                                        ->schema([
                                            TextInput::make('journey_title')
                                                ->label('Timeline Section Title')
                                                ->placeholder('e.g. Our Journey'),

                                            Textarea::make('journey_description')
                                                ->label('Timeline Section Description')
                                                ->rows(2)
                                                ->placeholder('e.g. The story of how we grew from a vision to a leading TVET institution.'),
                                        ])
                                        ->visible(fn (Get $get): bool => (bool) $get('show_journey_section')),

                                    Repeater::make('timeline')
                                        ->label('Timeline Milestones')
                                        ->schema([
                                            Grid::make(3)
                                                ->schema([
                                                    TextInput::make('year')
                                                        ->required()
                                                        ->placeholder('e.g. 2019')
                                                        ->columnSpan(1),
                                                    TextInput::make('title')
                                                        ->required()
                                                        ->placeholder('e.g. Establishment')
                                                        ->columnSpan(2),
                                                    Textarea::make('desc')
                                                        ->required()
                                                        ->rows(2)
                                                        ->placeholder('Description of milestones...')
                                                        ->columnSpanFull(),
                                                ]),
                                        ])
                                        ->columnSpanFull()
                                        ->visible(fn (Get $get): bool => (bool) $get('show_journey_section')),
                                ]),

                            Section::make('Community Impact Settings')
                                ->description('Customize community impact title, description, and area cards')
                                ->headerActions([
                                    Action::make('toggle_impact_section')
                                        ->label(fn (Get $get) => (bool) $get('show_impact_section') ? 'Enabled' : 'Disabled')
                                        ->icon(fn (Get $get) => (bool) $get('show_impact_section') ? 'heroicon-m-eye' : 'heroicon-m-eye-slash')
                                        ->color(fn (Get $get) => (bool) $get('show_impact_section') ? 'success' : 'gray')
                                        ->tooltip(fn (Get $get) => (bool) $get('show_impact_section') ? 'Click to hide this section on the About page' : 'Click to show this section on the About page')
                                        ->action(function (Set $set, Get $get) {
                                            $set('show_impact_section', ! (bool) $get('show_impact_section'));
                                        }),
                                ])
                                ->schema([
                                    Toggle::make('show_impact_section')
                                        ->default(true)
                                        ->hidden(),

                                    Grid::make(2)
                                        ->schema([
                                            TextInput::make('impact_title')
                                                ->label('Community Impact Title')
                                                ->placeholder('e.g. Community Impact'),

                                            Textarea::make('impact_description')
                                                ->label('Community Impact Description')
                                                ->rows(2)
                                                ->placeholder('e.g. How we\'re making a difference in our community and beyond.'),
                                        ])
                                        ->visible(fn (Get $get): bool => (bool) $get('show_impact_section')),

                                    Repeater::make('community_impact')
                                        ->label('Impact Areas')
                                        ->grid(2)
                                        ->schema([
                                            Grid::make(2)
                                                ->schema([
                                                    TextInput::make('title')
                                                        ->required()
                                                        ->placeholder('e.g. Economic Development'),
                                                    TextInput::make('icon')
                                                        ->required()
                                                        ->placeholder('e.g. fa-chart-line'),
                                                    Textarea::make('desc')
                                                        ->required()
                                                        ->rows(2)
                                                        ->placeholder('Impact details...')
                                                        ->columnSpanFull(),
                                                ]),
                                        ])
                                        ->columnSpanFull()
                                        ->visible(fn (Get $get): bool => (bool) $get('show_impact_section')),
                                ]),
                        ]),

                    // TAB 3: LEADERSHIP PROFILES
                    Tab::make('Leadership Profiles')
                        ->icon(Heroicon::OutlinedUserGroup)
                        ->schema([
                            // Principal
                            Section::make("Principal's Profile")
                                ->schema([
                                    Grid::make(3)
                                        ->schema([
                                            Grid::make(1)
                                                ->columnSpan(2)
                                                ->schema([
                                                    TextInput::make('principal_name')
                                                        ->label("Principal's Name"),
                                                    Textarea::make('principal_qualifications')
                                                        ->label("Principal's Qualifications")
                                                        ->rows(2),
                                                ]),
                                            FileUpload::make('principal_photo')
                                                ->label("Principal's Photo")
                                                ->image()
                                                ->avatar()
                                                ->disk('public')
                                                ->directory('leadership')
                                                ->columnSpan(1),
                                            Textarea::make('principal_message')
                                                ->label("Principal's Message / Quote")
                                                ->rows(3)
                                                ->columnSpanFull(),
                                            Textarea::make('principal_bio')
                                                ->label("Principal's Full Bio / Background")
                                                ->rows(4)
                                                ->columnSpanFull(),
                                        ]),
                                ]),

                            // Vice Principal
                            Section::make("Vice Principal's Profile")
                                ->schema([
                                    Grid::make(3)
                                        ->schema([
                                            Grid::make(1)
                                                ->columnSpan(2)
                                                ->schema([
                                                    TextInput::make('vice_principal_name')
                                                        ->label("Vice Principal's Name"),
                                                    Textarea::make('vice_principal_qualifications')
                                                        ->label("Vice Principal's Qualifications")
                                                        ->rows(2),
                                                ]),
                                            FileUpload::make('vice_principal_photo')
                                                ->label("Vice Principal's Photo")
                                                ->image()
                                                ->avatar()
                                                ->disk('public')
                                                ->directory('leadership')
                                                ->columnSpan(1),
                                            Textarea::make('vice_principal_message')
                                                ->label("Vice Principal's Message / Quote")
                                                ->rows(3)
                                                ->columnSpanFull(),
                                            Textarea::make('vice_principal_bio')
                                                ->label("Vice Principal's Full Bio / Background")
                                                ->rows(4)
                                                ->columnSpanFull(),
                                        ]),
                                ]),

                            // Registrar
                            Section::make("Registrar's Profile")
                                ->schema([
                                    Grid::make(3)
                                        ->schema([
                                            Grid::make(1)
                                                ->columnSpan(2)
                                                ->schema([
                                                    TextInput::make('registrar_name')
                                                        ->label("Registrar's Name"),
                                                    Textarea::make('registrar_qualifications')
                                                        ->label("Registrar's Qualifications")
                                                        ->rows(2),
                                                ]),
                                            FileUpload::make('registrar_photo')
                                                ->label("Registrar's Photo")
                                                ->image()
                                                ->avatar()
                                                ->disk('public')
                                                ->directory('leadership')
                                                ->columnSpan(1),
                                            Textarea::make('registrar_message')
                                                ->label("Registrar's Message / Quote")
                                                ->rows(3)
                                                ->columnSpanFull(),
                                            Textarea::make('registrar_bio')
                                                ->label("Registrar's Full Bio / Background")
                                                ->rows(4)
                                                ->columnSpanFull(),
                                        ]),
                                ]),
                        ]),

                    // TAB 4: ADMISSIONS CONFIG
                    Tab::make('Admissions Config')
                        ->icon(Heroicon::OutlinedClipboardDocumentList)
                        ->schema([
                            Section::make('Admissions Configuration')
                                ->description('Toggle admissions portal type and instructions')
                                ->schema([
                                    Grid::make(2)
                                        ->schema([
                                            Toggle::make('admission_open')
                                                ->label('Open Admissions / Use Internal Application Form')
                                                ->live()
                                                ->columnSpan(1),

                                            TextInput::make('admission_link')
                                                ->label('External Admission Portal Link')
                                                ->placeholder('e.g. https://portal.teresco.edu.gh')
                                                ->columnSpan(1),
                                        ]),

                                    RichEditor::make('admission_description')
                                        ->label('Admission Instructions / Requirements (Displayed when internal form is closed)')
                                        ->columnSpanFull(),
                                ]),
                        ]),

                    // TAB 5: SERVICE CHARTER
                    Tab::make('Service Charter')
                        ->icon(Heroicon::OutlinedDocumentText)
                        ->schema([
                            Section::make('Service Charter')
                                ->description('Configure the institutional Service Charter details')
                                ->schema([
                                    Grid::make(2)
                                        ->schema([
                                            Grid::make(1)
                                                ->columnSpan(1)
                                                ->schema([
                                                    TextInput::make('charter_title')
                                                        ->label('Charter Page Title')
                                                        ->default('Service Charter'),

                                                    Textarea::make('charter_description')
                                                        ->label('Charter Page Introduction')
                                                        ->rows(4),
                                                ]),

                                            Grid::make(1)
                                                ->columnSpan(1)
                                                ->schema([
                                                    FileUpload::make('charter_image')
                                                        ->label('Charter Cover Image')
                                                        ->image()
                                                        ->disk('public')
                                                        ->directory('charter'),
                                                ]),
                                        ]),

                                    Grid::make(2)
                                        ->schema([
                                            FileUpload::make('charter_download_file')
                                                ->label('Official PDF Download')
                                                ->acceptedFileTypes(['application/pdf'])
                                                ->disk('public')
                                                ->directory('charter'),

                                            FileUpload::make('charter_audio_file')
                                                ->label('Audio Guide (.mp3)')
                                                ->acceptedFileTypes(['audio/mpeg', 'audio/mp3', 'audio/wav'])
                                                ->disk('public')
                                                ->directory('charter'),
                                        ]),

                                    Repeater::make('charter_items')
                                        ->label('Service Charter Items')
                                        ->schema([
                                            Grid::make(3)
                                                ->schema([
                                                    TextInput::make('service')
                                                        ->required()
                                                        ->placeholder('e.g. Admissions Processing'),
                                                    TextInput::make('timeline')
                                                        ->required()
                                                        ->placeholder('e.g. Within 14 days'),
                                                    TextInput::make('cost')
                                                        ->default('Free')
                                                        ->placeholder('e.g. Free'),
                                                ]),
                                        ])
                                        ->columnSpanFull(),
                                ]),
                        ]),

                    // TAB 6: CONTACTS & SOCIALS
                    Tab::make('Contacts & Socials')
                        ->icon(Heroicon::OutlinedPhone)
                        ->schema([
                            Section::make('Contact & Location Settings')
                                ->description('Update institutional contact details and maps coordinates')
                                ->columns(2)
                                ->schema([
                                    TextInput::make('phone')
                                        ->label('Phone Number')
                                        ->tel(),

                                    TextInput::make('email')
                                        ->label('Email Address')
                                        ->email(),

                                    Textarea::make('address')
                                        ->rows(3)
                                        ->label('Physical Address')
                                        ->columnSpanFull(),

                                    TextInput::make('latitude')
                                        ->label('Latitude'),

                                    TextInput::make('longitude')
                                        ->label('Longitude'),
                                ]),

                            Section::make('Social Media Links')
                                ->description('Update institutional social media URLs')
                                ->columns(2)
                                ->schema([
                                    TextInput::make('facebook')
                                        ->label('Facebook URL'),

                                    TextInput::make('tiktok')
                                        ->label('TikTok URL'),

                                    TextInput::make('x')
                                        ->label('X (Twitter) URL'),

                                    TextInput::make('youtube')
                                        ->label('YouTube URL'),
                                ]),
                        ]),
                ]),
        ]);
    }
}
