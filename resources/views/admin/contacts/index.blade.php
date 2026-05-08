@extends('admin.layout')

@section('title', 'Contact Messages')
@section('page_title', 'Contact Messages')

@section('content')
<div class="bg-white rounded-2xl border border-accent/5 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-surface border-b border-accent/5">
                <tr>
                    <th class="text-left px-6 py-4 text-[10px] font-black uppercase tracking-widest text-accent/40">Email</th>
                    <th class="text-left px-6 py-4 text-[10px] font-black uppercase tracking-widest text-accent/40">Ideas</th>
                    <th class="text-left px-6 py-4 text-[10px] font-black uppercase tracking-widest text-accent/40">Message</th>
                    <th class="text-left px-6 py-4 text-[10px] font-black uppercase tracking-widest text-accent/40">Date</th>
                    <th class="text-left px-6 py-4 text-[10px] font-black uppercase tracking-widest text-accent/40 w-24">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $contact)
                <tr class="border-b border-accent/5 hover:bg-surface/50 transition">
                    <td class="px-6 py-4">
                        <p class="font-bold text-accent break-all">{{ $contact->email }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-sm text-accent/70 max-w-xs">{{ \Illuminate\Support\Str::limit($contact->ideas, 80) ?: '—' }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-sm text-accent/70 max-w-md">{{ \Illuminate\Support\Str::limit($contact->message, 100) }}</p>
                    </td>
                    <td class="px-6 py-4 text-sm text-accent/60">
                        {{ \Carbon\Carbon::parse($contact->created_at)->format('M d, Y H:i') }}
                    </td>
                    <td class="px-6 py-4">
                        <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}" class="inline" id="delete-form-{{ $contact->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="confirmDelete(null, 'Delete this message?', document.getElementById('delete-form-{{ $contact->id }}'))" class="text-red-500 hover:text-red-700 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-accent/40">
                        <div class="flex flex-col items-center gap-4">
                            <svg class="w-16 h-16 text-accent/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <p class="font-black text-[10px] uppercase tracking-widest">No messages yet</p>
                            <p class="text-sm">When someone contacts you, messages will appear here.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection