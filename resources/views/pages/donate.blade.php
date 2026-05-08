@extends('layouts.chikondi')

@section('title', 'Support Our Mission | Chikondi Organisation')

@section('extra_styles')
<style>
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

    /* Professional Hero Text Animation - Rise Up Effect */
    .rise-up {
        animation: riseUpFade 0.9s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    @keyframes riseUpFade {
        0% {
            opacity: 0;
            transform: translateY(60px);
            filter: blur(8px);
        }
        40% {
            filter: blur(2px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
            filter: blur(0);
        }
    }

    /* Stagger delay for paragraph */
    .rise-up-delayed {
        animation: riseUpFade 0.9s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        animation-delay: 0.25s;
        opacity: 0;
        transform: translateY(60px);
    }

    /* Enhanced Water/Wave Animation */
    .wave-bg {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: 0;
    }
    .wave-bg svg {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        min-height: 300px;
    }
    
    /* Wave 1 - Fast moving */
    .wave-1 {
        animation: waveFlow1 6s ease-in-out infinite;
        transform-origin: center;
    }
    @keyframes waveFlow1 {
        0% { transform: translateX(0) translateY(0); }
        25% { transform: translateX(-3%) translateY(2%); }
        50% { transform: translateX(0) translateY(4%); }
        75% { transform: translateX(3%) translateY(2%); }
        100% { transform: translateX(0) translateY(0); }
    }
    
    /* Wave 2 - Medium moving (opposite direction) */
    .wave-2 {
        animation: waveFlow2 8s ease-in-out infinite;
        transform-origin: center;
    }
    @keyframes waveFlow2 {
        0% { transform: translateX(0) translateY(0); }
        25% { transform: translateX(4%) translateY(-2%); }
        50% { transform: translateX(0) translateY(-4%); }
        75% { transform: translateX(-4%) translateY(-2%); }
        100% { transform: translateX(0) translateY(0); }
    }
    
    /* Wave 3 - Slow moving */
    .wave-3 {
        animation: waveFlow3 12s ease-in-out infinite;
        transform-origin: center;
    }
    @keyframes waveFlow3 {
        0% { transform: translateX(0) translateY(0); }
        33% { transform: translateX(-2%) translateY(1%); }
        66% { transform: translateX(2%) translateY(-1%); }
        100% { transform: translateX(0) translateY(0); }
    }
    
    /* Subtle particle overlay */
    .water-particle {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at 20% 80%, rgba(220,38,38,0.08) 0%, transparent 50%);
        pointer-events: none;
        z-index: 1;
        animation: particleShift 15s ease-in-out infinite;
    }
    @keyframes particleShift {
        0% { opacity: 0.3; transform: translateX(0); }
        50% { opacity: 0.6; transform: translateX(2%); }
        100% { opacity: 0.3; transform: translateX(0); }
    }
    
    .hero-content {
        position: relative;
        z-index: 2;
    }
</style>
@endsection

@section('content')

    <!-- Hero Section after navigation with Enhanced Wave Effect -->
    <div class="relative bg-gradient-to-r from-accent to-accent/80 text-white overflow-hidden min-h-[50vh] flex items-center">
        
        <!-- Water/Wave SVG Background -->
        <div class="wave-bg">
            <svg class="wave-1" viewBox="0 0 1440 320" preserveAspectRatio="none">
                <path fill="#DC2626" fill-opacity="0.25" d="M0,256L48,245.3C96,235,192,213,288,208C384,203,480,213,576,218.7C672,224,768,224,864,213.3C960,203,1056,181,1152,176C1248,171,1344,181,1392,186.7L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
            <svg class="wave-2" viewBox="0 0 1440 320" preserveAspectRatio="none">
                <path fill="#DC2626" fill-opacity="0.15" d="M0,224L48,213.3C96,203,192,181,288,170.7C384,160,480,160,576,165.3C672,171,768,181,864,192C960,203,1056,213,1152,208C1248,203,1344,181,1392,170.7L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
            <svg class="wave-3" viewBox="0 0 1440 320" preserveAspectRatio="none">
                <path fill="#1E293B" d="M0,192L48,197.3C96,203,192,213,288,213.3C384,213,480,203,576,197.3C672,192,768,192,864,197.3C960,203,1056,213,1152,208C1248,203,1344,181,1392,170.7L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
            <svg class="wave-2" viewBox="0 0 1440 320" preserveAspectRatio="none" style="opacity: 0.6;">
                <path fill="#F8FAFC" fill-opacity="0.05" d="M0,288L48,277.3C96,267,192,245,288,234.7C384,224,480,224,576,229.3C672,235,768,245,864,250.7C960,256,1056,256,1152,245.3C1248,235,1344,213,1392,202.7L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>
        
        <div class="water-particle"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 py-20 md:py-28 text-center hero-content">
            <h1 class="font-display text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black mb-6 md:mb-8 leading-tight rise-up">
                Fuel the <span class="text-brand">Impact.</span>
            </h1>
            <p class="text-base sm:text-lg md:text-xl text-white/90 max-w-3xl mx-auto leading-relaxed rise-up-delayed">
                Your donation directly contributes to finalizing the birth center in Mpemba. No woman should risk her life while giving life.
            </p>
        </div>
    </div>

    <main class="py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 md:gap-12 mb-20 md:mb-32 items-start">

                <!-- Financial Support: Major Cards -->
                <div class="lg:col-span-8 flex flex-col gap-12 scroll-reveal from-left">

                    <!-- Bank & Mobile Transfer Card -->
                    <div class="p-6 sm:p-10 md:p-16 bg-white border border-accent/5 rounded-[2rem] md:rounded-[4rem] shadow-xl shadow-accent/5 relative overflow-hidden group">
                        <div class="relative z-10">
                            <span class="text-brand font-black text-[10px] uppercase tracking-[0.3em] mb-4 block italic">Financial</span>
                            <h2 class="font-display text-2xl sm:text-3xl font-black text-accent mb-8 md:mb-10 uppercase tracking-tighter">Bank & Mobile Money</h2>

                            <p class="text-accent/60 mb-8 max-w-xl">
                                We accept financial support via bank transfer, Airtel money, or Mpamba. Please use the payment details below for secure processing.
                            </p>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="p-6 md:p-8 bg-surface rounded-3xl border border-accent/5 hover:border-brand transition-all flex flex-col justify-between">
                                    <p class="text-[9px] font-black uppercase tracking-[0.2em] text-accent/40 mb-2">Airtel & Mpamba</p>
                                    <p class="text-lg md:text-xl font-black text-accent italic">{{ App\Models\SiteSetting::get('phone_number', '0994392275') }}</p>
                                </div>
                                <div class="p-6 md:p-8 bg-surface rounded-3xl border border-accent/5 hover:border-brand transition-all flex flex-col justify-between">
                                    <p class="text-[9px] font-black uppercase tracking-[0.2em] text-accent/40 mb-2">Bank Transfer</p>
                                    <div class="space-y-2">
                                        @php
                                            $bankName = App\Models\SiteSetting::get('bank_name', '');
                                            $accountName = App\Models\SiteSetting::get('account_name', '');
                                            $accountNumber = App\Models\SiteSetting::get('account_number', '');
                                            $branch = App\Models\SiteSetting::get('branch', '');
                                        @endphp
                                        @if($bankName)
                                            <p class="text-sm font-black text-accent">{{ $bankName }}</p>
                                        @endif
                                        @if($accountName)
                                            <p class="text-sm text-accent/80">{{ $accountName }}</p>
                                        @endif
                                        @if($accountNumber)
                                            <p class="text-lg font-black text-brand tracking-widest">{{ $accountNumber }}</p>
                                        @endif
                                        @if($branch)
                                            <p class="text-xs text-accent/60">{{ $branch }}</p>
                                        @endif
                                        @if(!$bankName && !$accountName && !$accountNumber)
                                            <p class="text-lg md:text-xl font-black text-brand tracking-widest italic">{{ App\Models\SiteSetting::get('bank_details', 'Awaiting Request') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="p-6 md:p-10 bg-accent text-white rounded-3xl col-span-1 md:col-span-2 flex flex-col sm:flex-row gap-6 sm:justify-between sm:items-center">
                                    <div>
                                        <p class="text-[9px] font-black uppercase tracking-[0.2em] text-brand mb-1">Direct Line</p>
                                        <p class="text-xl md:text-2xl font-black italic">{{ App\Models\SiteSetting::get('phone_number', '0994392275') }}</p>
                                    </div>
                                    <div class="h-12 w-12 rounded-full border border-white/20 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-brand" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="absolute -top-10 -right-10 w-40 h-40 bg-brand/5 rounded-full blur-3xl opacity-20"></div>
                    </div>

                    <!-- Tools, Volunteer & Fundraising Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                        <!-- Option 02: Tools -->
                        <div class="p-6 sm:p-10 md:p-12 bg-surface border border-accent/5 rounded-[2rem] md:rounded-[3rem] shadow-2xl shadow-accent/5 relative overflow-hidden group">
                            <p class="text-accent/40 font-black text-[10px] uppercase tracking-[0.3em] mb-6">Tools</p>
                            <h3 class="text-2xl font-black mb-8 italic tracking-tighter">Equipment & Materials</h3>
                            <p class="text-sm text-accent/60 leading-relaxed mb-8">
                                Providing tools and equipment for the construction in Mpemba. Please feel free to ask what is needed at the moment.
                            </p>
                            <a href="{{ route('contact') }}" class="inline-flex justify-center w-full sm:w-auto px-8 py-3 bg-accent text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-brand transition-all">Check Needs</a>
                        </div>

                        <!-- Option 03: Volunteer -->
                        <div class="p-6 sm:p-10 md:p-12 bg-brand text-white rounded-[2rem] md:rounded-[3rem] shadow-2xl shadow-brand/10 relative overflow-hidden group">
                            <p class="text-white/60 font-black text-[10px] uppercase tracking-[0.3em] mb-6"> Volunteer</p>
                            <h3 class="text-2xl font-black mb-8 italic tracking-tighter">Give Your Time</h3>
                            <p class="text-sm text-white/70 leading-relaxed mb-8">
                                Your skills and time are valuable. Whether medical, construction, or administrative — we welcome volunteers.
                            </p>
                            <a href="{{ route('contact') }}" class="inline-flex justify-center w-full sm:w-auto px-8 py-3 bg-white text-brand rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-accent hover:text-white transition-all">Get Involved</a>
                        </div>

                        <!-- Option 03: Events — Fundraising Parties (full width) -->
                        <div class="md:col-span-2 p-6 sm:p-10 md:p-12 bg-accent text-white rounded-[2rem] md:rounded-[3rem] shadow-2xl shadow-accent/20 relative overflow-hidden group">
                            <p class="text-white/40 font-black text-[10px] uppercase tracking-[0.3em] mb-6">Events</p>
                            <h3 class="text-2xl font-black mb-8 italic tracking-tighter">Fundraising Parties</h3>
                            <p class="text-sm text-white/60 leading-relaxed mb-8">
                                Host a fundraising party and give out our leaflets and stickers. Contact Mr. Banda for materials and support.
                            </p>
                            <div class="flex items-center gap-4">
                                <div class="h-10 w-10 bg-white/10 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path>
                                    </svg>
                                </div>
                                <span class="text-[10px] font-black uppercase tracking-widest">Get Leaflets</span>
                            </div>
                        </div>

                    </div>

                </div>

                <!-- Sidebar: Limodzi tingathe callout -->
                <div class="lg:col-span-4 flex flex-col gap-8 scroll-reveal from-right">
                    <div class="p-6 sm:p-10 md:p-12 bg-accent text-white rounded-[2rem] md:rounded-[4rem] shadow-2xl shadow-accent/20 h-full flex flex-col justify-between">
                        <div>
                            <h3 class="font-display text-3xl md:text-4xl font-black text-brand mb-8 uppercase tracking-tighter leading-none italic">"Limodzi tingathe"</h3>
                            <div class="space-y-8">
                                <div class="flex gap-4">
                                    <div class="h-6 w-6 rounded-full border border-brand flex items-center justify-center shrink-0 mt-1">
                                        <div class="h-2 w-2 bg-brand rounded-full"></div>
                                    </div>
                                    <p class="text-sm text-white/60 font-medium leading-relaxed">Finalize the build in Mpemba with medical supplies.</p>
                                </div>
                                <div class="flex gap-4">
                                    <div class="h-6 w-6 rounded-full border border-brand flex items-center justify-center shrink-0 mt-1">
                                        <div class="h-2 w-2 bg-brand rounded-full"></div>
                                    </div>
                                    <p class="text-sm text-white/60 font-medium leading-relaxed">Equipping the center to serve those who need it most.</p>
                                </div>
                                <div class="flex gap-4">
                                    <div class="h-6 w-6 rounded-full border border-brand flex items-center justify-center shrink-0 mt-1">
                                        <div class="h-2 w-2 bg-brand rounded-full"></div>
                                    </div>
                                    <p class="text-sm text-white/60 font-medium leading-relaxed italic">"No Woman should risk her life while giving life."</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-12 pt-8 border-t border-white/10 group cursor-pointer" onclick="location.href='{{ route('contact') }}'">
                            <p class="text-brand font-black text-[10px] uppercase tracking-widest mb-2">Participation</p>
                            <p class="text-base md:text-lg font-black italic group-hover:translate-x-2 transition-transform">Have ideas? No payment needed to help. &rarr;</p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Tools & Equipment Bottom Section -->
            <div class="py-16 md:py-24 border-t border-accent/5">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-10 md:gap-12 bg-white p-6 sm:p-10 md:p-24 rounded-[2rem] md:rounded-[5rem] shadow-xl shadow-accent/5 group hover:shadow-2xl transition scroll-reveal scale-in">
                    <div class="md:w-1/2">
                        <span class="text-brand font-black text-[10px] uppercase tracking-[0.3em] mb-4 block">Method</span>
                        <h2 class="font-display text-3xl sm:text-4xl md:text-5xl font-black text-accent mb-6 md:mb-8 uppercase tracking-tighter">Tools & Equipment</h2>
                        <p class="text-lg md:text-xl text-accent/60 leading-relaxed mb-8 md:mb-10">
                            We accept material support including construction tools, medical beds, solar panels, and patient monitoring equipment.
                        </p>
                        <a href="{{ route('contact') }}" class="inline-flex justify-center w-full sm:w-auto px-8 sm:px-10 py-5 bg-brand text-white rounded-2xl font-black uppercase text-xs tracking-widest hover:-translate-y-1 transition shadow-lg shadow-brand/20">
                            Inquire about needs
                        </a>
                    </div>
                    <div class="w-full md:w-1/3 flex flex-col gap-6">
                        <div class="p-6 bg-surface border border-accent/5 rounded-3xl text-sm font-bold opacity-60 hover:opacity-100 transition">
                            Volunteering Hosting
                        </div>
                        <div class="p-6 bg-surface border border-accent/5 rounded-3xl text-sm font-bold opacity-60 hover:opacity-100 transition">
                            Fundraising Events
                        </div>
                        <div class="p-6 bg-surface border border-accent/5 rounded-3xl text-sm font-bold opacity-60 hover:opacity-100 transition">
                            Material Donations
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

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