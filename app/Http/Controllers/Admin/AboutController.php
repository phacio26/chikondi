<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use App\Models\AboutVideo;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Show the admin About Us management screen (page content + videos).
     */
    public function index()
    {
        $about = AboutPage::getInstance();
        $videos = AboutVideo::orderBy('order')->orderBy('created_at')->get();

        return view('admin.about.index', compact('about', 'videos'));
    }

    /**
     * Update the About Us page text content.
     */
    public function update(Request $request)
    {
        set_time_limit(300);

        $validated = $request->validate([
            'hero_heading'    => 'nullable|string|max:150',
            'hero_subheading' => 'nullable|string|max:500',
            'story'           => 'nullable|string|max:4000',
            'problem'         => 'nullable|string|max:4000',
            'mission'         => 'nullable|string|max:500',
            'vision'          => 'nullable|string|max:500',
            'values'          => 'nullable|string|max:2000',
            'building'        => 'nullable|string|max:2000',
            'impact'          => 'nullable|string|max:2000',
            'testimonial'     => 'nullable|string|max:1000',
            'team_teaser'     => 'nullable|string|max:500',
            'cta_heading'     => 'nullable|string|max:150',
            'cta_text'        => 'nullable|string|max:500',
        ]);

        $about = AboutPage::getInstance();
        $about->update($validated);

        return redirect()->route('admin.about.index')->with('success', 'About Us page updated successfully.');
    }

    /**
     * Upload a new video for the About Us page.
     */
    public function storeVideo(Request $request)
    {
        set_time_limit(300);

        $request->validate([
            'title' => 'required|string|max:150',
            'video' => 'required|file|mimetypes:video/mp4,video/quicktime,video/x-msvideo,video/webm|max:51200', // 50MB
        ]);

        $file = $request->file('video');

        // Upload to Cloudinary as a video resource
        $cloudName = 'dtayyciom';
        $uploadPreset = 'chikondi_preset';

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.cloudinary.com/v1_1/{$cloudName}/video/upload",
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => [
                'file' => curl_file_create($file->getRealPath(), $file->getMimeType(), $file->getClientOriginalName()),
                'upload_preset' => $uploadPreset,
                'folder' => 'chikondi/about_videos',
            ],
            CURLOPT_TIMEOUT => 300,
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);

        if ($error) {
            \Log::error("Cloudinary video upload error: " . $error);
            return redirect()->route('admin.about.index')->with('error', 'Video upload failed. Please try again.');
        }

        $result = json_decode($response, true);

        if (!isset($result['secure_url'])) {
            \Log::error("Cloudinary video upload response missing secure_url: " . $response);
            return redirect()->route('admin.about.index')->with('error', 'Video upload failed. Please try again.');
        }

        $maxOrder = AboutVideo::max('order') ?? 0;

        AboutVideo::create([
            'title' => $request->input('title'),
            'url'   => $result['secure_url'],
            'order' => $maxOrder + 1,
        ]);

        return redirect()->route('admin.about.index')->with('success', 'Video uploaded successfully.');
    }

    /**
     * Delete a video from the About Us page.
     */
    public function destroyVideo(AboutVideo $video)
    {
        $video->delete();

        return redirect()->route('admin.about.index')->with('success', 'Video removed.');
    }
}