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
use Illuminate\Support\HtmlString;

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
                                            Grid::make(12)
                                                ->schema([
                                                    TextInput::make('value')
                                                        ->label('Stat Value (Counter)')
                                                        ->required()
                                                        ->placeholder('e.g. 92')
                                                        ->columnSpan(6),
                                                    TextInput::make('suffix')
                                                        ->label('Suffix Symbol')
                                                        ->placeholder('e.g. % or +')
                                                        ->columnSpan(6),
                                                    TextInput::make('label')
                                                        ->label('Stat Description')
                                                        ->required()
                                                        ->placeholder('e.g. Graduation Rate')
                                                        ->columnSpan(12),
                                                    Select::make('icon')
                                                        ->label('Icon')
                                                        ->options(static::getFontAwesomeIconOptions())
                                                        ->searchable()
                                                        ->allowHtml()
                                                        ->native(false)
                                                        ->required()
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
                                        ->extraInputAttributes(['style' => 'min-height: 350px;'])
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
                                            Grid::make(12)
                                                ->schema([
                                                    TextInput::make('title')
                                                        ->required()
                                                        ->placeholder('e.g. Excellence')
                                                        ->columnSpan(12),
                                                    Select::make('icon')
                                                        ->label('Icon')
                                                        ->options(static::getFontAwesomeIconOptions())
                                                        ->searchable()
                                                        ->allowHtml()
                                                        ->native(false)
                                                        ->required()
                                                        ->columnSpan(12),
                                                    Textarea::make('desc')
                                                        ->required()
                                                        ->rows(2)
                                                        ->placeholder('Value description...')
                                                        ->columnSpan(12),
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
                                            Grid::make(12)
                                                ->schema([
                                                    TextInput::make('value')
                                                        ->required()
                                                        ->placeholder('e.g. 500')
                                                        ->columnSpan(6),
                                                    TextInput::make('suffix')
                                                        ->placeholder('e.g. + or %')
                                                        ->columnSpan(6),
                                                    TextInput::make('label')
                                                        ->required()
                                                        ->placeholder('e.g. Students Enrolled')
                                                        ->columnSpan(12),
                                                    Select::make('icon')
                                                        ->label('Icon')
                                                        ->options(static::getFontAwesomeIconOptions())
                                                        ->searchable()
                                                        ->allowHtml()
                                                        ->native(false)
                                                        ->required()
                                                        ->columnSpan(12),
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
                                            Grid::make(12)
                                                ->schema([
                                                    TextInput::make('title')
                                                        ->required()
                                                        ->placeholder('e.g. Economic Development')
                                                        ->columnSpan(12),
                                                    Select::make('icon')
                                                        ->label('Icon')
                                                        ->options(static::getFontAwesomeIconOptions())
                                                        ->searchable()
                                                        ->allowHtml()
                                                        ->native(false)
                                                        ->required()
                                                        ->columnSpan(12),
                                                    Textarea::make('desc')
                                                        ->required()
                                                        ->rows(2)
                                                        ->placeholder('Impact details...')
                                                        ->columnSpan(12),
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
                                                        ->rows(4),
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
                                                ->rows(6)
                                                ->columnSpanFull(),
                                            Textarea::make('principal_bio')
                                                ->label("Principal's Full Bio / Background")
                                                ->rows(8)
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
                                                        ->rows(4),
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
                                                ->rows(6)
                                                ->columnSpanFull(),
                                            Textarea::make('vice_principal_bio')
                                                ->label("Vice Principal's Full Bio / Background")
                                                ->rows(8)
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
                                                        ->rows(4),
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
                                                ->rows(6)
                                                ->columnSpanFull(),
                                            Textarea::make('registrar_bio')
                                                ->label("Registrar's Full Bio / Background")
                                                ->rows(8)
                                                ->columnSpanFull(),
                                        ]),
                                ]),
                        ]),

                    // TAB 4: ADMISSIONS CONFIG
                    Tab::make('Admissions Config')
                        ->icon(Heroicon::OutlinedClipboardDocumentList)
                        ->schema([
                            Section::make('Admissions Configuration')
                                ->description('Configure how students apply to the institution.')
                                ->schema([
                                    Grid::make(2)
                                        ->schema([
                                            Toggle::make('admission_open')
                                                ->label('Admissions Status (Open / Closed)')
                                                ->helperText('Enable or disable admissions completely. When disabled, prospective students will see a notice that applications are currently closed.')
                                                ->live()
                                                ->columnSpan(2),

                                            Toggle::make('accept_admissions_online')
                                                ->label('Enable Internal Online Application Form')
                                                ->helperText('When enabled, students can apply directly on this website. When disabled, the internal form is hidden and the external link/instructions below will be shown instead.')
                                                ->live()
                                                ->hidden(fn (Get $get): bool => ! (bool) $get('admission_open'))
                                                ->columnSpan(2),

                                            TextInput::make('external_application_url')
                                                ->label('External Admission Portal Link')
                                                ->placeholder('e.g. https://portal.teresco.edu.gh')
                                                ->url()
                                                ->hidden(fn (Get $get): bool => ! (bool) $get('admission_open') || (bool) $get('accept_admissions_online'))
                                                ->columnSpan(2),
                                        ]),

                                    RichEditor::make('admission_requirements')
                                        ->label('Admission Instructions / Requirements')
                                        ->helperText('This rich text message will be displayed on the Admissions page to guide applicants when the internal online form is disabled.')
                                        ->extraInputAttributes(['style' => 'min-height: 400px;'])
                                        ->hidden(fn (Get $get): bool => ! (bool) $get('admission_open') || (bool) $get('accept_admissions_online'))
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
                                                        ->rows(6),
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
                                        ->rows(5)
                                        ->label('Physical Address')
                                        ->columnSpanFull(),

                                    TextInput::make('latitude')
                                        ->label('Latitude')
                                        ->placeholder('e.g. 5.7596')
                                        ->helperText(new HtmlString('To get this: Go to Google Maps, right-click your location, and click the numbers to copy both (e.g., <u>5.7596</u>, -0.2185). Paste the first number (<u>5.7596</u>) here.')),

                                    TextInput::make('longitude')
                                        ->label('Longitude')
                                        ->placeholder('e.g. -0.2185')
                                        ->helperText(new HtmlString('To get this: Go to Google Maps, right-click your location, and click the numbers to copy both (e.g., 5.7596, <u>-0.2185</u>). Paste the second number (<u>-0.2185</u>) here.')),
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

    public static function getFontAwesomeIconOptions(): array
    {
        $icons = [
            // Academic & Education
            'fa-graduation-cap' => 'Graduation Cap',
            'fa-book-open' => 'Book (Open)',
            'fa-book' => 'Book',
            'fa-chalkboard-teacher' => 'Teacher / Lecture',
            'fa-school' => 'School Building',
            'fa-university' => 'University / Campus',
            'fa-user-graduate' => 'Graduate / Student',
            'fa-certificate' => 'Certificate',
            'fa-award' => 'Award / Badge',
            'fa-trophy' => 'Trophy / Achievement',
            'fa-microscope' => 'Science / Lab',
            'fa-flask' => 'Chemistry / Experiment',
            'fa-calculator' => 'Math / Calculator',
            'fa-compass' => 'Compass / Navigation',
            'fa-globe' => 'Globe / Geography',
            'fa-globe-africa' => 'Globe (Africa)',
            'fa-palette' => 'Art / Palette',
            'fa-music' => 'Music / Note',
            'fa-pen-fancy' => 'Writing / Pen',
            'fa-atom' => 'Physics / Science',

            // Technology & Skills
            'fa-laptop-code' => 'Computer Science / Coding',
            'fa-microchip' => 'Electronics / Microchip',
            'fa-database' => 'Database / IT',
            'fa-network-wired' => 'Networking',
            'fa-server' => 'Servers / Hosting',
            'fa-tools' => 'Tools / Engineering',
            'fa-wrench' => 'Wrench / Mechanic',
            'fa-screwdriver' => 'Screwdriver / Assembly',
            'fa-cog' => 'Gear / Settings',
            'fa-cogs' => 'Gears / Process',
            'fa-lightbulb' => 'Innovation / Lightbulb',
            'fa-rocket' => 'Rocket / Launch',
            'fa-brain' => 'Brain / AI',

            // Business & Administration
            'fa-briefcase' => 'Career / Placement',
            'fa-handshake' => 'Partnerships',
            'fa-chart-line' => 'Growth / Chart',
            'fa-chart-bar' => 'Stats / Analytics',
            'fa-building' => 'Corporate / Office',
            'fa-users' => 'Community / Group',
            'fa-bullhorn' => 'Announcement / Marketing',
            'fa-calendar-alt' => 'Calendar / Events',
            'fa-clock' => 'Schedule / Time',
            'fa-envelope' => 'Email / Inbox',
            'fa-phone-alt' => 'Phone / Contact',
            'fa-shield-alt' => 'Security / Safety',
            'fa-user-shield' => 'Security / Safeguarding',
            'fa-gavel' => 'Governance / Law',
            'fa-map-marked-alt' => 'Campus Map',
            'fa-check-circle' => 'Verification / Check',

            // Student Life & Recreation
            'fa-running' => 'Sports / Athletics',
            'fa-dumbbell' => 'Gym / Fitness',
            'fa-campground' => 'Camping / Outdoor',
            'fa-theater-masks' => 'Drama / Theater',
            'fa-comments' => 'Discussion / Forums',
            'fa-hands-helping' => 'Support / Help',
            'fa-hand-holding-heart' => 'Donation / Giving',
            'fa-hand-holding-usd' => 'Financial Aid / Scholarship',
            'fa-heart' => 'Heart / Care',
            'fa-seedling' => 'Growth / Environment',
            'fa-leaf' => 'Ecology / Sustainability',
            'fa-wifi' => 'WiFi / Connectivity',
            'fa-coffee' => 'Cafe / Lounge',
            'fa-utensils' => 'Cafeteria / Food',
        ];

        $options = [];
        foreach ($icons as $class => $label) {
            $options[$class] = "<span style='display: flex; align-items: center; gap: 8px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;'><i class='fas {$class}' style='width: 20px; text-align: center; color: #ea580c; flex-shrink: 0;'></i> <span>{$label}</span></span>";
        }

        return $options;
    }
}
