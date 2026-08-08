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
                    <div class="text-sm text-accent/60 leading-relaxed team-bio">
                        {!! nl2br(e($member->bio)) !!}
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif

    </div>
</main>

@endsection