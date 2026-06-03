<?php

namespace App\Filament\Resources\Institutions\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class InstitutionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make()
                ->columnSpanFull()
                ->schema([

                    // SECTION 1: IDENTITY & BRANDING
                    Section::make('Institution Identity & Branding')
                        ->description('Basic institutional profile, colors and logo')
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

                    // SECTION 2: ABOUT US
                    Section::make('About Us Page Content')
                        ->description('Configure dynamic content for the About Us page')
                        ->schema([
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

                            Repeater::make('stats')
                                ->label('Institutional Stats Counters')
                                ->grid(2)
                                ->schema([
                                    TextInput::make('value')->required()->placeholder('e.g. 500'),
                                    TextInput::make('suffix')->placeholder('e.g. + or %'),
                                    TextInput::make('label')->required()->placeholder('e.g. Students Enrolled'),
                                    TextInput::make('icon')->required()->placeholder('e.g. fa-user-graduate'),
                                ])
                                ->columnSpanFull(),

                            Repeater::make('timeline')
                                ->label('Institutional Timeline / History')
                                ->schema([
                                    TextInput::make('year')->required()->placeholder('e.g. 2019'),
                                    TextInput::make('title')->required()->placeholder('e.g. Establishment'),
                                    Textarea::make('desc')->required()->rows(2)->placeholder('Description of milestones...'),
                                ])
                                ->columnSpanFull(),

                            Repeater::make('core_values')
                                ->label('Core Values')
                                ->grid(2)
                                ->schema([
                                    TextInput::make('title')->required()->placeholder('e.g. Excellence'),
                                    Textarea::make('desc')->required()->rows(2)->placeholder('Value description...'),
                                    TextInput::make('icon')->required()->placeholder('e.g. fa-check-circle'),
                                ])
                                ->columnSpanFull(),

                            Repeater::make('community_impact')
                                ->label('Community Impact Areas')
                                ->grid(2)
                                ->schema([
                                    TextInput::make('title')->required()->placeholder('e.g. Economic Development'),
                                    Textarea::make('desc')->required()->rows(2)->placeholder('Impact details...'),
                                    TextInput::make('icon')->required()->placeholder('e.g. fa-chart-line'),
                                ])
                                ->columnSpanFull(),
                        ]),

                    // SECTION 3: LEADERSHIP PROFILES
                    Section::make('Leadership Profiles')
                        ->description('Configure administrative roles, bios, and quotes')
                        ->schema([

                            // Principal
                            Section::make("Principal's Profile")
                                ->columns(2)
                                ->schema([
                                    TextInput::make('principal_name')->label("Principal's Name"),
                                    FileUpload::make('principal_photo')->label("Principal's Photo")->image()->avatar()->disk('public')->directory('leadership'),
                                    Textarea::make('principal_qualifications')->label("Principal's Qualifications")->rows(2)->columnSpanFull(),
                                    Textarea::make('principal_message')->label("Principal's Message / Quote")->rows(3)->columnSpanFull(),
                                    Textarea::make('principal_bio')->label("Principal's Full Bio / Background")->rows(4)->columnSpanFull(),
                                ]),

                            // Vice Principal
                            Section::make("Vice Principal's Profile")
                                ->columns(2)
                                ->schema([
                                    TextInput::make('vice_principal_name')->label("Vice Principal's Name"),
                                    FileUpload::make('vice_principal_photo')->label("Vice Principal's Photo")->image()->avatar()->disk('public')->directory('leadership'),
                                    Textarea::make('vice_principal_qualifications')->label("Vice Principal's Qualifications")->rows(2)->columnSpanFull(),
                                    Textarea::make('vice_principal_message')->label("Vice Principal's Message / Quote")->rows(3)->columnSpanFull(),
                                    Textarea::make('vice_principal_bio')->label("Vice Principal's Full Bio / Background")->rows(4)->columnSpanFull(),
                                ]),

                            // Registrar
                            Section::make("Registrar's Profile")
                                ->columns(2)
                                ->schema([
                                    TextInput::make('registrar_name')->label("Registrar's Name"),
                                    FileUpload::make('registrar_photo')->label("Registrar's Photo")->image()->avatar()->disk('public')->directory('leadership'),
                                    Textarea::make('registrar_qualifications')->label("Registrar's Qualifications")->rows(2)->columnSpanFull(),
                                    Textarea::make('registrar_message')->label("Registrar's Message / Quote")->rows(3)->columnSpanFull(),
                                    Textarea::make('registrar_bio')->label("Registrar's Full Bio / Background")->rows(4)->columnSpanFull(),
                                ]),
                        ]),

                    // SECTION 4: ADMISSIONS
                    Section::make('Admissions Configuration')
                        ->description('Toggle admissions portal type and instructions')
                        ->schema([
                            Toggle::make('admission_open')
                                ->label('Open Admissions / Use Internal Application Form')
                                ->live(),

                            TextInput::make('admission_link')
                                ->label('External Admission Portal Link')
                                ->placeholder('e.g. https://portal.teresco.edu.gh')
                                ->columnSpanFull(),

                            RichEditor::make('admission_description')
                                ->label('Admission Instructions / Requirements (Displayed when internal form is closed)')
                                ->columnSpanFull(),
                        ]),

                    // SECTION 5: SERVICE CHARTER
                    Section::make('Service Charter')
                        ->description('Configure the institutional Service Charter details')
                        ->schema([
                            TextInput::make('charter_title')
                                ->label('Charter Page Title')
                                ->default('Service Charter'),

                            Textarea::make('charter_description')
                                ->label('Charter Page Introduction')
                                ->rows(3),

                            FileUpload::make('charter_image')
                                ->label('Charter Cover Image')
                                ->image()
                                ->disk('public')
                                ->directory('charter'),

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

                            Repeater::make('charter_items')
                                ->label('Service Charter Items')
                                ->schema([
                                    TextInput::make('service')->required()->placeholder('e.g. Admissions Processing'),
                                    TextInput::make('timeline')->required()->placeholder('e.g. Within 14 days'),
                                    TextInput::make('cost')->default('Free')->placeholder('e.g. Free'),
                                ])
                                ->columnSpanFull(),
                        ]),

                    // SECTION 6: FOOTER
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

                    // SECTION 7: CONTACTS & SOCIALS
                    Section::make('Contact & Social Media Information')
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
        ]);
    }
}
