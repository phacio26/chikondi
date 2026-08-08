<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TeamController extends Controller
{
    public function index()
    {
        $members = TeamMember::orderBy('order')->orderBy('created_at', 'desc')->get();
        return view('admin.team.index', compact('members'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'role'  => 'required|string|max:255',
            'bio'   => 'nullable|string',
            'order' => 'nullable|integer',
            'photo' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $this->uploadToCloudinary($request->file('photo'));
        }

        TeamMember::create($validated);

        return redirect()->route('admin.team.index')->with('success', 'Team member added successfully.');
    }

    public function edit(TeamMember $team)
    {
        return view('admin.team.edit', ['member' => $team]);
    }

    public function update(Request $request, TeamMember $team)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'role'  => 'required|string|max:255',
            'bio'   => 'nullable|string',
            'order' => 'nullable|integer',
            'photo' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $this->uploadToCloudinary($request->file('photo'));
        }

        $team->update($validated);

        return redirect()->route('admin.team.index')->with('success', 'Team member updated successfully.');
    }

    public function destroy(TeamMember $team)
    {
        $team->delete();
        return redirect()->route('admin.team.index')->with('success', 'Team member removed.');
    }

    private function uploadToCloudinary($file)
    {
        $cloudName = config('services.cloudinary.cloud_name', env('CLOUDINARY_CLOUD_NAME'));
        $apiKey    = config('services.cloudinary.api_key', env('CLOUDINARY_API_KEY'));
        $apiSecret = config('services.cloudinary.api_secret', env('CLOUDINARY_API_SECRET'));

        $timestamp = time();
        $paramsToSign = "timestamp={$timestamp}";
        $signature = sha1($paramsToSign . $apiSecret);

        $response = Http::attach(
            'file', file_get_contents($file->getRealPath()), $file->getClientOriginalName()
        )->post("https://api.cloudinary.com/v1_1/{$cloudName}/image/upload", [
            'api_key'   => $apiKey,
            'timestamp' => $timestamp,
            'signature' => $signature,
        ]);

        return $response->json('secure_url');
    }
}