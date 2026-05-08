<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgressUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgressController extends Controller
{
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|in:completed,in_progress,planned',
            'percentage' => 'required|integer|min:0|max:100',
            'update_date' => 'required|date',
            'is_featured' => 'boolean',
        ]);

        $data = $request->except('image');
        
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('progress', 'public');
            $data['image'] = $path;
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image'     => 'nullable|image|max:20480',
            'status' => 'required|in:completed,in_progress,planned',
            'percentage' => 'required|integer|min:0|max:100',
            'update_date' => 'required|date',
            'is_featured' => 'boolean',
        ]);

        $data = $request->except('image');
        
        if ($request->hasFile('image')) {
            if ($progress->image) {
                Storage::disk('public')->delete($progress->image);
            }
            $path = $request->file('image')->store('progress', 'public');
            $data['image'] = $path;
        }

        $progress->update($data);

        return redirect()->route('admin.progress.index')->with('success', 'Progress update updated successfully.');
    }

    public function destroy(ProgressUpdate $progress)
    {
        if ($progress->image) {
            Storage::disk('public')->delete($progress->image);
        }
        $progress->delete();
        return redirect()->route('admin.progress.index')->with('success', 'Progress update deleted successfully.');
    }
}