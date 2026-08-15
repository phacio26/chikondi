@props(['subtitle' => null])

<div class="relative bg-gradient-to-r from-accent to-accent/80 text-white overflow-hidden min-h-[60vh] flex items-center">

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
        <h1 class="font-display text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black mb-6 md:mb-8 leading-tight zoom-spin-in">
            {{ $slot }}
        </h1>
        @if($subtitle)
        <p class="text-base sm:text-lg md:text-xl text-white/90 max-w-3xl mx-auto leading-relaxed zoom-spin-in-delayed">
            {{ $subtitle }}
        </p>
        @endif
    </div>
</div>