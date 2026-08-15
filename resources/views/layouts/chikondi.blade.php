<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Chikondi Organisation')</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand': '#DC2626',
                        'surface': '#F8FAFC',
                        'accent': '#1E293B',
                    },
                    fontFamily: {
                        'sans': ['Plus Jakarta Sans', 'sans-serif'],
                        'display': ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        .glass-nav {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }
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
        body {
            scroll-behavior: smooth;
            overflow-x: hidden;
        }
        .image-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }
        .image-wrapper img {
            width: auto;
            max-width: 100%;
            height: auto;
            max-height: 600px;
            object-fit: contain;
        }
        .news-card-image {
            width: 100%;
            overflow: visible;
        }
        .news-card-image img {
            width: 100%;
            height: auto;
            max-height: none;
            display: block;
            object-fit: contain;
        }
        .hero-image-wrapper {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }
        .hero-image-wrapper img {
            width: 100%;
            height: auto;
            display: block;
        }
        .flex-image {
            width: 100%;
            height: auto;
            display: block;
            object-fit: contain;
        }
        .no-aspect {
            aspect-ratio: auto !important;
        }
        @media (max-width: 768px) {
            .image-wrapper img {
                max-height: 400px;
            }
        }

        /* Back to Top Button with Scroll Progress Ring */
        #back-to-top-wrapper {
            position: fixed;
            bottom: 1.5rem;
            right: 1.5rem;
            z-index: 90;
            width: 3.25rem;
            height: 3.25rem;
            opacity: 0;
            visibility: hidden;
            transform: translateY(16px) scale(0.9);
            transition: opacity 0.35s cubic-bezier(0.22, 1, 0.36, 1),
                        transform 0.35s cubic-bezier(0.22, 1, 0.36, 1);
        }
        #back-to-top-wrapper.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }
        #back-to-top-progress {
            position: absolute;
            inset: 0;
            transform: rotate(-90deg);
        }
        #back-to-top-progress circle {
            fill: none;
            stroke-width: 3;
        }
        #back-to-top-progress .track {
            stroke: rgba(30, 41, 59, 0.12);
        }
        #back-to-top-progress .fill {
            stroke: #DC2626;
            stroke-linecap: round;
            transition: stroke-dashoffset 0.1s linear;
        }
        #back-to-top {
            position: absolute;
            inset: 5px;
            border-radius: 9999px;
            background: #1E293B;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 25px -5px rgba(30, 41, 59, 0.35);
            transition: background-color 0.25s ease,
                        box-shadow 0.25s ease,
                        transform 0.25s ease;
        }
        #back-to-top-wrapper:hover #back-to-top {
            background: #DC2626;
            box-shadow: 0 12px 28px -6px rgba(220, 38, 38, 0.45);
            transform: scale(1.05);
        }
        #back-to-top svg {
            width: 1.15rem;
            height: 1.15rem;
            transition: transform 0.25s ease;
        }
        #back-to-top-wrapper:hover #back-to-top svg {
            transform: translateY(-2px);
        }
        @media (max-width: 640px) {
            #back-to-top-wrapper {
                bottom: 1.25rem;
                right: 1.25rem;
                width: 3rem;
                height: 3rem;
            }
        }
    </style>

    @yield('extra_styles')
</head>
<body class="bg-surface text-accent font-sans selection:bg-brand selection:text-white">

