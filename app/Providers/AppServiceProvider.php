<?php

namespace App\Providers;

use App\Models\Department;
use App\Models\Institution;
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
                'address' => 'P.O. Box 123, Tetu',
            ];
            $view->with('institution', $institution);
            $view->with('departments', Department::all());
        });
    }
}
