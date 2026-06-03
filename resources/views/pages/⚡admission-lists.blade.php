<?php

use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\AdmissionList;
use App\Models\Institution;

new
#[Title("Admission Lists")]
#[Layout('layouts::app')]
class extends Component
{
    public function with()
    {
        return [
            'institution' => Institution::first(),
            'admissionLists' => AdmissionList::where('is_published', true)
                ->orderBy('published_at', 'desc')
                ->get()
        ];
    }
};
?>

<main class="overflow-hidden">

    <!-- Hero Section -->
    <section class="relative clip-diagonal grain py-20 overflow-hidden bg-gray-900">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/gate.jpg') }}" alt="Campus"
                class="object-cover w-full h-full opacity-30">
            <div class="absolute inset-0 bg-gradient-to-b from-gray-900/70 to-gray-900/90"></div>
        </div>
        <div class="container relative z-10 px-4 mx-auto text-center">
            <span class="inline-block px-4 py-1.5 rounded-full bg-primary/20 text-primary text-xs font-bold tracking-widest uppercase mb-4" data-aos="fade-down">Admissions Office</span>
            <h1 class="hero-display mb-4 text-4xl font-bold text-white md:text-5xl lg:text-6xl" data-aos="fade-up">Admission Lists</h1>
            <p class="max-w-2xl mx-auto text-lg text-gray-300 md:text-xl" data-aos="fade-up" data-aos-delay="100">Find official publications of successfully admitted candidates.</p>
        </div>
    </section>

    <!-- Lists Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-6">
                @forelse($admissionLists as $list)
                    <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100 flex flex-col md:flex-row items-start md:items-center justify-between gap-6 hover:shadow-lg transition-shadow duration-300" data-aos="fade-up">
                        <div class="space-y-2">
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="px-2.5 py-0.5 rounded-full bg-primary/10 text-primary text-xs font-bold uppercase">{{ $list->academic_year }} Academic Year</span>
                                <span class="text-xs text-gray-400">Published: {{ $list->published_at?->format('M d, Y') }}</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">{{ $list->title }}</h3>
                            @if($list->description)
                                <p class="text-gray-500 text-sm leading-relaxed">{{ $list->description }}</p>
                            @endif
                        </div>
                        <div class="shrink-0 w-full md:w-auto">
                            <a href="{{ asset('storage/' . $list->pdf_file) }}" target="_blank"
                                class="flex items-center justify-center gap-2 px-6 py-3 bg-primary text-white font-semibold rounded-xl hover:brightness-110 transition-all shadow-md shadow-primary/15">
                                <i class="fas fa-file-pdf"></i> Download PDF
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="bg-white p-12 rounded-2xl shadow-md border border-gray-100 text-center" data-aos="fade-up">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto text-gray-400 text-2xl mb-4">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">No Published Admission Lists</h3>
                        <p class="text-sm text-gray-500 mt-1">Please check back later or contact the Academic Registrar's office.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</main>
