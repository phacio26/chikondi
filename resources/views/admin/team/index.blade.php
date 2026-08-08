@extends('admin.layout')

@section('title', 'Team Members')
@section('page_title', 'Team Members')

@section('content')
<div class="flex justify-end mb-4">
    <a href="{{ route('admin.team.create') }}" class="inline-flex items-center gap-2 px-5 py-3 bg-brand text-white font-black text-xs uppercase tracking-widest rounded-xl hover:bg-accent transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Add Team Member
    </a>
</div>

<div class="bg-white rounded-2xl border border-accent/5 overflow-hidden">

    @if($members->isEmpty())
        <div class="text-center py-12">
            <p class="font-black text-accent/40 text-sm">No team members yet</p>
            <p class="text-xs text-accent/30 mt-1">Click "Add Team Member" to create the first entry.</p>
        </div>
    @else
        <div class="divide-y divide-accent/5">
            @foreach($members as $member)
            <div class="flex items-center justify-between p-4 hover:bg-surface/50 transition">
                <div class="flex items-center gap-4 min-w-0">
                    <div class="w-12 h-12 rounded-full bg-surface overflow-hidden shrink-0">
                        @if($member->photo)
                            <img src="{{ $member->photo }}" alt="{{ $member->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-accent/20 font-black">
                                {{ substr($member->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <div class="min-w-0">
                        <p class="font-black text-accent text-sm truncate">{{ $member->name }}</p>
                        <p class="text-xs text-accent/40 mt-1">{{ $member->role }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-2 shrink-0">
                    <a href="{{ route('admin.team.edit', $member) }}" class="text-accent/50 hover:text-brand transition p-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </a>
                    <form method="POST" action="{{ route('admin.team.destroy', $member) }}" id="delete-form-{{ $member->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="confirmDelete('Remove this team member?', document.getElementById('delete-form-{{ $member->id }}'))" class="text-red-500 hover:text-red-700 transition p-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    @endif

</div>
@endsection