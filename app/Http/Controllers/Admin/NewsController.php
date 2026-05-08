<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $posts = NewsPost::latest()->paginate(10);
        return view('admin.news.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'     => 'required|string|max:255',
            'excerpt'   => 'nullable|string|max:500',
            'body'      => 'required|string',
            'image'     => 'nullable|image|max:20480', // Changed from 2048 to 20480 (20MB)
            'published' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('news', 'public');
        }

        $validated['published'] = $request->boolean('published');

        NewsPost::create($validated);

        return redirect()->route('admin.news.index')->with('success', 'News post created successfully.');
    }

    public function edit(NewsPost $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, NewsPost $news)
    {
        $validated = $request->validate([
            'title'     => 'required|string|max:255',
            'excerpt'   => 'nullable|string|max:500',
            'body'      => 'required|string',
            'image'     => 'nullable|image|max:20480',  
            'published' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $validated['image'] = $request->file('image')->store('news', 'public');
        }

        $validated['published'] = $request->boolean('published');

        $news->update($validated);

        return redirect()->route('admin.news.index')->with('success', 'News post updated successfully.');
    }

    public function destroy(NewsPost $news)
    {
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'News post deleted successfully.');
    }
}