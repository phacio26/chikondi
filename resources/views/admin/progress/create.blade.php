@extends('admin.layout')

@section('title', 'Add Progress Update')
@section('page_title', 'Add Progress Update')

@section('content')
<form method="POST" action="{{ route('admin.progress.store') }}" enctype="multipart/form-data" class="max-w-3xl">
    @csrf

    <div class="bg-white rounded-2xl border border-accent/5 p-8 space-y-6">
        <!-- Title -->
        <div>
            <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-3">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" required
                   class="w-full px-6 py-4 bg-surface border-2 border-transparent focus:border-brand rounded-2xl outline-none font-bold text-accent">
        </div>

        <!-- Description -->
        <div>
            <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-3">Description</label>
            <textarea name="description" rows="6" required
                      class="w-full px-6 py-4 bg-surface border-2 border-transparent focus:border-brand rounded-2xl outline-none font-bold text-accent">{{ old('description') }}</textarea>
        </div>

        <!-- Image -->
        <div>
            <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-3">Image</label>
            <input type="file" name="image" accept="image/*"
                   class="w-full px-6 py-4 bg-surface border-2 border-transparent focus:border-brand rounded-2xl outline-none text-sm">
        </div>

        <!-- Status -->
        <div>
            <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-3">Status</label>
            <select name="status" required
                    class="w-full px-6 py-4 bg-surface border-2 border-transparent focus:border-brand rounded-2xl outline-none font-bold text-accent">
                <option value="in_progress">In Progress</option>
                <option value="completed">Completed</option>
                <option value="planned">Planned</option>
            </select>
        </div>

        <!-- Percentage -->
        <div>
            <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-3">Completion Percentage (0-100)</label>
            <input type="number" name="percentage" value="{{ old('percentage', 0) }}" min="0" max="100" required
                   class="w-full px-6 py-4 bg-surface border-2 border-transparent focus:border-brand rounded-2xl outline-none font-bold text-accent">
        </div>

        <!-- Update Date -->
        <div>
            <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-3">Update Date</label>
            <input type="date" name="update_date" value="{{ old('update_date', date('Y-m-d')) }}" required
                   class="w-full px-6 py-4 bg-surface border-2 border-transparent focus:border-brand rounded-2xl outline-none font-bold text-accent">
        </div>

        <!-- Featured -->
        <div>
            <label class="flex items-center gap-3 cursor-pointer">
                <input type="checkbox" name="is_featured" value="1" class="w-5 h-5 rounded border-accent/20 text-brand focus:ring-brand">
                <span class="text-[10px] font-black uppercase tracking-widest text-accent/40">Feature this update (show on top)</span>
            </label>
        </div>
    </div>

    <div class="mt-6 flex gap-4">
        <button type="submit" class="px-8 py-4 bg-brand text-white font-black text-xs uppercase tracking-widest rounded-2xl hover:bg-accent transition-all">
            Save Update
        </button>
        <a href="{{ route('admin.progress.index') }}" class="px-8 py-4 bg-surface text-accent font-black text-xs uppercase tracking-widest rounded-2xl hover:bg-accent/10 transition-all">
            Cancel
        </a>
    </div>
</form>
@endsection