@php use App\Models\SiteSetting; @endphp

    <!-- Navigation -->
    <nav class="fixed w-full z-[100] glass-nav">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
            <div class="flex justify-between h-16 sm:h-20 md:h-24 items-center">
                <div class="flex items-center gap-2 group cursor-pointer" onclick="location.href='{{ route('home') }}'">
                    <img src="{{ SiteSetting::get('logo', asset('images/tab-logo.png')) }}" alt="Chikondi Logo" class="h-10 sm:h-12 md:h-14 w-auto object-contain">
                </div>

                <div class="hidden lg:flex items-center space-x-10 text-[11px] font-bold uppercase tracking-[0.2em] text-accent/60">
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-brand border-b-2 border-brand pb-1' : 'hover:text-brand' }} transition-all">Home</a>
                    <a href="{{ route('team') }}" class="{{ request()->routeIs('team') ? 'text-brand border-b-2 border-brand pb-1' : 'hover:text-brand' }} transition-all">Team</a>
                    <a href="{{ route('donate') }}" class="{{ request()->routeIs('donate') ? 'text-brand border-b-2 border-brand pb-1' : 'hover:text-brand' }} transition-all">Donations</a>
                    <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'text-brand border-b-2 border-brand pb-1' : 'hover:text-brand' }} transition-all">Contact</a>
                </div>

                <div class="lg:hidden flex items-center">
                    <button id="mobile-menu-toggle" class="text-accent p-2" aria-label="Open navigation" aria-expanded="false" aria-controls="mobile-menu">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div id="mobile-menu" class="hidden lg:hidden border-t border-accent/10 bg-white/95 px-4 sm:px-6 pb-6">
            <div class="flex flex-col gap-4 pt-5 text-xs font-bold uppercase tracking-[0.2em] text-accent/70">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-brand' : 'hover:text-brand' }} transition-colors">Home</a>
                <a href="{{ route('team') }}" class="{{ request()->routeIs('team') ? 'text-brand' : 'hover:text-brand' }} transition-colors">Team</a>
                <a href="{{ route('donate') }}" class="{{ request()->routeIs('donate') ? 'text-brand' : 'hover:text-brand' }} transition-colors">Donations</a>
                <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'text-brand' : 'hover:text-brand' }} transition-colors">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="bg-accent py-10 text-white overflow-hidden relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
            <!-- Top: Links & Logo side by side -->
            <div class="flex flex-row items-start justify-between gap-8 mb-8">

                <!-- Links - Left -->
                <div class="flex flex-col gap-4 text-xs font-bold uppercase tracking-[0.2em]">
                    <a href="{{ route('home') }}" class="text-white/50 hover:text-brand transition-colors">Home</a>
                    <a href="{{ route('our team') }}" class="text-white/50 hover:text-brand transition-colors">Team</a>
                    <a href="{{ route('donate') }}" class="text-white/50 hover:text-brand transition-colors">Donate</a>
                    <a href="{{ route('contact') }}" class="text-white/50 hover:text-brand transition-colors">Contact</a>
                </div>

                <!-- Logo - Right -->
                <div class="flex flex-col items-end gap-4">
                    <img src="{{ SiteSetting::get('logo', asset('images/logo.png')) }}" alt="Chikondi Logo" class="h-24 sm:h-28 md:h-32 w-auto object-contain">
                </div>

            </div>

            <!-- Bottom: Copyright full width -->
            <div class="border-t border-white/10 pt-4">
                <p class="text-[10px] font-bold text-white/30 uppercase tracking-[0.2em]">
                    &copy; 2026 Chikondi Organisation. All Rights Reserved.
                </p>
            </div>
        </div>
        <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-brand/5 rounded-full blur-[100px] translate-x-1/3 translate-y-1/3"></div>
    </footer>

    <!-- Back to Top Button with Scroll Progress Ring -->
    <div id="back-to-top-wrapper">
        <svg id="back-to-top-progress" viewBox="0 0 52 52">
            <circle class="track" cx="26" cy="26" r="23"></circle>
            <circle class="fill" cx="26" cy="26" r="23" stroke-dasharray="144.5" stroke-dashoffset="144.5"></circle>
        </svg>
        <button id="back-to-top" aria-label="Back to top" type="button">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7" />
            </svg>
        </button>
    </div>

    <script>
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileMenuToggle && mobileMenu) {
            mobileMenuToggle.addEventListener('click', () => {
                const isOpen = !mobileMenu.classList.contains('hidden');
                mobileMenu.classList.toggle('hidden');
                mobileMenuToggle.setAttribute('aria-expanded', String(!isOpen));
            });
        }

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.scroll-reveal').forEach(el => {
            observer.observe(el);
        });

        // Back to Top button with scroll progress ring
        const backToTopWrapper = document.getElementById('back-to-top-wrapper');
        const backToTopBtn = document.getElementById('back-to-top');
        const progressCircle = document.querySelector('#back-to-top-progress .fill');
        const CIRCUMFERENCE = 144.5;

        if (backToTopWrapper && backToTopBtn && progressCircle) {
            const updateBackToTop = () => {
                const scrollTop = window.scrollY;
                const docHeight = document.documentElement.scrollHeight - window.innerHeight;
                const progress = docHeight > 0 ? Math.min(scrollTop / docHeight, 1) : 0;

                progressCircle.style.strokeDashoffset = CIRCUMFERENCE - (progress * CIRCUMFERENCE);

                if (scrollTop > 400) {
                    backToTopWrapper.classList.add('show');
                } else {
                    backToTopWrapper.classList.remove('show');
                }
            };

            window.addEventListener('scroll', updateBackToTop, { passive: true });
            window.addEventListener('resize', updateBackToTop);
            updateBackToTop();

            backToTopBtn.addEventListener('click', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }
    </script>

    @yield('extra_scripts')

</body>
</html>