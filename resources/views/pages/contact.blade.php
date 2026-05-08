@extends('layouts.chikondi')

@section('title', 'Contact Us | Chikondi Organisation')

@section('extra_styles')
<style>
    .text-gradient {
        background: linear-gradient(135deg, #1E293B 0%, #DC2626 100%);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
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

    @keyframes popupFadeIn {
        from { opacity: 0; transform: scale(0.95) translateY(16px); }
        to   { opacity: 1; transform: scale(1) translateY(0); }
    }
    #successPopup .popup-card {
        animation: popupFadeIn 0.4s cubic-bezier(0.22, 1, 0.36, 1) forwards;
    }

    /* ── Validation styles ── */
    .form-field-error {
        border-color: #DC2626 !important;
        background-color: #fff5f5 !important;
    }
    .field-err-msg {
        display: none;
        color: #DC2626;
        font-size: 11px;
        font-weight: 700;
        margin-top: 6px;
        margin-left: 4px;
    }
    .field-err-msg.visible {
        display: block;
    }

    /* Brighter form text styles */
    .form-label {
        color: #1E293B;
        font-weight: 900;
        letter-spacing: 0.1em;
    }
    .form-input, .form-textarea {
        color: #1E293B;
        font-weight: 600;
        background-color: #F8FAFC;
    }
    .form-input::placeholder, .form-textarea::placeholder {
        color: #94A3B8;
        font-weight: 400;
    }
    .form-input:focus, .form-textarea:focus {
        background-color: white;
        border-color: #DC2626;
    }

    /* Unique Hero Text Animation - Elegant Zoom + Spin */
    .zoom-spin-in {
        animation: zoomSpinFade 0.8s cubic-bezier(0.34, 1.2, 0.64, 1) forwards;
    }
    @keyframes zoomSpinFade {
        0% {
            opacity: 0;
            transform: scale(0.7) rotate(-8deg);
            filter: blur(6px);
        }
        40% {
            filter: blur(2px);
        }
        100% {
            opacity: 1;
            transform: scale(1) rotate(0deg);
            filter: blur(0);
        }
    }

    /* Subtle delayed for paragraph */
    .zoom-spin-in-delayed {
        animation: zoomSpinFade 0.8s cubic-bezier(0.34, 1.2, 0.64, 1) forwards;
        animation-delay: 0.2s;
        opacity: 0;
        transform: scale(0.7) rotate(-8deg);
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
    <div class="relative bg-gradient-to-r from-accent to-accent/80 text-white overflow-hidden min-h-[60vh] flex items-center">
        
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
            <h1 class="font-display text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black mb-6 md:mb-8 leading-tight zoom-spin-in">
                Request <span class="text-brand">Information</span>
            </h1>
            <p class="text-base sm:text-lg md:text-xl text-white/90 max-w-3xl mx-auto leading-relaxed zoom-spin-in-delayed">
                Connect with us to share ideas, volunteer, or inquire about the Pachikondi Birth Center. Zikomo kwambiri – ndathokoza.
            </p>
        </div>
    </div>

    <main class="py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 md:gap-20 items-start">

                <!-- Contact Direct Card -->
                <div class="lg:col-span-5 flex flex-col gap-8 scroll-reveal from-left">
                    <div class="bg-accent text-white p-8 md:p-12 rounded-[3rem] shadow-2xl shadow-accent/20 relative overflow-hidden group">
                        <p class="text-brand font-black text-[10px] uppercase tracking-[0.3em] mb-6 italic">Direct Line</p>
                        <h2 class="font-display text-2xl font-black mb-3 uppercase tracking-tighter">Chairman Abel Banda</h2>
                        <p class="text-white/60 text-md mb-8">Always reachable for equipment donations, hosting inquiries, or community support.</p>
                        <a href="tel:{{ App\Models\SiteSetting::get('phone_number', '0994392275') }}" class="inline-flex items-center gap-4 px-8 py-4 bg-brand text-white font-black text-lg italic tracking-tight rounded-2xl hover:bg-white hover:text-brand transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            {{ App\Models\SiteSetting::get('phone_number', '0994392275') }}
                        </a>
                        <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-brand/10 rounded-full blur-3xl opacity-20"></div>
                    </div>

                    <div class="p-8 md:p-10 bg-white border border-accent/5 rounded-[3rem]">
                        <p class="text-[10px] font-black uppercase tracking-[0.3em] text-brand mb-4 italic">Mpemba HQ</p>
                        <p class="text-md font-bold text-accent leading-relaxed">
                            Opposite Mpemba Health Center<br>
                            Mpemba, Lilongwe, Malawi
                        </p>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="lg:col-span-7 scroll-reveal from-right">
                    <div class="bg-white border border-accent/5 p-8 md:p-12 rounded-[3rem] shadow-xl shadow-accent/5 relative">
                        <p class="text-brand font-black text-[11px] uppercase tracking-[0.3em] mb-8">Send a Message</p>

                        <form id="contactForm" action="{{ route('contact.send') }}" method="POST" class="space-y-8" novalidate>
                            @csrf

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                                <div>
                                    <label class="form-label block text-[11px] font-black uppercase tracking-widest text-accent mb-3">
                                        How can you help? (Ideas/Participation)
                                    </label>
                                    <textarea
                                        id="field-ideas"
                                        name="ideas"
                                        rows="4"
                                        class="form-textarea w-full bg-surface border border-accent/20 rounded-2xl p-5 focus:border-brand focus:ring-0 transition-all text-sm font-semibold text-accent placeholder:text-accent/30 outline-none"
                                        placeholder="I have an idea for the organization...">{{ old('ideas') }}</textarea>
                                    <span class="field-err-msg" id="err-ideas">
                                        Please share your ideas or how you'd like to participate.
                                    </span>
                                    @error('ideas')
                                        <span class="field-err-msg visible">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label class="form-label block text-[11px] font-black uppercase tracking-widest text-accent mb-3">
                                        Email Address
                                    </label>
                                    <input
                                        id="field-email"
                                        type="email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        placeholder="Your Email"
                                        class="form-input w-full px-6 py-4 bg-surface border border-accent/20 rounded-2xl focus:border-brand focus:bg-white transition-all outline-none font-semibold text-accent placeholder:text-accent/30">
                                    <span class="field-err-msg" id="err-email">
                                        Please enter a valid email address.
                                    </span>
                                    @error('email')
                                        <span class="field-err-msg visible">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>

                            <div>
                                <label class="form-label block text-[11px] font-black uppercase tracking-widest text-accent mb-3">
                                    Message
                                </label>
                                <textarea
                                    id="field-message"
                                    name="message"
                                    rows="5"
                                    placeholder="How can we support your inquiry?"
                                    class="form-textarea w-full px-6 py-4 bg-surface border border-accent/20 rounded-2xl focus:border-brand focus:bg-white transition-all outline-none font-semibold text-accent placeholder:text-accent/30">{{ old('message') }}</textarea>
                                <span class="field-err-msg" id="err-message">
                                    Please write your message before sending.
                                </span>
                                @error('message')
                                    <span class="field-err-msg visible">{{ $message }}</span>
                                @enderror
                            </div>

                            <button
                                type="submit"
                                class="w-full py-5 bg-brand text-white font-black text-xs uppercase tracking-[0.3em] rounded-2xl shadow-2xl shadow-brand/20 hover:bg-accent hover:-translate-y-1 transition-all">
                                Send Message
                            </button>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </main>

    {{-- ── Success Popup Overlay ── --}}
    @if(session('success'))
    <div id="successPopup" class="fixed inset-0 z-[200] flex items-center justify-center bg-black/30 backdrop-blur-sm">
        <div class="popup-card bg-white rounded-[3rem] p-12 max-w-sm w-full mx-4 text-center shadow-2xl shadow-accent/20">
            <div class="w-16 h-16 bg-brand/10 border border-brand/20 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h3 class="font-display text-2xl font-black text-accent uppercase tracking-tighter italic mb-3">Zikomo Kwambiri!</h3>
            <p class="text-accent/60 leading-relaxed">Your message has been dispatched to Chairman Banda. We value your input.</p>
        </div>
    </div>
    @endif

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

        const popup = document.getElementById('successPopup');
        if (popup) {
            const dismiss = () => {
                popup.style.transition = 'opacity 0.5s ease';
                popup.style.opacity = '0';
                setTimeout(() => popup.remove(), 500);
            };
            setTimeout(dismiss, 3500);
            popup.addEventListener('click', dismiss);
        }

        const validationRules = [
            {
                fieldId: 'field-email',
                errId:   'err-email',
                test: (val) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val.trim()),
            },
            {
                fieldId: 'field-message',
                errId:   'err-message',
                test: (val) => val.trim().length > 0,
            },
        ];

        function showError(fieldEl, errEl) {
            fieldEl.classList.add('form-field-error');
            errEl.classList.add('visible');
        }

        function clearError(fieldEl, errEl) {
            fieldEl.classList.remove('form-field-error');
            errEl.classList.remove('visible');
        }

        validationRules.forEach(({ fieldId, errId, test }) => {
            const fieldEl = document.getElementById(fieldId);
            const errEl   = document.getElementById(errId);
            if (!fieldEl || !errEl) return;

            fieldEl.addEventListener('input', () => {
                if (test(fieldEl.value)) {
                    clearError(fieldEl, errEl);
                }
            });
        });

        const form = document.getElementById('contactForm');
        if (form) {
            form.addEventListener('submit', (e) => {
                let firstInvalid = null;

                validationRules.forEach(({ fieldId, errId, test }) => {
                    const fieldEl = document.getElementById(fieldId);
                    const errEl   = document.getElementById(errId);
                    if (!fieldEl || !errEl) return;

                    if (!test(fieldEl.value)) {
                        showError(fieldEl, errEl);
                        if (!firstInvalid) firstInvalid = fieldEl;
                    } else {
                        clearError(fieldEl, errEl);
                    }
                });

                if (firstInvalid) {
                    e.preventDefault();
                    firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstInvalid.focus();
                }
            });
        }

    });
</script>
@endsection