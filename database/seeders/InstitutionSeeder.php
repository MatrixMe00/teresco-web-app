<?php

namespace Database\Seeders;

use App\Models\Institution;
use Illuminate\Database\Seeder;

class InstitutionSeeder extends Seeder
{
    public function run(): void
    {
        Institution::create([
            'name' => 'Teresco',
            'logo' => '',
            'principal_name' => '',
            'principal_photo' => '',
            'welcome_message' => 'Welcome to Teresco - Empowering futures through technical education excellence.',
            'motto' => 'TVET skills for industrial growth.',
            'vision' => 'To be the premier technical and vocational institution for self and global development.',
            'mission' => 'To confer holistic technical training through research, innovation and consultancy for sustainable development.',
            'about_us' => "St Theresa's College of Education is committed to providing quality education and training to empower students for successful careers. Established in March 2019 by the Government of Ghana, we have grown from an initial enrollment of 89 students to become a recognized institution for technical education in the region.\n\nOur Core Values:\n- Excellence: Pursuing the highest standards in all our academic and operational activities.\n- Integrity: Upholding honesty, transparency and ethical conduct in all our actions.\n- Innovation: Embracing creativity and forward-thinking approaches to educational challenges.\n- Inclusivity: Fostering a diverse and inclusive environment where all individuals can thrive.\n\nWe are dedicated to providing equitable access to technical education, fostering innovation, and producing socially responsible graduates with the skills and entrepreneurial spirit necessary for Kenya's development and global competitiveness.",
            'primary_color' => '#FF5722',
            'primary_font' => 'Plus Jakarta Sans',
            'phone' => '+254 758 660 300',
            'email' => 'info@teresco.edu.gh',
            'address' => 'P.O. Box AS 1234, Accra, Ghana',
            'latitude' => '-0.4675303140845334',
            'longitude' => '36.92292676763264',
            'facebook' => '#',
            'tiktok' => '#',
            'x' => '#',
            'youtube' => '#',
        ]);
    }
}
