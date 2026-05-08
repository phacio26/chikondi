@extends('admin.layout')

@section('title', 'Settings')
@section('page_title', 'Site Settings')

@section('content')
@php use App\Models\SiteSetting; @endphp

    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- Logo & Images -->
        <div class="bg-white rounded-[1.5rem] border border-accent/5 shadow-sm p-6 sm:p-8">
            <p class="text-[10px] font-black uppercase tracking-[0.3em] text-accent/30 mb-6 sm:mb-8">Logo & Images</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">

                <!-- Logo -->
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-4">Logo</label>
                    @if(SiteSetting::get('logo'))
                        <img src="{{ asset('storage/' . SiteSetting::get('logo')) }}" alt="Current Logo" class="h-16 w-auto mb-4 rounded-xl">
                    @else
                        <img src="{{ asset('images/logo.png') }}" alt="Current Logo" class="h-16 w-auto mb-4 rounded-xl">
                    @endif
                    <input type="file" name="logo" accept="image/*"
                           class="w-full px-4 py-3 bg-surface border-2 border-transparent focus:border-brand transition-all rounded-2xl outline-none text-sm font-bold text-accent/60">
                    <p class="text-[10px] text-accent/30 mt-2 font-bold">Upload new logo to replace current one</p>
                </div>

                <!-- Hero Image -->
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-4">Hero Image</label>
                    @if(SiteSetting::get('hero_image'))
                        <img src="{{ asset('storage/' . SiteSetting::get('hero_image')) }}" alt="Current Hero" class="h-16 w-auto mb-4 rounded-xl object-cover">
                    @else
                        <img src="{{ asset('images/home-hero-section.png') }}" alt="Current Hero" class="h-16 w-auto mb-4 rounded-xl object-cover">
                    @endif
                    <input type="file" name="hero_image" accept="image/*"
                           class="w-full px-4 py-3 bg-surface border-2 border-transparent focus:border-brand transition-all rounded-2xl outline-none text-sm font-bold text-accent/60">
                    <p class="text-[10px] text-accent/30 mt-2 font-bold">Upload new hero image to replace current one</p>
                </div>

                <!-- Mother & Child Image -->
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-4">Mother & Child Side Image</label>
                    @if(SiteSetting::get('mother_child_image'))
                        <img src="{{ asset('storage/' . SiteSetting::get('mother_child_image')) }}" alt="Current Mother & Child" class="h-16 w-auto mb-4 rounded-xl object-cover">
                    @else
                        <img src="{{ asset('images/mother-joy-malawi.png') }}" alt="Default Mother & Child" class="h-16 w-auto mb-4 rounded-xl object-cover">
                    @endif
                    <input type="file" name="mother_child_image" accept="image/*"
                           class="w-full px-4 py-3 bg-surface border-2 border-transparent focus:border-brand transition-all rounded-2xl outline-none text-sm font-bold text-accent/60">
                    <p class="text-[10px] text-accent/30 mt-2 font-bold">Upload image for the right side section</p>
                </div>

            </div>
        </div>

        <!-- Bank Details Section -->
        <div class="bg-white rounded-[1.5rem] border border-accent/5 shadow-sm p-6 sm:p-8">
            <p class="text-[10px] font-black uppercase tracking-[0.3em] text-accent/30 mb-6 sm:mb-8">Bank Details</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
                <!-- Bank Name -->
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-3">Bank Name</label>
                    <input type="text" name="bank_name" value="{{ SiteSetting::get('bank_name', '') }}"
                           class="w-full px-6 py-4 bg-surface border-2 border-transparent focus:border-brand transition-all rounded-2xl outline-none font-bold text-accent"
                           placeholder="e.g., National Bank of Malawi">
                </div>

                <!-- Account Name -->
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-3">Account Name</label>
                    <input type="text" name="account_name" value="{{ SiteSetting::get('account_name', '') }}"
                           class="w-full px-6 py-4 bg-surface border-2 border-transparent focus:border-brand transition-all rounded-2xl outline-none font-bold text-accent"
                           placeholder="e.g., Chikondi Organisation">
                </div>

                <!-- Account Number -->
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-3">Account Number</label>
                    <input type="text" name="account_number" value="{{ SiteSetting::get('account_number', '') }}"
                           class="w-full px-6 py-4 bg-surface border-2 border-transparent focus:border-brand transition-all rounded-2xl outline-none font-bold text-accent"
                           placeholder="e.g., 1234567890">
                </div>

                <!-- Branch -->
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-3">Branch</label>
                    <input type="text" name="branch" value="{{ SiteSetting::get('branch', '') }}"
                           class="w-full px-6 py-4 bg-surface border-2 border-transparent focus:border-brand transition-all rounded-2xl outline-none font-bold text-accent"
                           placeholder="e.g., Lilongwe Main Branch">
                </div>
            </div>
        </div>

        <!-- Contact & Other Settings -->
        <div class="bg-white rounded-[1.5rem] border border-accent/5 shadow-sm p-6 sm:p-8">
            <p class="text-[10px] font-black uppercase tracking-[0.3em] text-accent/30 mb-6 sm:mb-8">Contact & Content</p>

            <div class="space-y-6">
                <!-- Phone Number -->
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-3">Phone Number</label>
                    <input type="text" name="phone_number" value="{{ SiteSetting::get('phone_number', '0994392275') }}"
                           class="w-full px-6 py-4 bg-surface border-2 border-transparent focus:border-brand transition-all rounded-2xl outline-none font-bold text-accent">
                </div>

              

                <!-- News Coming Soon Text -->
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-3"> Latest Stories & Updates</label>
                    <textarea name="news_coming_soon_text" rows="3"
                              class="w-full px-6 py-4 bg-surface border-2 border-transparent focus:border-brand transition-all rounded-2xl outline-none font-bold text-accent">{{ SiteSetting::get('news_coming_soon_text', 'We are preparing stories, progress updates, and community news from Chikondi Organisation. Please check back soon.') }}</textarea>
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-8 sm:px-10 py-4 bg-brand text-white font-black text-xs uppercase tracking-[0.3em] rounded-2xl hover:bg-accent transition-all">
                Save Settings
            </button>
        </div>

    </form>

@endsection

@section('extra_scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Prevent form submission on Enter key in text inputs
        const form = document.querySelector('form');
        if (form) {
            const inputs = form.querySelectorAll('input:not([type="submit"]):not([type="file"]), textarea');
            
            inputs.forEach(input => {
                input.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        return false;
                    }
                });
            });
        }
    });
</script>
@endsection