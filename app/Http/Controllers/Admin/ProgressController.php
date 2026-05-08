<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgressUpdate;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;

class ProgressController extends Controller
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
        $progress = ProgressUpdate::orderBy('update_date', 'desc')->get();
        return view('admin.progress.index', compact('progress'));
    }

    public function create()
    {
        return view('admin.progress.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|max:2048',
            'status'      => 'required|in:completed,in_progress,planned',
            'percentage'  => 'required|integer|min:0|max:100',
            'update_date' => 'required|date',
            'is_featured' => 'boolean',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $uploaded = $this->getCloudinary()->uploadApi()->upload(
                $request->file('image')->getRealPath(),
                ['folder' => 'chikondi/progress']
            );
            $data['image'] = $uploaded['secure_url'];
        }

        ProgressUpdate::create($data);
        return redirect()->route('admin.progress.index')->with('success', 'Progress update created successfully.');
    }

    public function edit(ProgressUpdate $progress)
    {
        return view('admin.progress.edit', compact('progress'));
    }

    public function update(Request $request, ProgressUpdate $progress)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|max:20480',
            'status'      => 'required|in:completed,in_progress,planned',
            'percentage'  => 'required|integer|min:0|max:100',
            'update_date' => 'required|date',
            'is_featured' => 'boolean',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $uploaded = $this->getCloudinary()->uploadApi()->upload(
                $request->file('image')->getRealPath(),
                ['folder' => 'chikondi/progress']
            );
            $data['image'] = $uploaded['secure_url'];
        }

        $progress->update($data);
        return redirect()->route('admin.progress.index')->with('success', 'Progress update updated successfully.');
    }

    public function destroy(ProgressUpdate $progress)
    {
        $progress->delete();
        return redirect()->route('admin.progress.index')->with('success', 'Progress update deleted successfully.');
    }
}