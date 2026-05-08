<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Contact;
use App\Mail\ContactNotification;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function home()
    {
        // Hero image from site_settings
        $heroImagePath = DB::table('site_settings')
            ->where('key', 'hero_image')->value('value');

        // Logo from site_settings
        $logo = DB::table('site_settings')
            ->where('key', 'logo')->value('value');

        // Phone from site_settings
        $phone = DB::table('site_settings')
            ->where('key', 'phone_number')->value('value') ?? '0994392275';

        // Latest published news post
        $heroPost = DB::table('news_posts')
            ->where('published', 1)
            ->orderByDesc('created_at')
            ->first();

        // All published news posts
        $newsPosts = DB::table('news_posts')
            ->where('published', 1)
            ->orderByDesc('created_at')
            ->get();

        return view('pages.home', compact('heroPost', 'newsPosts', 'logo', 'phone', 'heroImagePath'));
    }

    public function news()
    {
        $newsPosts = DB::table('news_posts')
            ->where('published', 1)
            ->orderByDesc('created_at')
            ->get();

        $comingSoonText = DB::table('site_settings')
            ->where('key', 'news_coming_soon_text')->value('value');

        return view('pages.news', compact('newsPosts', 'comingSoonText'));
    }
    public function progress()
    {
       $progressUpdates = \App\Models\ProgressUpdate::orderBy('update_date', 'desc')->get();
       $totalProgress = \App\Models\ProgressUpdate::getTotalProgress();
       return view('pages.progress', compact('progressUpdates', 'totalProgress'));
     } 
    public function donate()
    {
        return view('pages.donate');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function contactSend(Request $request)
    {
        $validated = $request->validate([
            'email'   => 'required|email|max:255',
            'message' => 'required|string|max:5000',
            'ideas'   => 'nullable|string|max:5000',
        ]);

        $contact = Contact::create($validated);

        Mail::to('katemaphacio4@gmail.com')->send(new ContactNotification($contact));

        return redirect()->route('contact')->with('success', true);
    }
}