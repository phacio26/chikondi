@extends('admin.layout')

@section('title', 'Edit Team Member')
@section('page_title', 'Edit Team Member')

@section('content')
<div class="bg-white rounded-2xl border border-accent/5 p-6 md:p-10 max-w-3xl">

    <form method="POST" action="{{ route('admin.team.update', $member) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        @if($member->photo)
        <div>
            <label class="block text-[11px] font-black uppercase tracking-widest text-accent mb-2">Current Photo</label>
            <img src="{{ $member->photo }}" alt="{{ $member->name }}" class="w-24 h-24 rounded-full object-cover border border-accent/10">
        </div>
        @endif

        <div>
            <label class="block text-[11px] font-black uppercase tracking-widest text-accent mb-2">Name</label>
            <input type="text" name="name" value="{{ old('name', $member->name) }}"
                   class="w-full px-4 py-3 bg-surface border border-accent/20 rounded-xl focus:border-brand outline-none text-sm font-semibold text-accent">
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-[11px] font-black uppercase tracking-widest text-accent mb-2">Role</label>
            <input type="text" name="role" value="{{ old('role', $member->role) }}"
                   class="w-full px-4 py-3 bg-surface border border-accent/20 rounded-xl focus:border-brand outline-none text-sm font-semibold text-accent">
            @error('role')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-[11px] font-black uppercase tracking-widest text-accent mb-2">Replace Photo (optional)</label>
            <input type="file" name="photo" accept="image/*"
                   class="w-full px-4 py-3 bg-surface border border-accent/20 rounded-xl text-sm font-semibold text-accent">
            @error('photo')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-[11px] font-black uppercase tracking-widest text-accent mb-2">Bio / Qualifications</label>
            <textarea name="bio" rows="8"
                      class="w-full px-4 py-3 bg-surface border border-accent/20 rounded-xl focus:border-brand outline-none text-sm font-semibold text-accent">{{ old('bio', $member->bio) }}</textarea>
            @error('bio')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-[11px] font-black uppercase tracking-widest text-accent mb-2">Display Order</label>
            <input type="number" name="order" value="{{ old('order', $member->order) }}"
                   class="w-full px-4 py-3 bg-surface border border-accent/20 rounded-xl focus:border-brand outline-none text-sm font-semibold text-accent">
            <p class="text-xs text-accent/40 mt-1">Lower numbers appear first.</p>
        </div>

        <div class="flex gap-3 pt-4">
            <button type="submit" class="px-8 py-3 bg-brand text-white font-black text-xs uppercase tracking-widest rounded-xl hover:bg-accent transition">
                Update Team Member
            </button>
            <a href="{{ route('admin.team.index') }}" class="px-8 py-3 border border-accent/20 text-accent font-black text-xs uppercase tracking-widest rounded-xl hover:bg-surface transition">
                Cancel
            </a>
        </div>

    </form>

</div>
@endsection