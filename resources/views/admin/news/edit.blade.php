@extends('admin.layout')

@section('title', 'Edit Post')
@section('page_title', 'Edit News Post')

@section('content')

    <div class="max-w-3xl">
        <form method="POST" action="{{ route('admin.news.update', $news) }}" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-[1.5rem] border border-accent/5 shadow-sm p-8 space-y-6">
                <p class="text-[10px] font-black uppercase tracking-[0.3em] text-accent/30">Post Details</p>

                <!-- Title -->
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-3">Title</label>
                    <input type="text" name="title" value="{{ old('title', $news->title) }}" required
                           class="w-full px-6 py-4 bg-surface border-2 {{ $errors->has('title') ? 'border-brand' : 'border-transparent' }} focus:border-brand transition-all rounded-2xl outline-none font-bold text-accent"
                           placeholder="Post title...">
                    @error('title')
                        <p class="text-brand text-xs font-bold mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Summary -->
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-3">Summary <span class="text-accent/20">(optional)</span></label>
                    <textarea name="summary" rows="2"
                              class="w-full px-6 py-4 bg-surface border-2 {{ $errors->has('summary') ? 'border-brand' : 'border-transparent' }} focus:border-brand transition-all rounded-2xl outline-none font-bold text-accent"
                              placeholder="Short summary of the post...">{{ old('summary', $news->summary) }}</textarea>
                    @error('summary')
                        <p class="text-brand text-xs font-bold mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Body -->
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-3">Body</label>
                    <textarea name="body" rows="10" required
                              class="w-full px-6 py-4 bg-surface border-2 {{ $errors->has('body') ? 'border-brand' : 'border-transparent' }} focus:border-brand transition-all rounded-2xl outline-none font-bold text-accent"
                              placeholder="Write the full article here...">{{ old('body', $news->body) }}</textarea>
                    @error('body')
                        <p class="text-brand text-xs font-bold mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image -->
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-3">Image</label>
                    @if($news->image)
                        <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="h-24 w-auto rounded-xl mb-4 object-cover">
                        <p class="text-[10px] text-accent/30 font-bold mb-3">Upload new image to replace current one</p>
                    @endif
                    <input type="file" name="image" accept="image/*"
                           class="w-full px-4 py-3 bg-surface border-2 border-transparent focus:border-brand transition-all rounded-2xl outline-none text-sm font-bold text-accent/60">
                    @error('image')
                        <p class="text-brand text-xs font-bold mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Published -->
                <div class="flex items-center gap-3">
                    <input type="checkbox" name="published" id="published" value="1" {{ $news->published ? 'checked' : '' }}
                           class="rounded border-accent/20 text-brand focus:ring-brand">
                    <label for="published" class="text-xs font-black uppercase tracking-widest text-accent/50">Published</label>
                </div>

            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('admin.news.index') }}" class="px-6 py-3 bg-white border border-accent/10 text-accent font-black text-xs uppercase tracking-widest rounded-xl hover:border-brand hover:text-brand transition-all">
                    Cancel
                </a>
                <button type="submit" class="px-10 py-4 bg-brand text-white font-black text-xs uppercase tracking-[0.3em] rounded-2xl hover:bg-accent transition-all">
                    Update Post
                </button>
            </div>

        </form>
    </div>

@endsection