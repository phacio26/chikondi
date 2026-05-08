@extends('admin.layout')

@section('title', 'Progress Updates')
@section('page_title', 'Progress Updates')

@section('content')

    <div class="flex justify-between items-center mb-8">
        <p class="text-accent/40 text-sm font-bold">{{ $progress->count() }} updates total</p>
        <a href="{{ route('admin.progress.create') }}" class="px-6 py-3 bg-brand text-white font-black text-xs uppercase tracking-widest rounded-xl hover:bg-accent transition-all">
            + New Update
        </a>
    </div>

    <div class="bg-white rounded-[1.5rem] border border-accent/5 shadow-sm overflow-hidden">

        @if($progress->isEmpty())
            <div class="text-center py-20">
                <div class="w-16 h-16 bg-brand/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <p class="font-black text-accent/30 uppercase tracking-widest text-sm">No progress updates yet</p>
                <a href="{{ route('admin.progress.create') }}" class="inline-block mt-6 px-6 py-3 bg-brand text-white font-black text-xs uppercase tracking-widest rounded-xl hover:bg-accent transition-all">
                    Create First Update
                </a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-accent/5">
                            <th class="text-left px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-accent/30">Image</th>
                            <th class="text-left px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-accent/30">Title</th>
                            <th class="text-left px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-accent/30">Status</th>
                            <th class="text-left px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-accent/30">Progress</th>
                            <th class="text-left px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-accent/30">Date</th>
                            <th class="text-left px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-accent/30">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($progress as $item)
                            <tr class="border-b border-accent/5 hover:bg-surface transition-all">
                                <td class="px-6 py-5">
                                    @if($item->image)
                                        <img src="{{ $item->image }}" alt="{{ $item->title }}" class="w-12 h-12 rounded-xl object-cover">
                                    @else
                                        <div class="w-12 h-12 rounded-xl bg-brand/10 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-5">
                                    <p class="font-black text-sm text-accent">{{ $item->title }}</p>
                                </td>
                                <td class="px-6 py-5">
                                    @if($item->status == 'completed')
                                        <span class="px-3 py-1 bg-green-50 text-green-700 text-[10px] font-black uppercase tracking-widest rounded-full">Completed</span>
                                    @elseif($item->status == 'in_progress')
                                        <span class="px-3 py-1 bg-blue-50 text-blue-700 text-[10px] font-black uppercase tracking-widest rounded-full">In Progress</span>
                                    @else
                                        <span class="px-3 py-1 bg-yellow-50 text-yellow-700 text-[10px] font-black uppercase tracking-widest rounded-full">Planned</span>
                                    @endif
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-2">
                                        <div class="w-24 h-2 bg-surface rounded-full overflow-hidden">
                                            <div class="h-full bg-brand rounded-full" style="width: {{ $item->percentage }}%"></div>
                                        </div>
                                        <span class="text-xs font-bold">{{ $item->percentage }}%</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <p class="text-xs font-bold text-accent/40">{{ \Carbon\Carbon::parse($item->update_date)->format('d M Y') }}</p>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-4">
                                        <a href="{{ route('admin.progress.edit', $item) }}" class="text-[10px] font-black uppercase tracking-widest text-accent/50 hover:text-brand transition-all">Edit</a>
                                        <form method="POST" action="{{ route('admin.progress.destroy', $item) }}" class="inline" id="delete-form-{{ $item->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete('Delete this progress update? This action cannot be undone.', document.getElementById('delete-form-{{ $item->id }}'))" class="text-[10px] font-black uppercase tracking-widest text-brand hover:text-accent transition-all">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

    </div>

@endsection