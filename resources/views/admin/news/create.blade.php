@extends('admin.layout')

@section('title', 'Create Post')
@section('page_title', 'Create News Post')

@section('content')

    <div class="max-w-3xl">
        <form method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <div class="bg-white rounded-[1.5rem] border border-accent/5 shadow-sm p-8 space-y-6">
                <p class="text-[10px] font-black uppercase tracking-[0.3em] text-accent/30">Post Details</p>

                <!-- Title -->
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-3">Title</label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                           class="w-full px-6 py-4 bg-surface border-2 {{ $errors->has('title') ? 'border-brand' : 'border-transparent' }} focus:border-brand transition-all rounded-2xl outline-none font-bold text-accent"
                           placeholder="Post title...">
                    @error('title')
                        <p class="text-brand text-xs font-bold mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Excerpt -->
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-3">
                        Excerpt <span class="text-accent/20">(optional)</span>
                    </label>
                    <textarea name="excerpt" rows="2"
                              class="w-full px-6 py-4 bg-surface border-2 {{ $errors->has('excerpt') ? 'border-brand' : 'border-transparent' }} focus:border-brand transition-all rounded-2xl outline-none font-bold text-accent"
                              placeholder="Short summary shown on the news page...">{{ old('excerpt') }}</textarea>
                    @error('excerpt')
                        <p class="text-brand text-xs font-bold mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Body -->
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-3">Body</label>
                    <textarea name="body" rows="10" required
                              class="w-full px-6 py-4 bg-surface border-2 {{ $errors->has('body') ? 'border-brand' : 'border-transparent' }} focus:border-brand transition-all rounded-2xl outline-none font-bold text-accent"
                              placeholder="Write the full article here...">{{ old('body') }}</textarea>
                    @error('body')
                        <p class="text-brand text-xs font-bold mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image -->
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-3">
                        Image <span class="text-accent/20">(optional — only appears on news page, never as hero)</span>
                    </label>
                    <input type="file" name="image" accept="image/*"
                           class="w-full px-4 py-3 bg-surface border-2 border-transparent focus:border-brand transition-all rounded-2xl outline-none text-sm font-bold text-accent/60">
                    @error('image')
                        <p class="text-brand text-xs font-bold mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Published -->
                <div class="flex items-center gap-3">
                    <input type="checkbox" name="published" id="published" value="1" {{ old('published') ? 'checked' : '' }}
                           class="rounded border-accent/20 text-brand focus:ring-brand">
                    <label for="published" class="text-xs font-black uppercase tracking-widest text-accent/50">Publish immediately</label>
                </div>

            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('admin.news.index') }}" class="px-6 py-3 bg-white border border-accent/10 text-accent font-black text-xs uppercase tracking-widest rounded-xl hover:border-brand hover:text-brand transition-all">
                    Cancel
                </a>
                <button type="submit" class="px-10 py-4 bg-brand text-white font-black text-xs uppercase tracking-[0.3em] rounded-2xl hover:bg-accent transition-all">
                    Create Post
                </button>
            </div>

        </form>
    </div>

@endsection