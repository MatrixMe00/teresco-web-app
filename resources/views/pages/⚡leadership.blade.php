<?php

use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Institution;

new
#[Title("Leadership Profile")]
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

<main class="overflow-hidden bg-gray-50">

    <!-- Hero Section -->
    <section class="relative clip-diagonal grain py-20 overflow-hidden bg-gray-900">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/gate.jpg') }}" alt="Campus"
                class="object-cover w-full h-full opacity-30">
            <div class="absolute inset-0 bg-gradient-to-b from-gray-900/70 to-gray-900/90"></div>
        </div>
        <div class="container relative z-10 px-4 mx-auto text-center">
            <span class="inline-block px-4 py-1.5 rounded-full bg-primary/20 text-primary text-xs font-bold tracking-widest uppercase mb-4" data-aos="fade-down">Institutional Administration</span>
            <h1 class="hero-display mb-4 text-4xl font-bold text-white md:text-5xl lg:text-6xl" data-aos="fade-up">Our Leadership</h1>
            <p class="max-w-2xl mx-auto text-lg text-gray-300 md:text-xl" data-aos="fade-up" data-aos-delay="100">Meet the administrative leaders guiding our college towards academic and technical excellence.</p>
        </div>
    </section>

    <!-- Leadership Profiles -->
    <section class="py-20 space-y-24">
        <div class="max-w-7xl mx-auto px-4 lg:px-8">
            
            <!-- Principal's Profile (Image Left) -->
            <div class="grid gap-12 lg:grid-cols-12 items-start" data-aos="fade-up">
                <div class="lg:col-span-4 text-center lg:text-left space-y-4">
                    <div class="relative inline-block w-64 h-64 lg:w-full lg:h-auto aspect-square lg:aspect-[3/4] rounded-2xl overflow-hidden shadow-lg border-4 border-white bg-white">
                        <img src="{{ $institution->principal_photo ? asset('storage/' . $institution->principal_photo) : asset('images/default-avatar.jpg') }}" 
                            alt="{{ $institution->principal_name ?? 'Principal' }}" 
                            class="object-cover w-full h-full">
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">{{ $institution->principal_name ?? 'Principal Name' }}</h2>
                        <p class="text-primary font-semibold text-sm uppercase tracking-wider">Principal</p>
                    </div>
                    @if($institution->principal_qualifications)
                        <div class="bg-primary/5 p-4 rounded-xl text-left border border-primary/10">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-primary mb-1">Qualifications</h4>
                            <p class="text-xs text-gray-700 leading-relaxed">{{ $institution->principal_qualifications }}</p>
                        </div>
                    @endif
                </div>
                
                <div class="lg:col-span-8 space-y-6">
                    @if($institution->principal_message)
                        <div class="relative bg-white p-8 rounded-2xl shadow-md border-l-4 border-primary">
                            <i class="fas fa-quote-left text-3xl text-primary/15 absolute top-4 left-4"></i>
                            <h3 class="text-lg font-bold text-gray-900 mb-3">Principal's Message</h3>
                            <p class="text-gray-600 italic leading-relaxed text-sm relative z-10">
                                "{{ $institution->principal_message }}"
                            </p>
                        </div>
                    @endif
                    
                    <div class="bg-white p-8 rounded-2xl shadow-md space-y-4">
                        <h3 class="text-lg font-bold text-gray-900">Professional Profile & Bio</h3>
                        <p class="text-gray-600 text-sm leading-relaxed whitespace-pre-line">
                            {{ $institution->principal_bio ?? 'Biography details not configured.' }}
                        </p>
                    </div>
                </div>
            </div>

            <hr class="border-gray-200 my-16">

            <!-- Vice Principal's Profile (Image Right) -->
            <div class="grid gap-12 lg:grid-cols-12 items-start" data-aos="fade-up">
                <!-- Mobile/Desktop Order swap: photo goes left on mobile, right on desktop -->
                <div class="lg:col-span-8 space-y-6 lg:order-1 order-2">
                    @if($institution->vice_principal_message)
                        <div class="relative bg-white p-8 rounded-2xl shadow-md border-l-4 border-primary">
                            <i class="fas fa-quote-left text-3xl text-primary/15 absolute top-4 left-4"></i>
                            <h3 class="text-lg font-bold text-gray-900 mb-3">Vice Principal's Message</h3>
                            <p class="text-gray-600 italic leading-relaxed text-sm relative z-10">
                                "{{ $institution->vice_principal_message }}"
                            </p>
                        </div>
                    @endif
                    
                    <div class="bg-white p-8 rounded-2xl shadow-md space-y-4">
                        <h3 class="text-lg font-bold text-gray-900">Professional Profile & Bio</h3>
                        <p class="text-gray-600 text-sm leading-relaxed whitespace-pre-line">
                            {{ $institution->vice_principal_bio ?? 'Biography details not configured.' }}
                        </p>
                    </div>
                </div>

                <div class="lg:col-span-4 text-center lg:text-left space-y-4 lg:order-2 order-1">
                    <div class="relative inline-block w-64 h-64 lg:w-full lg:h-auto aspect-square lg:aspect-[3/4] rounded-2xl overflow-hidden shadow-lg border-4 border-white bg-white">
                        <img src="{{ $institution->vice_principal_photo ? asset('storage/' . $institution->vice_principal_photo) : asset('images/default-avatar.jpg') }}" 
                            alt="{{ $institution->vice_principal_name ?? 'Vice Principal' }}" 
                            class="object-cover w-full h-full">
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">{{ $institution->vice_principal_name ?? 'Vice Principal Name' }}</h2>
                        <p class="text-primary font-semibold text-sm uppercase tracking-wider">Vice Principal</p>
                    </div>
                    @if($institution->vice_principal_qualifications)
                        <div class="bg-primary/5 p-4 rounded-xl text-left border border-primary/10">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-primary mb-1">Qualifications</h4>
                            <p class="text-xs text-gray-700 leading-relaxed">{{ $institution->vice_principal_qualifications }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <hr class="border-gray-200 my-16">

            <!-- Registrar's Profile (Image Left) -->
            <div class="grid gap-12 lg:grid-cols-12 items-start" data-aos="fade-up">
                <div class="lg:col-span-4 text-center lg:text-left space-y-4">
                    <div class="relative inline-block w-64 h-64 lg:w-full lg:h-auto aspect-square lg:aspect-[3/4] rounded-2xl overflow-hidden shadow-lg border-4 border-white bg-white">
                        <img src="{{ $institution->registrar_photo ? asset('storage/' . $institution->registrar_photo) : asset('images/default-avatar.jpg') }}" 
                            alt="{{ $institution->registrar_name ?? 'Registrar' }}" 
                            class="object-cover w-full h-full">
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">{{ $institution->registrar_name ?? 'Registrar Name' }}</h2>
                        <p class="text-primary font-semibold text-sm uppercase tracking-wider">Registrar</p>
                    </div>
                    @if($institution->registrar_qualifications)
                        <div class="bg-primary/5 p-4 rounded-xl text-left border border-primary/10">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-primary mb-1">Qualifications</h4>
                            <p class="text-xs text-gray-700 leading-relaxed">{{ $institution->registrar_qualifications }}</p>
                        </div>
                    @endif
                </div>
                
                <div class="lg:col-span-8 space-y-6">
                    @if($institution->registrar_message)
                        <div class="relative bg-white p-8 rounded-2xl shadow-md border-l-4 border-primary">
                            <i class="fas fa-quote-left text-3xl text-primary/15 absolute top-4 left-4"></i>
                            <h3 class="text-lg font-bold text-gray-900 mb-3">Registrar's Message</h3>
                            <p class="text-gray-600 italic leading-relaxed text-sm relative z-10">
                                "{{ $institution->registrar_message }}"
                            </p>
                        </div>
                    @endif
                    
                    <div class="bg-white p-8 rounded-2xl shadow-md space-y-4">
                        <h3 class="text-lg font-bold text-gray-900">Professional Profile & Bio</h3>
                        <p class="text-gray-600 text-sm leading-relaxed whitespace-pre-line">
                            {{ $institution->registrar_bio ?? 'Biography details not configured.' }}
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>
</main>
