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
            'principal_name' => 'Mr. David M. Kariuki',
            'principal_photo' => '',
            'welcome_message' => 'Welcome to Teresco - Empowering futures through technical education excellence.',
            'motto' => 'TVET skills for industrial growth.',
            'vision' => 'To be the premier technical and vocational institution for self and global development.',
            'mission' => 'To confer holistic technical training through research, innovation and consultancy for sustainable development.',
            'about_us' => "St Theresa's College of Education is committed to providing quality education and training to empower students for successful careers. Established in March 2019 by the Government of Ghana, we have grown from an initial enrollment of 89 students to become a recognized institution for technical education in the region.\n\nWe are dedicated to providing equitable access to technical education, fostering innovation, and producing socially responsible graduates with the skills and entrepreneurial spirit necessary for development and global competitiveness.",
            'primary_color' => '#7A4B7D',
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
            'established_year' => '2019',
            'about_us_image' => '',
            'stats' => [
                ['value' => '1800', 'suffix' => '+', 'label' => 'Students Enrolled', 'icon' => 'fa-user-graduate'],
                ['value' => '15', 'suffix' => '+', 'label' => 'Technical Programs', 'icon' => 'fa-book'],
                ['value' => '45', 'suffix' => '+', 'label' => 'Qualified Instructors', 'icon' => 'fa-chalkboard-teacher'],
                ['value' => '92', 'suffix' => '%', 'label' => 'Graduate Employment', 'icon' => 'fa-briefcase'],
            ],
            'timeline' => [
                ['year' => 'March 2019', 'title' => 'Establishment', 'desc' => 'Establishment of Teresco by the Government of Ghana.'],
                ['year' => '2019-2020', 'title' => 'Initial Growth', 'desc' => 'Growth from initial enrollment of 89 students to become a recognized institution for technical education in the region.'],
                ['year' => 'February 2022', 'title' => 'Strategic Plan', 'desc' => 'Launch of our Strategic Plan (2020-2025) aligning with MoE and TVETA strategic objectives for institutional excellence.'],
                ['year' => 'Present Day', 'title' => 'Continued Excellence', 'desc' => 'Continuing our mission of community engagement, environmental initiatives, and developing industry-aligned technical education.'],
            ],
            'community_impact' => [
                ['title' => 'Economic Development', 'desc' => 'Providing employment opportunities for local professionals and sourcing produce from local farmers to support the community economy.', 'icon' => 'fa-chart-line'],
                ['title' => 'Environmental Initiatives', 'desc' => 'Promoting sustainable practices through tree seedling distribution and educational programs on environmental conservation.', 'icon' => 'fa-leaf'],
                ['title' => 'Agricultural Innovation', 'desc' => 'Encouraging avocado farming and other agricultural practices to enhance food security and create sustainable livelihoods.', 'icon' => 'fa-seedling'],
            ],
            'core_values' => [
                ['title' => 'Excellence', 'desc' => 'Pursuing the highest standards in all our academic and operational activities.', 'icon' => 'fa-check-circle'],
                ['title' => 'Integrity', 'desc' => 'Upholding honesty, transparency and ethical conduct in all our actions.', 'icon' => 'fa-user-shield'],
                ['title' => 'Innovation', 'desc' => 'Embracing creativity and forward-thinking approaches to educational challenges.', 'icon' => 'fa-lightbulb'],
                ['title' => 'Inclusivity', 'desc' => 'Fostering a diverse and inclusive environment where all individuals can thrive.', 'icon' => 'fa-globe-africa'],
            ],
            'principal_bio' => 'Dedicated to excellence and leadership in education, Mr. David M. Kariuki is an inspiring figure at the helm of Teresco.',
            'principal_qualifications' => 'M.Ed. in Educational Leadership, B.Ed. in Technical Education',
            'vice_principal_name' => 'Joshua Mwangi',
            'vice_principal_photo' => '',
            'vice_principal_bio' => 'Supporting our institution\'s vision and daily operations, ensuring a high-quality educational experience.',
            'vice_principal_qualifications' => 'M.Sc. in Engineering, B.Sc. in Electrical Engineering',
            'vice_principal_message' => 'Welcome to the Administration Office. Our department is dedicated to ensuring efficient institutional operations, student welfare, and administrative excellence. We work tirelessly to create an enabling environment for teaching and learning.',
            'registrar_name' => 'Lydia Ndirangu',
            'registrar_photo' => '',
            'registrar_bio' => 'Overseeing academic records, student registration, and admissions with precision and dedication.',
            'registrar_qualifications' => 'M.A. in Administration, B.A. in Communications',
            'registrar_message' => 'Welcome to the Academic Registrar\'s Office. We are here to support your academic journey from application to graduation.',
            'charter_title' => 'Service Charter',
            'charter_description' => 'Our commitment to excellence in service delivery to all our clients.',
            'charter_items' => [
                ['service' => 'Customer Care Desk', 'timeline' => 'Immediate response to inquiries, complaints, and requests', 'cost' => 'Free'],
                ['service' => 'Student Enrollment & Admission', 'timeline' => 'Processing application and sending letters within 7 days', 'cost' => 'Free'],
                ['service' => 'Examinations & Certification', 'timeline' => 'Release of internal results within 2 weeks of completion', 'cost' => 'Free'],
                ['service' => 'Issuance of Certificates/Transcripts', 'timeline' => 'Processed within 3 days upon clearance', 'cost' => 'Free'],
            ],
            'charter_download_file' => '',
            'charter_audio_file' => '',
            'charter_image' => '',
            'accept_admissions_online' => true,
            'admission_fields_config' => [
                'require_alternative_phone' => false,
                'require_high_school' => true,
                'require_nemis_upi' => false,
                'require_parent_details' => true,
            ],
            'external_application_url' => 'https://admissions.teresco.edu.gh',
            'admission_requirements' => '<p>To be admitted to Teresco, applicants must meet the following minimum requirements:</p><ul><li>Mean Grade of C- (Minus) and above for Diploma programs.</li><li>Mean Grade of D (Plain) and above for Certificate programs.</li><li>Copy of KCSE Result Slip / Certificate.</li><li>Copy of National ID card or Birth Certificate.</li></ul>',
            'admission_procedures' => '<p>Follow this procedure to complete your application:</p><ol><li>Visit our external application portal.</li><li>Create an account or log in with your credentials.</li><li>Select your preferred course/program of study.</li><li>Upload scanned copies of all required academic documents.</li><li>Submit the application fee and complete your registration.</li></ol>',
            'admission_guide' => '<p>Here is a step-by-step guide to applying online:</p><ol><li>Step 1: Check your eligibility against our requirements.</li><li>Step 2: Prepare clear digital scans of your ID/Birth certificate and KCSE slip.</li><li>Step 3: Access the portal using the "Apply Now" button.</li><li>Step 4: Receive your admission letter via email after review.</li></ol>',
            'footer_description' => 'Teresco is committed to providing quality education and training to empower students for successful careers.',
            'footer_copyright' => '© {year} Teresco. Crafted by Titus Tum.',
        ]);
    }
}
