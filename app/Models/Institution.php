<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $fillable = [
        'name',
        'logo',
        'principal_name',
        'principal_photo',
        'welcome_message',
        'about_us',
        'primary_color',
        'primary_font',
        'motto',
        'vision',
        'mission',
        'phone',
        'email',
        'facebook',
        'tiktok',
        'x',
        'youtube',
        'latitude',
        'longitude',
        'established_year',
        'about_us_image',
        'stats',
        'timeline',
        'community_impact',
        'core_values',
        'principal_bio',
        'principal_qualifications',
        'vice_principal_name',
        'vice_principal_photo',
        'vice_principal_bio',
        'vice_principal_qualifications',
        'vice_principal_message',
        'registrar_name',
        'registrar_photo',
        'registrar_bio',
        'registrar_qualifications',
        'registrar_message',
        'charter_title',
        'charter_description',
        'charter_items',
        'charter_download_file',
        'charter_audio_file',
        'charter_image',
        'admission_open',
        'accept_admissions_online',
        'admission_fields_config',
        'external_application_url',
        'admission_requirements',
        'admission_procedures',
        'admission_guide',
        'footer_description',
        'footer_copyright',
        'about_hero_subtitle',
        'about_us_title',
        'values_title',
        'values_description',
        'journey_title',
        'journey_description',
        'impact_title',
        'impact_description',
        'show_values_section',
        'show_stats_section',
        'show_journey_section',
        'show_impact_section',
        'hero_badge',
        'hero_description',
        'history_title',
        'history_description',
        'history_image',
        'homepage_stats',
    ];

    protected $casts = [
        'stats' => 'array',
        'timeline' => 'array',
        'community_impact' => 'array',
        'core_values' => 'array',
        'charter_items' => 'array',
        'admission_fields_config' => 'array',
        'admission_open' => 'boolean',
        'accept_admissions_online' => 'boolean',
        'show_values_section' => 'boolean',
        'show_stats_section' => 'boolean',
        'show_journey_section' => 'boolean',
        'show_impact_section' => 'boolean',
        'homepage_stats' => 'array',
    ];

    public function getPrimaryColorRgbAttribute()
    {
        return $this->hex2rgb($this->primary_color);
    }

    private function hex2rgb($hex)
    {
        $hex = str_replace('#', '', $hex);

        if (strlen($hex) == 3) {
            $r = hexdec(str_repeat($hex[0], 2));
            $g = hexdec(str_repeat($hex[1], 2));
            $b = hexdec(str_repeat($hex[2], 2));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }

        return "$r, $g, $b";
    }
}
