@extends('admin.layout')

@section('title', 'Edit Progress Update')
@section('page_title', 'Edit Progress Update')

@section('content')
<form method="POST" action="{{ route('admin.progress.update', $progress) }}" enctype="multipart/form-data" class="max-w-3xl">
    @csrf
    @method('PUT')

    <div class="bg-white rounded-2xl border border-accent/5 p-8 space-y-6">
        <!-- Title -->
        <div>
            <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-3">Title</label>
            <input type="text" name="title" value="{{ old('title', $progress->title) }}" required
                   class="w-full px-6 py-4 bg-surface border-2 border-transparent focus:border-brand rounded-2xl outline-none font-bold text-accent">
        </div>

        <!-- Description -->
        <div>
            <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-3">Description</label>
            <textarea name="description" rows="6" required
                      class="w-full px-6 py-4 bg-surface border-2 border-transparent focus:border-brand rounded-2xl outline-none font-bold text-accent">{{ old('description', $progress->description) }}</textarea>
        </div>

        <!-- Image -->
        <div>
            <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-3">Image</label>
            @if($progress->image)
                <img src="{{ asset('storage/' . $progress->image) }}" class="h-24 w-auto mb-3 rounded-xl">
            @endif
            <input type="file" name="image" accept="image/*"
                   class="w-full px-6 py-4 bg-surface border-2 border-transparent focus:border-brand rounded-2xl outline-none text-sm">
            <p class="text-[10px] text-accent/30 mt-2">Leave empty to keep current image</p>
        </div>

        <!-- Status -->
        <div>
            <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-3">Status</label>
            <select name="status" required
                    class="w-full px-6 py-4 bg-surface border-2 border-transparent focus:border-brand rounded-2xl outline-none font-bold text-accent">
                <option value="in_progress" {{ $progress->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="completed" {{ $progress->status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="planned" {{ $progress->status == 'planned' ? 'selected' : '' }}>Planned</option>
            </select>
        </div>

        <!-- Percentage -->
        <div>
            <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-3">Completion Percentage (0-100)</label>
            <input type="number" name="percentage" value="{{ old('percentage', $progress->percentage) }}" min="0" max="100" required
                   class="w-full px-6 py-4 bg-surface border-2 border-transparent focus:border-brand rounded-2xl outline-none font-bold text-accent">
        </div>

        <!-- Update Date -->
        <div>
            <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-3">Update Date</label>
            <input type="date" name="update_date" value="{{ old('update_date', $progress->update_date->format('Y-m-d')) }}" required
                   class="w-full px-6 py-4 bg-surface border-2 border-transparent focus:border-brand rounded-2xl outline-none font-bold text-accent">
        </div>

        <!-- Featured -->
        <div>
            <label class="flex items-center gap-3 cursor-pointer">
                <input type="checkbox" name="is_featured" value="1" {{ $progress->is_featured ? 'checked' : '' }} class="w-5 h-5 rounded border-accent/20 text-brand focus:ring-brand">
                <span class="text-[10px] font-black uppercase tracking-widest text-accent/40">Feature this update (show on top)</span>
            </label>
        </div>
    </div>

    <div class="mt-6 flex gap-4">
        <button type="submit" class="px-8 py-4 bg-brand text-white font-black text-xs uppercase tracking-widest rounded-2xl hover:bg-accent transition-all">
            Update
        </button>
        <a href="{{ route('admin.progress.index') }}" class="px-8 py-4 bg-surface text-accent font-black text-xs uppercase tracking-widest rounded-2xl hover:bg-accent/10 transition-all">
            Cancel
        </a>
    </div>
</form>
@endsection