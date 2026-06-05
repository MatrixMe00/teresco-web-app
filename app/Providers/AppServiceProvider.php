<?php

namespace App\Providers;

use App\Models\Department;
use App\Models\Institution;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register custom admin stylesheet for premium UI overrides (buttons, modals, etc.)
        FilamentAsset::register([
            Css::make('custom-admin-theme', public_path('css/custom-admin.css')),
        ]);

        // Share institution and departments with all views using view composer
        View::composer('*', function ($view) {
            $institution = Institution::first() ?? (object) [
                'name' => 'St. Theresa\'s College of Education',
                'logo' => null,
                'primary_color' => '#ea580c',
                'primary_color_rgb' => '234,88,12',
                'phone' => '+254758660300',
                'email' => 'info@teresco.edu.gh',
                'welcome_message' => 'Welcome to our college.',
                'facebook' => '#',
                'tiktok' => '#',
                'x' => '#',
                'youtube' => '#',
                'motto' => 'Excellence in Technical Education',
                'vision' => 'To be a center of excellence.',
                'mission' => 'To provide quality technical education.',
                'principal_name' => 'Mr. David M. Kariuki',
                'principal_photo' => null,
                'principal_bio' => 'Biography details not configured.',
                'principal_qualifications' => 'M.Ed, B.Ed',
                'principal_message' => 'Welcome message from Principal',
                'vice_principal_name' => 'Vice Principal',
                'vice_principal_photo' => null,
                'vice_principal_bio' => 'Biography details not configured.',
                'vice_principal_qualifications' => 'M.Ed, B.Ed',
                'vice_principal_message' => 'Welcome message from Vice Principal',
                'registrar_name' => 'Registrar',
                'registrar_photo' => null,
                'registrar_bio' => 'Biography details not configured.',
                'registrar_qualifications' => 'M.Ed, B.Ed',
                'registrar_message' => 'Welcome message from Registrar',
                'address' => 'P.O. Box 123, Tetu',
                'charter_title' => 'Service Charter',
                'charter_description' => 'Our commitment to providing quality services.',
                'charter_items' => [],
                'charter_download_file' => null,
                'charter_audio_file' => null,
                'charter_image' => null,
                'about_us' => 'Learn more about us.',
                'about_us_image' => null,
                'stats' => [],
                'timeline' => [],
                'core_values' => [],
                'community_impact' => [],
                'admission_open' => true,
                'admission_link' => null,
                'admission_description' => '<p>Internal applications are open.</p>',
                'footer_description' => 'St. Theresa\'s College of Education',
                'footer_note' => 'St. Theresa\'s College of Education. All Rights Reserved.',
            ];
            $view->with('institution', $institution);
            $view->with('departments', Department::all());
        });
    }
}
