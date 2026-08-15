@extends('layouts.chikondi')

@section('title', 'About Us | Chikondi Organisation')

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
    .value-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .value-card:hover {
        transform: translateY(-4px);
    }
</style>
@endsection

@section('content')

@php
    use App\Models\AboutPage;
    use App\Models\AboutVideo;

    $about = AboutPage::getInstance();
    $videos = AboutVideo::orderBy('order')->orderBy('created_at')->get();

    // Parse "Title: Description" per line into value cards
    $valueLines = collect(explode("\n", $about->values ?? ''))
        ->map(fn($line) => trim($line))
        ->filter();

    $values = $valueLines->map(function ($line) {
        if (str_contains($line, ':')) {
            [$title, $desc] = explode(':', $line, 2);
            return ['title' => trim($title), 'desc' => trim($desc)];
        }
        return ['title' => $line, 'desc' => ''];
    });
@endphp

    <!-- 1. Hero / Opening Statement -->
    <div class="relative bg-gradient-to-r from-accent to-accent/80 text-white overflow-hidden py-20 md:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 text-center">
            <h1 class="font-display text-4xl sm:text-5xl md:text-6xl font-black mb-6">
                {{ $about->hero_heading ?: 'Our Story' }}
            </h1>
            @if($about->hero_subheading)
            <p class="text-base sm:text-lg text-white/80 max-w-2xl mx-auto leading-relaxed">
                {{ $about->hero_subheading }}
            </p>
            @endif
        </div>
    </div>

    <main class="py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 space-y-20 md:space-y-28">

            <!-- 2. Our Story -->
            @if($about->story)
            <div class="scroll-reveal max-w-4xl mx-auto text-center">
                <span class="text-brand font-black text-[10px] uppercase tracking-[0.3em] mb-4 block">Our Story</span>
                <div class="text-lg md:text-xl text-accent/70 leading-relaxed whitespace-pre-line">
                    {{ $about->story }}
                </div>
            </div>
            @endif

            <!-- 3. The Problem We're Solving -->
            @if($about->problem)
            <div class="scroll-reveal bg-white border border-accent/5 rounded-[2rem] md:rounded-[3rem] shadow-xl shadow-accent/5 p-8 sm:p-12 md:p-16">
                <span class="text-brand font-black text-[10px] uppercase tracking-[0.3em] mb-4 block">The Challenge</span>
                <h2 class="font-display text-2xl sm:text-3xl font-black text-accent mb-6 uppercase tracking-tighter">The Problem We're Solving</h2>
                <div class="text-accent/60 leading-relaxed whitespace-pre-line max-w-3xl">
                    {{ $about->problem }}
                </div>
            </div>
            @endif

            <!-- 4 & 5. Mission & Vision -->
            @if($about->mission || $about->vision)
            <div class="scroll-reveal grid grid-cols-1 md:grid-cols-2 gap-8">
                @if($about->mission)
                <div class="p-8 sm:p-10 bg-accent text-white rounded-[2rem] md:rounded-[3rem] shadow-2xl shadow-accent/20">
                    <p class="text-brand font-black text-[10px] uppercase tracking-[0.3em] mb-4">Mission</p>
                    <p class="text-xl md:text-2xl font-black italic tracking-tight leading-snug">{{ $about->mission }}</p>
                </div>
                @endif
                @if($about->vision)
                <div class="p-8 sm:p-10 bg-brand text-white rounded-[2rem] md:rounded-[3rem] shadow-2xl shadow-brand/10">
                    <p class="text-white/70 font-black text-[10px] uppercase tracking-[0.3em] mb-4">Vision</p>
                    <p class="text-xl md:text-2xl font-black italic tracking-tight leading-snug">{{ $about->vision }}</p>
                </div>
                @endif
            </div>
            @endif

            <!-- 6. Core Values -->
            @if($values->isNotEmpty())
            <div class="scroll-reveal">
                <div class="text-center mb-12">
                    <span class="text-brand font-black text-[10px] uppercase tracking-[0.3em] mb-4 block">What Drives Us</span>
                    <h2 class="font-display text-2xl sm:text-3xl font-black text-accent uppercase tracking-tighter">Core Values</h2>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($values as $value)
                    <div class="value-card p-6 sm:p-8 bg-white border border-accent/5 rounded-[2rem] shadow-lg shadow-accent/5 text-center">
                        <div class="w-12 h-12 mx-auto mb-4 rounded-full bg-brand/10 flex items-center justify-center">
                            <div class="w-3 h-3 rounded-full bg-brand"></div>
                        </div>
                        <h3 class="font-black text-accent uppercase text-sm tracking-widest mb-2">{{ $value['title'] }}</h3>
                        @if($value['desc'])
                        <p class="text-xs text-accent/50 leading-relaxed">{{ $value['desc'] }}</p>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- 7. What We're Building -->
            @if($about->building)
            <div class="scroll-reveal flex flex-col md:flex-row justify-between items-start md:items-center gap-10 md:gap-12 bg-white p-8 sm:p-12 md:p-20 rounded-[2rem] md:rounded-[4rem] shadow-xl shadow-accent/5">
                <div class="md:w-2/3">
                    <span class="text-brand font-black text-[10px] uppercase tracking-[0.3em] mb-4 block">The Build</span>
                    <h2 class="font-display text-2xl sm:text-3xl md:text-4xl font-black text-accent mb-6 uppercase tracking-tighter">What We're Building</h2>
                    <div class="text-accent/60 leading-relaxed whitespace-pre-line mb-8">
                        {{ $about->building }}
                    </div>
                    <a href="{{ route('progress') }}" class="inline-flex justify-center px-8 py-4 bg-brand text-white rounded-2xl font-black uppercase text-xs tracking-widest hover:-translate-y-1 transition shadow-lg shadow-brand/20">
                        See Our Progress
                    </a>
                </div>
            </div>
            @endif

            <!-- 8. Who We Serve / Impact -->
            @if($about->impact || $about->testimonial)
            <div class="scroll-reveal max-w-4xl mx-auto text-center">
                <span class="text-brand font-black text-[10px] uppercase tracking-[0.3em] mb-4 block">Our Impact</span>
                @if($about->impact)
                <div class="text-lg md:text-xl text-accent/70 leading-relaxed whitespace-pre-line mb-8">
                    {{ $about->impact }}
                </div>
                @endif
                @if($about->testimonial)
                <blockquote class="italic text-accent font-display text-xl md:text-2xl font-black border-l-4 border-brand pl-6 text-left max-w-2xl mx-auto">
                    "{{ $about->testimonial }}"
                </blockquote>
                @endif
            </div>
            @endif

            <!-- 9. Our Story in Song -->
            @if($videos->isNotEmpty())
            <div class="scroll-reveal">
                <div class="text-center mb-12">
                    <span class="text-brand font-black text-[10px] uppercase tracking-[0.3em] mb-4 block">Our Story in Song</span>
                    <h2 class="font-display text-2xl sm:text-3xl font-black text-accent uppercase tracking-tighter">Watch & Listen</h2>
                </div>
                <div class="grid grid-cols-1 {{ $videos->count() > 1 ? 'md:grid-cols-2' : '' }} gap-8">
                    @foreach($videos as $video)
                    <div class="bg-white border border-accent/5 rounded-[2rem] overflow-hidden shadow-xl shadow-accent/5">
                        <div class="aspect-video bg-accent">
                            <video controls preload="metadata" class="w-full h-full object-cover">
                                <source src="{{ $video->url }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                        <div class="p-5">
                            <p class="font-black text-accent text-sm">{{ $video->title }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- 10. Meet the Team (teaser) -->
            @if($about->team_teaser)
            <div class="scroll-reveal text-center">
                <p class="text-lg md:text-xl text-accent/70 mb-8 max-w-2xl mx-auto">{{ $about->team_teaser }}</p>
                <a href="{{ route('team') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-accent text-white rounded-2xl font-black uppercase text-xs tracking-widest hover:bg-brand transition-all">
                    Meet the Full Team &rarr;
                </a>
            </div>
            @endif

            <!-- 11. Call to Action -->
            @if($about->cta_heading || $about->cta_text)
            <div class="scroll-reveal p-8 sm:p-12 md:p-20 bg-accent text-white rounded-[2rem] md:rounded-[4rem] shadow-2xl shadow-accent/20 text-center relative overflow-hidden">
                <div class="relative z-10">
                    @if($about->cta_heading)
                    <h2 class="font-display text-2xl sm:text-3xl md:text-4xl font-black mb-6 uppercase tracking-tighter">
                        {{ $about->cta_heading }}
                    </h2>
                    @endif
                    @if($about->cta_text)
                    <p class="text-white/70 text-base md:text-lg max-w-2xl mx-auto mb-10 leading-relaxed">
                        {{ $about->cta_text }}
                    </p>
                    @endif
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('donate') }}" class="inline-flex justify-center px-8 sm:px-10 py-4 bg-brand text-white rounded-2xl font-black uppercase text-xs tracking-widest hover:-translate-y-1 transition shadow-lg shadow-brand/20">
                            Donate Now
                        </a>
                        <a href="{{ route('contact') }}" class="inline-flex justify-center px-8 sm:px-10 py-4 bg-white/10 text-white border border-white/20 rounded-2xl font-black uppercase text-xs tracking-widest hover:bg-white/20 transition">
                            Get Involved
                        </a>
                    </div>
                </div>
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-brand/10 rounded-full blur-3xl"></div>
            </div>
            @endif

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
                }
            });
        }, { threshold: 0.12 });

        document.querySelectorAll('.scroll-reveal').forEach(el => {
            observer.observe(el);
        });
    });
</script>
@endsection