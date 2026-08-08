@extends('layouts.chikondi')

@section('title', 'Our Team | Chikondi Organisation')

@section('content')

<div class="relative bg-gradient-to-r from-accent to-accent/80 text-white overflow-hidden py-20 md:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 text-center">
        <h1 class="font-display text-4xl sm:text-5xl md:text-6xl font-black mb-6">
            Meet the <span class="text-brand">Team</span>
        </h1>
        <p class="text-base sm:text-lg text-white/80 max-w-2xl mx-auto">
            The people behind Chikondi Organisation's mission.
        </p>
    </div>
</div>

<main class="py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">

        @if($teamMembers->isEmpty())
            <p class="text-center text-accent/50 font-bold">Team information coming soon.</p>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($teamMembers as $member)
            <div class="bg-white border border-accent/5 rounded-[2rem] overflow-hidden shadow-lg shadow-accent/5">
                <div class="aspect-square bg-surface overflow-hidden">
                    @if($member->photo)
                        <img src="{{ $member->photo }}" alt="{{ $member->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-accent/20 font-black text-4xl">
                            {{ substr($member->name, 0, 1) }}
                        </div>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="font-display text-lg font-black text-accent">{{ $member->name }}</h3>
                    <p class="text-brand text-xs font-bold uppercase tracking-widest mt-1 mb-4">{{ $member->role }}</p>

                    @if($member->bio)
                    <div class="relative">
                        <div id="bio-{{ $member->id }}" class="text-sm text-accent/60 leading-relaxed team-bio max-h-28 overflow-hidden transition-all duration-300">
                            {!! nl2br(e($member->bio)) !!}
                        </div>
                        <div id="fade-{{ $member->id }}" class="absolute bottom-0 left-0 right-0 h-8 bg-gradient-to-t from-white to-transparent pointer-events-none"></div>
                    </div>
                    <button
                        type="button"
                        onclick="toggleBio({{ $member->id }})"
                        id="toggle-btn-{{ $member->id }}"
                        class="mt-3 text-brand text-xs font-black uppercase tracking-widest hover:underline"
                    >
                        Show more
                    </button>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif

    </div>
</main>

<script>
    function toggleBio(id) {
        const bio = document.getElementById('bio-' + id);
        const fade = document.getElementById('fade-' + id);
        const btn = document.getElementById('toggle-btn-' + id);

        const isExpanded = bio.classList.contains('bio-expanded');

        if (isExpanded) {
            bio.classList.remove('bio-expanded');
            bio.classList.add('max-h-28');
            fade.style.display = 'block';
            btn.textContent = 'Show more';
        } else {
            bio.classList.add('bio-expanded');
            bio.classList.remove('max-h-28');
            fade.style.display = 'none';
            btn.textContent = 'Show less';
        }
    }

    // Hide "Show more" button on load if bio content is short enough to not need it
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('[id^="bio-"]').forEach(function (bio) {
            const id = bio.id.replace('bio-', '');
            const btn = document.getElementById('toggle-btn-' + id);
            const fade = document.getElementById('fade-' + id);

            if (bio.scrollHeight <= bio.clientHeight) {
                if (btn) btn.style.display = 'none';
                if (fade) fade.style.display = 'none';
            }
        });
    });
</script>

@endsection