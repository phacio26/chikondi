<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsPost;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;

class NewsController extends Controller
{
    private function getCloudinary()
    {
        return new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ]
        ]);
    }

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
            'image'     => 'nullable|image|max:20480',
            'published' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $uploaded = $this->getCloudinary()->uploadApi()->upload(
                $request->file('image')->getRealPath(),
                ['folder' => 'chikondi/news']
            );
            $validated['image'] = $uploaded['secure_url'];
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
            $uploaded = $this->getCloudinary()->uploadApi()->upload(
                $request->file('image')->getRealPath(),
                ['folder' => 'chikondi/news']
            );
            $validated['image'] = $uploaded['secure_url'];
        }

        $validated['published'] = $request->boolean('published');
        $news->update($validated);

        return redirect()->route('admin.news.index')->with('success', 'News post updated successfully.');
    }

    public function destroy(NewsPost $news)
    {
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'News post deleted successfully.');
    }
}