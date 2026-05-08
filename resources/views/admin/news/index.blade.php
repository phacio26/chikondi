@extends('admin.layout')

@section('title', 'News')
@section('page_title', 'News Posts')

@section('content')

    <div class="flex justify-between items-center mb-8">
        <p class="text-accent/40 text-sm font-bold">{{ $posts->total() }} posts total</p>
        <a href="{{ route('admin.news.create') }}" class="px-6 py-3 bg-brand text-white font-black text-xs uppercase tracking-widest rounded-xl hover:bg-accent transition-all">
            + New Post
        </a>
    </div>

    <div class="bg-white rounded-[1.5rem] border border-accent/5 shadow-sm overflow-hidden">

        @if($posts->isEmpty())
            <div class="text-center py-20">
                <div class="w-16 h-16 bg-brand/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                </div>
                <p class="font-black text-accent/30 uppercase tracking-widest text-sm">No posts yet</p>
                <a href="{{ route('admin.news.create') }}" class="inline-block mt-6 px-6 py-3 bg-brand text-white font-black text-xs uppercase tracking-widest rounded-xl hover:bg-accent transition-all">
                    Create First Post
                </a>
            </div>
        @else
            <table class="w-full">
                <thead>
                    <tr class="border-b border-accent/5">
                        <th class="text-left px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-accent/30">Title</th>
                        <th class="text-left px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-accent/30">Status</th>
                        <th class="text-left px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-accent/30">Date</th>
                        <th class="text-left px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-accent/30">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr class="border-b border-accent/5 hover:bg-surface transition-all">
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-4">
                                    @if($post->image)
                                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-12 h-12 rounded-xl object-cover">
                                    @else
                                        <div class="w-12 h-12 rounded-xl bg-brand/10 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-black text-sm text-accent">{{ $post->title }}</p>
                                        <p class="text-xs text-accent/40 mt-1">{{ Str::limit($post->excerpt ?? $post->body, 60) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                @if($post->published)
                                    <span class="px-3 py-1 bg-green-50 text-green-700 text-[10px] font-black uppercase tracking-widest rounded-full">Published</span>
                                @else
                                    <span class="px-3 py-1 bg-accent/5 text-accent/40 text-[10px] font-black uppercase tracking-widest rounded-full">Draft</span>
                                @endif
                            </td>
                            <td class="px-6 py-5">
                                <p class="text-xs font-bold text-accent/40">{{ $post->created_at->format('d M Y') }}</p>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-4">
                                    <a href="{{ route('admin.news.edit', $post) }}" class="text-[10px] font-black uppercase tracking-widest text-accent/50 hover:text-brand transition-all">Edit</a>
                                    <form method="POST" action="{{ route('admin.news.destroy', $post) }}" class="inline" id="delete-form-{{ $post->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete(null, 'Delete this news post? This action cannot be undone.', document.getElementById('delete-form-{{ $post->id }}'))" class="text-[10px] font-black uppercase tracking-widest text-brand hover:text-accent transition-all">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="px-6 py-4">
                {{ $posts->links() }}
            </div>
        @endif

    </div>

@endsection