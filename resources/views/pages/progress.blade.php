@extends('layouts.chikondi')

@section('title', 'Construction Progress | Chikondi Organisation')

@section('extra_styles')
<style>
    .scroll-reveal {
        opacity: 0;
        transform: translateY(48px);
        transition: opacity 0.75s cubic-bezier(0.22, 1, 0.36, 1),
                    transform 0.75s cubic-bezier(0.22, 1, 0.36, 1);
    }
    .scroll-reveal.is-visible {
        opacity: 1;
        transform: translateY(0);
    }
    .status-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 100px;
        font-size: 10px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.2em;
    }
    .status-completed { background: #10B981; color: white; }
    .status-progress { background: #3B82F6; color: white; }
    .status-planned { background: #F59E0B; color: white; }

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

<!-- Hero Section with Enhanced Wave Effect -->
<div class="relative bg-gradient-to-r from-accent to-accent/80 text-white overflow-hidden min-h-[50vh] flex items-center">
    
    <!-- Water/Wave SVG Background -->
    <div class="wave-bg">
        <!-- Wave Layer 1 - Front wave, fast, brand color -->
        <svg class="wave-1" viewBox="0 0 1440 320" preserveAspectRatio="none">
            <path fill="#DC2626" fill-opacity="0.25" d="M0,256L48,245.3C96,235,192,213,288,208C384,203,480,213,576,218.7C672,224,768,224,864,213.3C960,203,1056,181,1152,176C1248,171,1344,181,1392,186.7L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
        
        <!-- Wave Layer 2 - Middle wave, medium speed -->
        <svg class="wave-2" viewBox="0 0 1440 320" preserveAspectRatio="none">
            <path fill="#DC2626" fill-opacity="0.15" d="M0,224L48,213.3C96,203,192,181,288,170.7C384,160,480,160,576,165.3C672,171,768,181,864,192C960,203,1056,213,1152,208C1248,203,1344,181,1392,170.7L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
        
        <!-- Wave Layer 3 - Back wave, slow, base color -->
        <svg class="wave-3" viewBox="0 0 1440 320" preserveAspectRatio="none">
            <path fill="#1E293B" d="M0,192L48,197.3C96,203,192,213,288,213.3C384,213,480,203,576,197.3C672,192,768,192,864,197.3C960,203,1056,213,1152,208C1248,203,1344,181,1392,170.7L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
        
        <!-- Wave Layer 4 - Extra wave for depth -->
        <svg class="wave-2" viewBox="0 0 1440 320" preserveAspectRatio="none" style="opacity: 0.6;">
            <path fill="#F8FAFC" fill-opacity="0.05" d="M0,288L48,277.3C96,267,192,245,288,234.7C384,224,480,224,576,229.3C672,235,768,245,864,250.7C960,256,1056,256,1152,245.3C1248,235,1344,213,1392,202.7L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
    
    <!-- Particle effect overlay -->
    <div class="water-particle"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 py-20 md:py-28 text-center hero-content">
        <h1 class="font-display text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black mb-6 md:mb-8 leading-tight">
            Construction <span class="text-brand">Progress</span>
        </h1>
        <p class="text-base sm:text-lg md:text-xl text-white/90 max-w-3xl mx-auto leading-relaxed">
            Follow the journey of building Pachikondi Birth Center in Mpemba.
        </p>
    </div>
</div>

<!-- Overall Progress Bar -->
<section class="py-12 bg-white border-b border-accent/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
        <div class="bg-surface rounded-2xl p-8 text-center">
            <p class="text-[10px] font-black uppercase tracking-widest text-brand mb-3">Overall Project Completion</p>
            <div class="relative h-6 bg-white rounded-full overflow-hidden max-w-2xl mx-auto mb-4">
                <div class="absolute inset-0 bg-gradient-to-r from-brand to-brand/70 rounded-full" style="width: {{ $totalProgress }}%"></div>
            </div>
            <p class="text-4xl font-black text-accent">{{ $totalProgress }}%</p>
        </div>
    </div>
</section>

<!-- Progress Timeline -->
<section class="py-16 md:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
        <div class="space-y-12">
            @forelse($progressUpdates as $update)
            <div class="scroll-reveal flex flex-col md:flex-row gap-6 md:gap-10">
                <!-- Date Column -->
                <div class="md:w-1/4">
                    <div class="bg-surface rounded-2xl p-6 text-center md:text-left">
                        <p class="text-brand font-black text-lg">{{ \Carbon\Carbon::parse($update->update_date)->format('M d, Y') }}</p>
                        <span class="status-badge status-{{ $update->status == 'completed' ? 'completed' : ($update->status == 'in_progress' ? 'progress' : 'planned') }} mt-2 inline-block">
                            {{ $update->status == 'completed' ? 'Completed' : ($update->status == 'in_progress' ? 'In Progress' : 'Planned') }}
                        </span>
                    </div>
                </div>

                <!-- Content Column -->
                <div class="md:w-3/4">
                    <div class="bg-white border border-accent/5 rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition-all">
                        @if($update->image)
                        <div class="aspect-video overflow-hidden">
                            <img src="{{ asset('storage/' . $update->image) }}" 
                                 alt="{{ $update->title }}"
                                 class="w-full h-full object-cover hover:scale-105 transition-transform duration-700">
                        </div>
                        @endif
                        <div class="p-8">
                            <h2 class="font-display text-2xl font-black text-accent mb-4">{{ $update->title }}</h2>
                            <p class="text-accent/70 leading-relaxed mb-4">{{ $update->description }}</p>
                            
                            <!-- Progress Bar for this update -->
                            <div class="mt-6">
                                <div class="flex justify-between text-xs font-bold mb-2">
                                    <span>Progress</span>
                                    <span>{{ $update->percentage }}%</span>
                                </div>
                                <div class="h-3 bg-surface rounded-full overflow-hidden">
                                    <div class="h-full bg-brand rounded-full" style="width: {{ $update->percentage }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-12">
                <div class="w-20 h-20 bg-brand/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>
                <p class="text-accent/60">No progress updates yet. Check back soon!</p>
            </div>
            @endforelse
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
                }
            });
        }, { threshold: 0.12 });

        document.querySelectorAll('.scroll-reveal').forEach(el => {
            observer.observe(el);
        });
    });
</script>
@endsection