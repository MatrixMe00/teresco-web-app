<?php

use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Institution;

new
#[Title("Service Charter")]
#[Layout('layouts::app')]
class extends Component
{
    public function with()
    {
        return [
            'institution' => Institution::first()
        ];
    }
};
?>

<main class="overflow-hidden">

    <!-- Hero Section -->
    <section class="relative clip-diagonal grain py-20 overflow-hidden bg-gray-900">
        <div class="absolute inset-0 z-0">
            <img src="{{ $institution->charter_image ? asset('storage/' . $institution->charter_image) : asset('images/gate.jpg') }}" alt="Campus"
                class="object-cover w-full h-full opacity-30">
            <div class="absolute inset-0 bg-gradient-to-b from-gray-900/70 to-gray-900/90"></div>
        </div>
        <div class="container relative z-10 px-4 mx-auto text-center">
            <span class="inline-block px-4 py-1.5 rounded-full bg-primary/20 text-primary text-xs font-bold tracking-widest uppercase mb-4" data-aos="fade-down">Commitment to Service</span>
            <h1 class="hero-display mb-4 text-4xl font-bold text-white md:text-5xl lg:text-6xl" data-aos="fade-up">{{ $institution->charter_title ?? 'Service Charter' }}</h1>
            <p class="max-w-2xl mx-auto text-lg text-gray-300 md:text-xl" data-aos="fade-up" data-aos-delay="100">Our promise of accountability, transparency, and excellence.</p>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-12 items-start">
                
                <!-- Left Column: Details & Table -->
                <div class="lg:col-span-8 space-y-8" data-aos="fade-right">
                    
                    <div class="bg-white p-8 rounded-2xl shadow-md border border-gray-100">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Our Service Commitments</h2>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            {{ $institution->charter_description ?? 'We are dedicated to providing the highest quality technical training, vocational education and community services.' }}
                        </p>

                        <!-- Services Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-primary text-white text-sm font-semibold">
                                        <th class="p-4 rounded-tl-xl">Service / Standard</th>
                                        <th class="p-4">Timeline / Target</th>
                                        <th class="p-4 rounded-tr-xl">Cost</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 text-sm">
                                    @forelse($institution->charter_items ?? [] as $item)
                                        <tr class="hover:bg-primary/5 transition-colors">
                                            <td class="p-4 font-medium text-gray-900">{{ $item['service'] ?? '' }}</td>
                                            <td class="p-4 text-gray-600">{{ $item['timeline'] ?? '' }}</td>
                                            <td class="p-4 text-gray-700 font-semibold">{{ $item['cost'] ?? 'Free' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="p-8 text-center text-gray-500">No charter items configured.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Sidebar / Action Center -->
                <div class="lg:col-span-4 space-y-6" data-aos="fade-left">
                    
                    <!-- Media Download Card -->
                    <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100 text-center space-y-6">
                        <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center mx-auto text-primary text-2xl">
                            <i class="fas fa-file-pdf"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Document & Audio Resources</h3>
                            <p class="text-sm text-gray-500 mt-1">Access the official Service Charter document and audio guide.</p>
                        </div>

                        <div class="flex flex-col gap-3">
                            @if($institution->charter_download_file)
                                <a href="{{ asset('storage/' . $institution->charter_download_file) }}" target="_blank"
                                    class="flex items-center justify-center gap-2 w-full py-3 bg-primary text-white font-semibold rounded-xl hover:brightness-110 transition-all shadow-md shadow-primary/20">
                                    <i class="fas fa-download"></i> Download Official PDF
                                </a>
                            @else
                                <span class="text-sm text-gray-400 italic">No PDF document uploaded.</span>
                            @endif

                            @if($institution->charter_audio_file)
                                <div x-data="{ playing: false, audio: null }" class="w-full">
                                    <button @click="if(!audio) { audio = new Audio('{{ asset('storage/' . $institution->charter_audio_file) }}') }; if(playing) { audio.pause(); playing = false; } else { audio.play(); playing = true; }"
                                        class="flex items-center justify-center gap-2 w-full py-3 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-all">
                                        <i class="fas" :class="playing ? 'fa-pause' : 'fa-play'"></i>
                                        <span x-text="playing ? 'Pause Audio Guide' : 'Listen to Audio Guide'">Listen to Audio Guide</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Campus Image Display -->
                    <div class="bg-white rounded-2xl overflow-hidden shadow-md border border-gray-100">
                        <img src="{{ $institution->charter_image ? asset('storage/' . $institution->charter_image) : asset('images/gate.jpg') }}" alt="Service Charter"
                            class="w-full h-auto object-cover aspect-[4/3]">
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
