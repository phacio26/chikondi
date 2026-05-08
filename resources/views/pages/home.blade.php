@extends('layouts.chikondi')

@section('title', 'Chikondi Organisation | Limodzi Tingathe')

@section('extra_styles')
<style>
    .text-gradient {
        background: linear-gradient(135deg, #1E293B 0%, #DC2626 100%);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .hero-vignette {
        background: linear-gradient(
            160deg,
            rgba(10, 15, 30, 0.75) 0%,
            rgba(10, 15, 30, 0.35) 60%,
            rgba(10, 15, 30, 0.15) 100%
        );
    }
    .text-hero {
        color: #FFFFFF;
        text-shadow: 0 10px 40px rgba(0,0,0,0.6);
    }
    @keyframes slowZoom {
        0% { transform: scale(1); }
        100% { transform: scale(1.1); }
    }
    .animate-slow-zoom {
        animation: slowZoom 20s ease-out forwards;
    }
    .hero-logo-lockup {
        position: absolute;
        top: clamp(6.75rem, 15vh, 8.25rem);
        left: clamp(2rem, 3vw, 3rem);
        z-index: 10;
    }
    .hero-logo-lockup img {
        width: min(32vw, 340px);
        filter: drop-shadow(0 18px 34px rgba(0, 0, 0, 0.35));
    }
    @media (max-width: 640px) {
        .hero-logo-lockup {
            top: 5.5rem;
            left: 1.25rem;
        }
        .hero-logo-lockup img {
            width: min(62vw, 220px);
        }
    }
    .reveal-text {
        opacity: 0;
        transform: translateY(30px);
        animation: revealText 0.8s cubic-bezier(0.25, 1, 0.5, 1) forwards;
    }
    @keyframes revealText {
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes scroll-dash {
        0% { transform: translateY(-100%); }
        100% { transform: translateY(200%); }
    }
    .animate-scroll-dash {
        animation: scroll-dash 2s infinite cubic-bezier(0.77, 0, 0.175, 1);
    }
    .vertical-text {
        writing-mode: vertical-rl;
        text-orientation: mixed;
    }
    .scroll-reveal.from-left { transform: translateX(-48px); }
    .scroll-reveal.from-right { transform: translateX(48px); }
    .scroll-reveal.scale-in { transform: scale(0.92); }
    @media (max-width: 767px) {
        .scroll-reveal.from-left,
        .scroll-reveal.from-right {
            transform: translateY(48px);
        }
    }
    .scroll-reveal.is-visible {
        opacity: 1;
        transform: translateY(0) translateX(0) scale(1);
    }
    .reveal-group > * {
        opacity: 0;
        transform: translateY(32px);
        transition: opacity 0.6s cubic-bezier(0.22, 1, 0.36, 1),
                    transform 0.6s cubic-bezier(0.22, 1, 0.36, 1);
    }
    .reveal-group.is-visible > *:nth-child(1) { opacity:1; transform:none; transition-delay:0s; }
    .reveal-group.is-visible > *:nth-child(2) { opacity:1; transform:none; transition-delay:0.12s; }
    .reveal-group.is-visible > *:nth-child(3) { opacity:1; transform:none; transition-delay:0.24s; }
    .reveal-group.is-visible > *:nth-child(4) { opacity:1; transform:none; transition-delay:0.36s; }
    .reveal-group.is-visible > *:nth-child(5) { opacity:1; transform:none; transition-delay:0.48s; }
    .reveal-group.is-visible > *:nth-child(6) { opacity:1; transform:none; transition-delay:0.60s; }
</style>
@endsection

@section('content')

    <!-- Narrative Hero Section -->
    <header class="relative min-h-[78vh] sm:min-h-[90vh] md:min-h-screen overflow-hidden bg-white">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('storage/' . App\Models\SiteSetting::get('hero_image', 'images/home-hero-section.png')) }}"
                 alt="Chikondi - Malawian Healthcare"
                 class="w-full h-full object-cover animate-slow-zoom">
            <div class="absolute inset-0 hero-vignette"></div>
        </div>
        <div class="hero-logo-lockup reveal-text pointer-events-none" style="animation-delay: 0.3s">
            <img src="{{ asset('storage/' . App\Models\SiteSetting::get('logo', 'images/logo.png')) }}" alt="Chikondi Logo" class="h-auto">
        </div>
    </header>

    <!-- Impact Storytelling: The Context -->
    <section class="py-20 md:py-32 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-20 items-center">
                <div class="lg:col-span-6 scroll-reveal from-left">
                    <h2 class="text-brand font-black text-5xl md:text-8xl leading-none tracking-tighter mb-6 md:mb-10 opacity-10"></h2>
                    <h3 class="font-display text-3xl sm:text-4xl md:text-5xl font-black text-accent mb-6 md:mb-8 leading-[1.1]">
                        The reality of <span class="bg-brand/5 px-2">survival</span> in Malawi
                    </h3>
                    <p class="text-lg md:text-xl text-accent/60 leading-relaxed mb-10 md:mb-12">
                        The NGO was founded by mothers and fathers with their own lived experience in motherhood. We know the importance of a good health system and medical, physical, and mental support.
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                        <div class="p-6 md:p-8 bg-surface rounded-[1.5rem] md:rounded-[2.5rem] border border-accent/5 group hover:border-brand/20 transition-all">
                            <span class="text-brand font-black text-3xl md:text-4xl block mb-2">99%</span>
                            <p class="font-bold uppercase tracking-widest text-[9px] text-accent/40 mb-2">Support Target</p>
                            <p class="text-xs text-accent/60 leading-relaxed">Dedicated mental and physical support for parents.</p>
                        </div>
                        <div class="p-6 md:p-8 bg-surface rounded-[1.5rem] md:rounded-[2.5rem] border border-accent/5 group hover:border-brand/20 transition-all">
                            <span class="text-brand font-black text-3xl md:text-4xl block mb-2">Mpemba</span>
                            <p class="font-bold uppercase tracking-widest text-[9px] text-accent/40 mb-2">Primary Focus</p>
                            <p class="text-xs text-accent/60 leading-relaxed">Strategically located opposite the health center.</p>
                        </div>
                    </div>
                    <div class="bg-accent text-white p-6 md:p-10 rounded-[2rem] md:rounded-[3rem] shadow-2xl shadow-accent/20">
                        <p class="text-sm font-bold text-brand uppercase tracking-[0.3em] mb-4">Urgent Mission</p>
                        <p class="text-xl md:text-2xl font-display font-medium leading-tight">
                            "Reducing maternal and child mortality through education, equipment, and shared experience."
                        </p>
                    </div>
                </div>

                <div class="lg:col-span-6 relative pb-20 md:pb-0 scroll-reveal from-right">
                    <div class="relative rounded-[2rem] md:rounded-[3.5rem] overflow-hidden shadow-2xl">
                        <img src="{{ asset('storage/' . App\Models\SiteSetting::get('mother_child_image', 'images/mother-joy-malawi.png')) }}"
                             alt="Malawian Mother and child"
                             class="w-full h-[420px] sm:h-[520px] md:h-[600px] object-cover hover:scale-105 transition-transform duration-1000">
                        <div class="absolute inset-0 bg-gradient-to-t from-accent/40 to-transparent"></div>
                    </div>
                    <div class="absolute bottom-0 left-4 right-4 md:-bottom-10 md:-left-10 md:right-auto md:w-80 p-6 md:p-8 bg-brand text-white rounded-[1.75rem] md:rounded-[2.5rem] shadow-2xl shadow-brand/30 border-4 border-white">
                        <div class="flex items-center gap-5">
                            <div class="h-12 w-12 rounded-full bg-white/10 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-black uppercase tracking-[0.2em] text-[8px] opacity-60 mb-1">Direct Line</p>
                                <p class="text-lg md:text-xl font-black italic">{{ App\Models\SiteSetting::get('phone_number', '0994392275') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- The Solution: Pachikondi Birth Center Callout -->
    <section class="py-14 md:py-20 scroll-reveal scale-in">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="relative rounded-[2rem] md:rounded-[4rem] overflow-hidden bg-accent group">
                <img src="https://images.unsplash.com/photo-1541888946425-d81bb19480c5?q=80&w=2070&auto=format&fit=crop"
                     alt="Birth Center"
                     class="absolute inset-0 w-full h-full object-cover opacity-30 group-hover:scale-105 transition-transform duration-1000">
                <div class="absolute inset-0 bg-gradient-to-r from-accent via-accent/80 to-transparent"></div>
                <div class="relative z-10 p-8 sm:p-12 md:p-24 max-w-2xl scroll-reveal from-left">
                    <span class="inline-block px-4 py-1.5 bg-brand text-white font-black text-[10px] uppercase tracking-widest rounded-full mb-8">Major Project</span>
                    <h2 class="font-display text-3xl sm:text-4xl md:text-5xl font-black text-white mb-8 leading-tight">
                        Ending the <span class="italic text-brand">long journey</span> to safe healthcare.
                    </h2>
                    <p class="text-white/60 text-base md:text-lg mb-10 md:mb-12">
                        The Pachikondi Birth Center is currently under construction. With your help, we can provide the medical tools needed to open its doors.
                    </p>
                    <div class="flex">
                        <a href="{{ route('progress') }}" class="w-full sm:w-auto text-center px-8 py-4 bg-white text-accent font-black text-xs uppercase tracking-widest rounded-xl hover:bg-brand hover:text-white transition-all">
                     View Progress
</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('extra_scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                } else {
                    entry.target.classList.remove('is-visible');
                }
            });
        }, { threshold: 0.12 });

        document.querySelectorAll('.scroll-reveal, .reveal-group').forEach(el => {
            observer.observe(el);
        });
    });
</script>
@endsection