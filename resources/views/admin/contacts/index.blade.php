@extends('admin.layout')

@section('title', 'Contact Messages')
@section('page_title', 'Contact Messages')

@section('content')
<div class="bg-white rounded-2xl border border-accent/5 overflow-hidden">
    
    @if($contacts->isEmpty())
        <div class="text-center py-12">
            <div class="w-16 h-16 bg-brand/10 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
            </div>
            <p class="font-black text-accent/40 text-sm">No messages yet</p>
            <p class="text-xs text-accent/30 mt-1">When someone contacts you, messages will appear here.</p>
        </div>
    @else
        <!-- Mobile Responsive Cards -->
        <div class="divide-y divide-accent/5">
            @foreach($contacts as $contact)
            <div class="p-4 hover:bg-surface/50 transition">
                <!-- Header with email and delete button -->
                <div class="flex justify-between items-start mb-3">
                    <div class="flex-1 mr-3">
                        <p class="font-bold text-accent text-sm break-all">{{ $contact->email }}</p>
                        <p class="text-xs text-accent/40 mt-1">{{ \Carbon\Carbon::parse($contact->created_at)->format('M d, Y H:i') }}</p>
                    </div>
                    <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}" class="inline shrink-0" id="delete-form-{{ $contact->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="confirmDelete('Delete this message?', document.getElementById('delete-form-{{ $contact->id }}'))" class="text-red-500 hover:text-red-700 transition p-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </form>
                </div>
                
                <!-- Ideas section (if exists) -->
                @if($contact->ideas && $contact->ideas != '—')
                <div class="mb-3">
                    <p class="text-[10px] font-black uppercase tracking-widest text-brand mb-1">How they can help</p>
                    <p class="text-sm text-accent/70 leading-relaxed">{{ $contact->ideas }}</p>
                </div>
                @endif
                
                <!-- Message section -->
                <div>
                    <p class="text-[10px] font-black uppercase tracking-widest text-accent/40 mb-1">Message</p>
                    <p class="text-sm text-accent/70 leading-relaxed">{{ $contact->message }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if(method_exists($contacts, 'links'))
        <div class="px-4 py-3 border-t border-accent/5">
            {{ $contacts->links() }}
        </div>
        @endif
    @endif

</div>
@endsection