<?php

namespace Database\Seeders;

use App\Models\AdmissionList;
use Illuminate\Database\Seeder;

class AdmissionListSeeder extends Seeder
{
    public function run(): void
    {
        $lists = [
            [
                'title' => 'September 2026 First Batch Admission List',
                'academic_year' => '2026/2027',
                'description' => 'First list of successfully admitted students for the September 2026 intake.',
                'pdf_file' => 'admission_lists/sept_2026_first_batch.pdf',
                'is_published' => true,
                'published_at' => now(),
            ],
            [
                'title' => 'September 2026 Second Batch Admission List',
                'academic_year' => '2026/2027',
                'description' => 'Second list of successfully admitted students for the September 2026 intake.',
                'pdf_file' => 'admission_lists/sept_2026_second_batch.pdf',
                'is_published' => true,
                'published_at' => now()->addDays(2),
            ],
            [
                'title' => 'January 2027 Admission List (Draft)',
                'academic_year' => '2026/2027',
                'description' => 'Draft list of successfully admitted students for the January 2027 intake.',
                'pdf_file' => 'admission_lists/jan_2027.pdf',
                'is_published' => false,
                'published_at' => null,
            ],
        ];

        foreach ($lists as $list) {
            AdmissionList::create($list);
        }
    }
}
