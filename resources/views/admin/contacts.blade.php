@extends('admin.layout')

@section('title', 'Messages')
@section('page_title', 'Contact Messages')

@section('content')

    <div class="bg-white rounded-[1.5rem] border border-accent/5 shadow-sm overflow-hidden">

        @if($contacts->isEmpty())
            <div class="text-center py-20">
                <div class="w-16 h-16 bg-brand/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <p class="font-black text-accent/30 uppercase tracking-widest text-sm">No messages yet</p>
            </div>
        @else
            <table class="w-full">
                <thead>
                    <tr class="border-b border-accent/5">
                        <th class="text-left px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-accent/30">Email</th>
                        <th class="text-left px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-accent/30">Message</th>
                        <th class="text-left px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-accent/30">Ideas</th>
                        <th class="text-left px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-accent/30">Date</th>
                        <th class="text-left px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-accent/30">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact)
                        <tr class="border-b border-accent/5 {{ !$contact->read ? 'bg-brand/5' : '' }} hover:bg-surface transition-all">
                            <td class="px-6 py-5">
                                <p class="font-bold text-sm text-accent">{{ $contact->email }}</p>
                                @if(!$contact->read)
                                    <span class="text-[9px] font-black uppercase tracking-widest text-brand">New</span>
                                @endif
                            </td>
                            <td class="px-6 py-5">
                                <p class="text-sm text-accent/60 max-w-xs truncate">{{ $contact->message }}</p>
                            </td>
                            <td class="px-6 py-5">
                                <p class="text-sm text-accent/60 max-w-xs truncate">{{ $contact->ideas ?? '—' }}</p>
                            </td>
                            <td class="px-6 py-5">
                                <p class="text-xs font-bold text-accent/40">{{ $contact->created_at->format('d M Y') }}</p>
                            </td>
                            <td class="px-6 py-5">
                                <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}" onsubmit="return confirm('Delete this message?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-[10px] font-black uppercase tracking-widest text-brand hover:text-accent transition-all">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="px-6 py-4">
                {{ $contacts->links() }}
            </div>
        @endif

    </div>

@endsection