<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use App\Models\AboutVideo;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = AboutPage::getInstance();
        $videos = AboutVideo::orderBy('order')->orderBy('created_at')->get();

        return view('admin.about.index', compact('about', 'videos'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'hero_heading' => 'nullable|string|max:255',
            'hero_subheading' => 'nullable|string',
            'story' => 'nullable|string',
            'problem' => 'nullable|string',
            'mission' => 'nullable|string',
            'vision' => 'nullable|string',
            'values' => 'nullable|string',
            'building' => 'nullable|string',
            'impact' => 'nullable|string',
            'testimonial' => 'nullable|string',
            'team_teaser' => 'nullable|string',
            'cta_heading' => 'nullable|string|max:255',
            'cta_text' => 'nullable|string',
        ]);

        $about = AboutPage::getInstance();
        $about->update($validated);

        return back()->with('success', 'About page updated successfully.');
    }

    public function storeVideo(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video' => 'required|mimes:mp4,mov,avi,webm|max:51200', // 50MB
        ]);

        $cloudName = 'dtayyciom';
        $uploadPreset = 'chikondi_preset';

        $file = $request->file('video');

        // Video uploads use a different Cloudinary endpoint than images
        $url = "https://api.cloudinary.com/v1_1/{$cloudName}/video/upload";

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => [
                'file' => curl_file_create($file->getRealPath(), $file->getMimeType(), $file->getClientOriginalName()),
                'upload_preset' => $uploadPreset,
                'folder' => 'chikondi/about-videos',
            ],
            CURLOPT_TIMEOUT => 300,
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);

        if ($error) {
            \Log::error("Cloudinary video upload error: " . $error);
            return back()->with('error', 'Video upload failed. Please try again.');
        }

        $result = json_decode($response, true);

        if (!isset($result['secure_url'])) {
            \Log::error("Cloudinary video upload failed: " . $response);
            return back()->with('error', 'Video upload failed. Please try again.');
        }

        AboutVideo::create([
            'title' => $request->title,
            'url' => $result['secure_url'],
        ]);

        return back()->with('success', 'Video uploaded successfully.');
    }

    public function destroyVideo(AboutVideo $video)
    {
        $video->delete();

        return back()->with('success', 'Video removed.');
    }
}