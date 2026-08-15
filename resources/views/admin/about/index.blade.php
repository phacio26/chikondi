@extends('admin.layout')

@section('title', 'About Us Page')
@section('page_title', 'About Us Page')

@section('content')

    <!-- About Page Content Form -->
    <form method="POST" action="{{ route('admin.about.update') }}" class="space-y-8">
        @csrf

        <!-- Hero Section -->
        <div class="bg-white rounded-[1.5rem] border border-accent/5 shadow-sm p-6 sm:p-8">
            <p class="text-[10px] font-black uppercase tracking-[0.3em] text-accent/30 mb-6 sm:mb-8">1. Hero / Opening Statement</p>
            <div class="space-y-6">
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-3">Heading</label>
                    <input type="text" name="hero_heading" value="{{ old('hero_heading', $about->hero_heading) }}"
                           class="w-full px-6 py-4 bg-surface border-2 border-transparent focus:border-brand transition-all rounded-2xl outline-none font-bold text-accent">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-3">Subheading</label>
                    <textarea name="hero_subheading" rows="2"
                              class="w-full px-6 py-4 bg-surface border-2 border-transparent focus:border-brand transition-all rounded-2xl outline-none font-bold text-accent">{{ old('hero_subheading', $about->hero_subheading) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Our Story -->
        <div class="bg-white rounded-[1.5rem] border border-accent/5 shadow-sm p-6 sm:p-8">
            <p class="text-[10px] font-black uppercase tracking-[0.3em] text-accent/30 mb-6 sm:mb-8">2. Our Story / Origin</p>
            <textarea name="story" rows="6"
                      class="w-full px-6 py-4 bg-surface border-2 border-transparent focus:border-brand transition-all rounded-2xl outline-none font-bold text-accent text-sm">{{ old('story', $about->story) }}</textarea>
        </div>

        <!-- The Problem -->
        <div class="bg-white rounded-[1.5rem] border border-accent/5 shadow-sm p-6 sm:p-8">
            <p class="text-[10px] font-black uppercase tracking-[0.3em] text-accent/30 mb-6 sm:mb-8">3. The Problem We're Solving</p>
            <textarea name="problem" rows="6"
                      class="w-full px-6 py-4 bg-surface border-2 border-transparent focus:border-brand transition-all rounded-2xl outline-none font-bold text-accent text-sm">{{ old('problem', $about->problem) }}</textarea>
        </div>

        <!-- Mission & Vision -->
        <div class="bg-white rounded-[1.5rem] border border-accent/5 shadow-sm p-6 sm:p-8">
            <p class="text-[10px] font-black uppercase tracking-[0.3em] text-accent/30 mb-6 sm:mb-8">4 & 5. Mission & Vision</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-3">Mission Statement</label>
                    <textarea name="mission" rows="3"
                              class="w-full px-6 py-4 bg-surface border-2 border-transparent focus:border-brand transition-all rounded-2xl outline-none font-bold text-accent">{{ old('mission', $about->mission) }}</textarea>
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-3">Vision Statement</label>
                    <textarea name="vision" rows="3"
                              class="w-full px-6 py-4 bg-surface border-2 border-transparent focus:border-brand transition-all rounded-2xl outline-none font-bold text-accent">{{ old('vision', $about->vision) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Core Values -->
        <div class="bg-white rounded-[1.5rem] border border-accent/5 shadow-sm p-6 sm:p-8">
            <p class="text-[10px] font-black uppercase tracking-[0.3em] text-accent/30 mb-6 sm:mb-8">6. Core Values</p>
            <textarea name="values" rows="5"
                      class="w-full px-6 py-4 bg-surface border-2 border-transparent focus:border-brand transition-all rounded-2xl outline-none font-bold text-accent text-sm">{{ old('values', $about->values) }}</textarea>
            <p class="text-[10px] text-accent/30 mt-2 font-bold">One value per line, format: <span class="italic">Title: Description</span> — e.g. "Compassion: We care deeply for every mother and child we serve."</p>
        </div>

        <!-- What We're Building -->
        <div class="bg-white rounded-[1.5rem] border border-accent/5 shadow-sm p-6 sm:p-8">
            <p class="text-[10px] font-black uppercase tracking-[0.3em] text-accent/30 mb-6 sm:mb-8">7. What We're Building</p>
            <textarea name="building" rows="5"
                      class="w-full px-6 py-4 bg-surface border-2 border-transparent focus:border-brand transition-all rounded-2xl outline-none font-bold text-accent text-sm">{{ old('building', $about->building) }}</textarea>
        </div>

        <!-- Who We Serve / Impact -->
        <div class="bg-white rounded-[1.5rem] border border-accent/5 shadow-sm p-6 sm:p-8">
            <p class="text-[10px] font-black uppercase tracking-[0.3em] text-accent/30 mb-6 sm:mb-8">8. Who We Serve / Impact</p>
            <div class="space-y-6">
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-3">Impact Description</label>
                    <textarea name="impact" rows="5"
                              class="w-full px-6 py-4 bg-surface border-2 border-transparent focus:border-brand transition-all rounded-2xl outline-none font-bold text-accent text-sm">{{ old('impact', $about->impact) }}</textarea>
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-3">Testimonial / Quote (optional)</label>
                    <textarea name="testimonial" rows="3"
                              class="w-full px-6 py-4 bg-surface border-2 border-transparent focus:border-brand transition-all rounded-2xl outline-none font-bold text-accent">{{ old('testimonial', $about->testimonial) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Team Teaser -->
        <div class="bg-white rounded-[1.5rem] border border-accent/5 shadow-sm p-6 sm:p-8">
            <p class="text-[10px] font-black uppercase tracking-[0.3em] text-accent/30 mb-6 sm:mb-8">10. Meet the Team (Teaser)</p>
            <textarea name="team_teaser" rows="2"
                      class="w-full px-6 py-4 bg-surface border-2 border-transparent focus:border-brand transition-all rounded-2xl outline-none font-bold text-accent">{{ old('team_teaser', $about->team_teaser) }}</textarea>
        </div>

        <!-- Call to Action -->
        <div class="bg-white rounded-[1.5rem] border border-accent/5 shadow-sm p-6 sm:p-8">
            <p class="text-[10px] font-black uppercase tracking-[0.3em] text-accent/30 mb-6 sm:mb-8">11. Call to Action</p>
            <div class="space-y-6">
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-3">Heading</label>
                    <input type="text" name="cta_heading" value="{{ old('cta_heading', $about->cta_heading) }}"
                           class="w-full px-6 py-4 bg-surface border-2 border-transparent focus:border-brand transition-all rounded-2xl outline-none font-bold text-accent">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-3">Text</label>
                    <textarea name="cta_text" rows="2"
                              class="w-full px-6 py-4 bg-surface border-2 border-transparent focus:border-brand transition-all rounded-2xl outline-none font-bold text-accent">{{ old('cta_text', $about->cta_text) }}</textarea>
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-8 sm:px-10 py-4 bg-brand text-white font-black text-xs uppercase tracking-[0.3em] rounded-2xl hover:bg-accent transition-all">
                Save About Page Content
            </button>
        </div>

    </form>

    <!-- Videos Section -->
    <div class="bg-white rounded-[1.5rem] border border-accent/5 shadow-sm p-6 sm:p-8 mt-8">
        <p class="text-[10px] font-black uppercase tracking-[0.3em] text-accent/30 mb-6 sm:mb-8">9. Our Story in Song / Media Section</p>

        <!-- Upload Form -->
        <form method="POST" action="{{ route('admin.about.videos.store') }}" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6 items-end mb-8 pb-8 border-b border-accent/5">
            @csrf
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-3">Video Title</label>
                <input type="text" name="title" required
                       class="w-full px-6 py-4 bg-surface border-2 border-transparent focus:border-brand transition-all rounded-2xl outline-none font-bold text-accent"
                       placeholder="e.g., Black Unikonz - Limodzi Tingathe (Official HD Video)">
            </div>
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-3">Video File</label>
                <input type="file" name="video" accept="video/mp4,video/quicktime,video/x-msvideo,video/webm" required
                       class="w-full px-4 py-3 bg-surface border-2 border-transparent focus:border-brand transition-all rounded-2xl outline-none text-sm font-bold text-accent/60">
                <p class="text-[10px] text-accent/30 mt-2 font-bold">MP4, MOV, AVI, or WebM — max 50MB</p>
            </div>
            <div class="md:col-span-2">
                <button type="submit" class="px-8 py-3 bg-accent text-white font-black text-xs uppercase tracking-widest rounded-2xl hover:bg-brand transition-all">
                    Upload Video
                </button>
            </div>
        </form>

        <!-- Video List -->
        @if($videos->isEmpty())
            <p class="text-center text-accent/40 font-bold py-6">No videos uploaded yet.</p>
        @else
            <div class="space-y-3">
                @foreach($videos as $video)
                <div class="flex items-center justify-between p-4 bg-surface rounded-2xl">
                    <div class="flex items-center gap-4 min-w-0">
                        <div class="w-12 h-12 rounded-xl bg-accent/5 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-accent/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="font-black text-accent text-sm truncate">{{ $video->title }}</p>
                            <a href="{{ $video->url }}" target="_blank" class="text-xs text-brand hover:underline">Preview</a>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('admin.about.videos.destroy', $video) }}" id="delete-video-form-{{ $video->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="confirmDelete('Remove this video?', document.getElementById('delete-video-form-{{ $video->id }}'))" class="text-red-500 hover:text-red-700 transition p-2 shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
        @endif
    </div>

@endsection