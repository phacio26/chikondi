@extends('admin.layout')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

        <div class="bg-white rounded-[1.5rem] p-6 border border-accent/5 shadow-sm">
            <p class="text-[10px] font-black uppercase tracking-[0.3em] text-accent/30 mb-3">Total News</p>
            <p class="font-display text-4xl font-black text-accent">{{ $totalNews }}</p>
        </div>

        <div class="bg-white rounded-[1.5rem] p-6 border border-accent/5 shadow-sm">
            <p class="text-[10px] font-black uppercase tracking-[0.3em] text-accent/30 mb-3">Published</p>
            <p class="font-display text-4xl font-black text-brand">{{ $publishedNews }}</p>
        </div>

        <div class="bg-white rounded-[1.5rem] p-6 border border-accent/5 shadow-sm">
            <p class="text-[10px] font-black uppercase tracking-[0.3em] text-accent/30 mb-3">Total Messages</p>
            <p class="font-display text-4xl font-black text-accent">{{ $totalMessages }}</p>
        </div>

        <div class="bg-white rounded-[1.5rem] p-6 border border-accent/5 shadow-sm">
            <p class="text-[10px] font-black uppercase tracking-[0.3em] text-accent/30 mb-3">Unread Messages</p>
            <p class="font-display text-4xl font-black text-brand">{{ $unreadMessages }}</p>
        </div>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <a href="{{ route('admin.news.create') }}" class="bg-brand text-white rounded-[1.5rem] p-8 flex items-center gap-6 hover:bg-accent transition-all group">
            <div class="w-14 h-14 rounded-2xl bg-white/10 flex items-center justify-center">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
            </div>
            <div>
                <p class="font-black text-sm uppercase tracking-widest">New Post</p>
                <p class="text-white/60 text-xs mt-1">Create a news article</p>
            </div>
        </a>

        <a href="{{ route('admin.contacts') }}" class="bg-white rounded-[1.5rem] p-8 flex items-center gap-6 hover:border-brand border border-accent/5 transition-all group">
            <div class="w-14 h-14 rounded-2xl bg-brand/10 flex items-center justify-center">
                <svg class="w-7 h-7 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <div>
                <p class="font-black text-sm uppercase tracking-widest text-accent">Messages</p>
                <p class="text-accent/40 text-xs mt-1">{{ $unreadMessages }} unread messages</p>
            </div>
        </a>

        <a href="{{ route('admin.settings') }}" class="bg-white rounded-[1.5rem] p-8 flex items-center gap-6 hover:border-brand border border-accent/5 transition-all group">
            <div class="w-14 h-14 rounded-2xl bg-brand/10 flex items-center justify-center">
                <svg class="w-7 h-7 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <div>
                <p class="font-black text-sm uppercase tracking-widest text-accent">Settings</p>
                <p class="text-accent/40 text-xs mt-1">Manage site content</p>
            </div>
        </a>

        <a href="{{ route('home') }}" target="_blank" class="bg-white rounded-[1.5rem] p-8 flex items-center gap-6 hover:border-brand border border-accent/5 transition-all group">
            <div class="w-14 h-14 rounded-2xl bg-brand/10 flex items-center justify-center">
                <svg class="w-7 h-7 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
            </div>
            <div>
                <p class="font-black text-sm uppercase tracking-widest text-accent">View Site</p>
                <p class="text-accent/40 text-xs mt-1">Open public website</p>
            </div>
        </a>

    </div>

@endsection