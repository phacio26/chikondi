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
    try {
        $request->validate([
            'title' => 'required|string|max:255',
            'video' => 'required|mimes:mp4,mov,avi,webm|max:51200', // 50MB
        ]);

        $cloudName = 'dtayyciom';
        $uploadPreset = 'chikondi_preset';
        $file = $request->file('video');

        // Log file info
        \Log::info('Attempting video upload', [
            'filename' => $file->getClientOriginalName(),
            'size' => $file->getSize(),
            'mime' => $file->getMimeType()
        ]);

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
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error = curl_error($curl);
        curl_close($curl);

        // Log the response
        \Log::info('Cloudinary response', [
            'http_code' => $httpCode,
            'response' => $response
        ]);

        if ($error) {
            \Log::error("Cloudinary video upload error: " . $error);
            return back()->with('error', 'Upload failed: ' . $error);
        }

        $result = json_decode($response, true);

        // Check for Cloudinary error
        if (isset($result['error'])) {
            $errorMsg = $result['error']['message'] ?? 'Unknown Cloudinary error';
            \Log::error("Cloudinary error: " . $errorMsg);
            return back()->with('error', 'Cloudinary error: ' . $errorMsg);
        }

        if (!isset($result['secure_url'])) {
            \Log::error("Cloudinary upload failed. Response: " . $response);
            return back()->with('error', 'Upload failed - no URL returned');
        }

        // Try to save to database
        try {
            AboutVideo::create([
                'title' => $request->title,
                'url' => $result['secure_url'],
            ]);
            return back()->with('success', 'Video uploaded successfully!');
        } catch (\Exception $dbError) {
            \Log::error('Database save failed: ' . $dbError->getMessage());
            return back()->with('warning', 'Video uploaded to Cloudinary but failed to save to database: ' . $dbError->getMessage());
        }

    } catch (\Illuminate\Validation\ValidationException $e) {
        return back()->withErrors($e->errors())->withInput();
    } catch (\Exception $e) {
        \Log::error('Upload exception: ' . $e->getMessage());
        return back()->with('error', 'Upload failed: ' . $e->getMessage());
    }
}
    public function destroyVideo(AboutVideo $video)
    {
        $video->delete();

        return back()->with('success', 'Video removed.');
    }
}