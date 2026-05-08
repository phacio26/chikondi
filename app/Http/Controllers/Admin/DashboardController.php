<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsPost;
use App\Models\Contact;

class DashboardController extends Controller
{
    public function index()
    {
        $totalNews = NewsPost::count();
        $publishedNews = NewsPost::where('published', true)->count();
        $totalMessages = Contact::count();
        $unreadMessages = Contact::where('read', false)->count();

        return view('admin.dashboard', compact(
            'totalNews',
            'publishedNews',
            'totalMessages',
            'unreadMessages'
        ));
    }
}