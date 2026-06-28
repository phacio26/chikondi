@extends('layouts.chikondi')

@section('title', 'News | Chikondi Organisation')

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

    /* Hero Text Animation - Coming from above */
    .animate-from-above {
        animation: slideDownFade 0.8s cubic-bezier(0.22, 1, 0.36, 1) forwards;
    }
    @keyframes slideDownFade {
        0% {
            opacity: 0;
            transform: translateY(-80px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
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

    /* News card image - never crop */
    .news-card-img-wrap {
        width: 100%;
        overflow: visible;
    }

    .news-card-img-wrap img {
        width: 100%;
        height: auto;
        max-height: none;
        display: block;
        object-fit: contain;
    }
</style>
@endsection

@section('content')

    <!-- Hero Section after navigation with Enhanced Wave Effect -->
    <div class="relative bg-gradient-to-r from-accent to-accent/80 text-white overflow-hidden min-h-[50vh] flex items-center">
        
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
            <h1 class="font-display text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black mb-6 md:mb-8 leading-tight animate-from-above">
                @if($newsPosts && $newsPosts->count() > 0)
                    Latest <span class="text-brand">News</span>
                @else
                    Coming <span class="text-brand">Soon</span>
                @endif
            </h1>
            <p class="text-base sm:text-lg md:text-xl text-white/90 max-w-3xl mx-auto leading-relaxed animate-from-above" style="animation-delay: 0.2s;">
                {{ App\Models\SiteSetting::get('news_coming_soon_text', 'Stories, progress updates, and community news from Chikondi Organisation.') }}
            </p>
        </div>
    </div>

    <!-- Header -->
    <header class="pt-16 md:pt-20 pb-16 md:pb-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 md:gap-12 xl:gap-20 items-center">

                <!-- Left: text -->
                <div class="lg:col-span-6">
                    <span class="inline-block px-4 py-1.5 bg-brand/10 text-brand font-black text-[10px] uppercase tracking-widest rounded-full mb-6 md:mb-8">
                        Latest Stories & Updates
                    </span>
                    <div class="mt-10 flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('home') }}" class="inline-flex justify-center w-full sm:w-auto px-8 py-4 bg-accent text-white font-black text-xs uppercase tracking-widest rounded-xl hover:bg-brand transition-all">
                            Back Home
                        </a>
                        <a href="{{ route('donate') }}" class="inline-flex justify-center w-full sm:w-auto px-8 py-4 bg-white text-accent font-black text-xs uppercase tracking-widest rounded-xl border border-accent/10 hover:border-brand hover:text-brand transition-all">
                            Donations
                        </a>
                    </div>
                </div>

                <!-- Right: latest news image -->
                <div class="lg:col-span-6">
                    <div class="flex justify-center lg:justify-end">
                        @if($newsPosts && $newsPosts->count() > 0 && $newsPosts->first()->image)
                            <img src="{{ $newsPosts->first()->image }}"
                                 alt="{{ $newsPosts->first()->title }}"
                                 class="w-full max-w-[280px] sm:max-w-[320px] md:max-w-[360px] lg:max-w-[390px] h-auto rounded-[2rem] object-cover shadow-2xl shadow-accent/10">
                        @else
                            <div class="w-full max-w-[280px] sm:max-w-[320px] md:max-w-[360px] lg:max-w-[390px] aspect-[3/4] rounded-[2rem] bg-surface border border-accent/5 flex items-center justify-center">
                                <div class="text-center p-8">
                                    <div class="w-16 h-16 bg-brand/10 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                        </svg>
                                    </div>
                                    <p class="font-black text-[10px] uppercase tracking-widest text-accent/30">No posts yet</p>
                                    <p class="text-xs text-accent/40 mt-2">{{ App\Models\SiteSetting::get('news_coming_soon_text', 'Check back soon') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </header>

    <!-- News Posts Grid -->
    @if($newsPosts && $newsPosts->count() > 0)
    <section class="py-20 md:py-32 bg-surface">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
            <p class="text-brand font-black text-[10px] uppercase tracking-[0.3em] mb-12">All Posts</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($newsPosts as $post)
                <article class="bg-white rounded-[2.5rem] overflow-hidden shadow-lg shadow-accent/5 hover:shadow-xl hover:shadow-accent/10 hover:-translate-y-1 transition-all duration-300 scroll-reveal scale-in flex flex-col">

                    @if($post->image)
                    <div class="news-card-img-wrap rounded-t-[2.5rem] overflow-hidden shrink-0">
                        <img src="{{ $post->image }}"
                             alt="{{ $post->title }}"
                             class="w-full h-auto block hover:scale-105 transition-transform duration-700">
                    </div>
                    @else
                    <div class="w-full bg-slate-100 flex items-center justify-center py-14 rounded-t-[2.5rem] shrink-0">
                        <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    @endif

                    <div class="p-8 flex flex-col flex-1">
                        <p class="text-[10px] font-black uppercase tracking-widest text-accent/30 mb-3">
                            {{ \Carbon\Carbon::parse($post->created_at)->format('d M Y') }}
                        </p>
                        <h2 class="font-display text-xl font-black text-accent mb-3 leading-tight">
                            {{ $post->title }}
                        </h2>

                        @php
                            $fullText = $post->excerpt ?: strip_tags($post->body ?? '');
                            $shortText = \Illuminate\Support\Str::limit($fullText, 120);
                            $needsToggle = strlen($fullText) > strlen($shortText);
                        @endphp

                        @if($fullText)
                            <div class="news-text-wrap" data-full-text="{{ $fullText }}" data-short-text="{{ $shortText }}">
                                <p class="text-sm text-accent/60 leading-relaxed news-text-content">{{ $shortText }}</p>
                                @if($needsToggle)
                                    <button type="button" class="read-more-btn text-brand font-bold text-xs uppercase tracking-wider mt-2 hover:underline" data-expanded="false">
                                        Read more
                                    </button>
                                @endif
                            </div>
                        @endif
                    </div>

                </article>
                @endforeach
            </div>
        </div>
    </section>
    @endif

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

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.read-more-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const wrapper = btn.closest('.news-text-wrap');
                const textEl = wrapper.querySelector('.news-text-content');
                const isExpanded = btn.dataset.expanded === 'true';

                if (isExpanded) {
                    textEl.textContent = wrapper.dataset.shortText;
                    btn.textContent = 'Read more';
                    btn.dataset.expanded = 'false';
                } else {
                    textEl.textContent = wrapper.dataset.fullText;
                    btn.textContent = 'Show less';
                    btn.dataset.expanded = 'true';
                }
            });
        });
    });
</script>
@endsection