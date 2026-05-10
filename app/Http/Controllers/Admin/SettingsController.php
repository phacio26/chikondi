<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all()->pluck('value', 'key');
        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        set_time_limit(300);
        
        $request->validate([
            'phone_number'          => 'nullable|string|max:20',
            'email'                 => 'nullable|email|max:100',
            'bank_name'             => 'nullable|string|max:100',
            'account_name'          => 'nullable|string|max:100',
            'account_number'        => 'nullable|string|max:50',
            'branch'                => 'nullable|string|max:100',
            'bank_details'          => 'nullable|string|max:255',
            'news_coming_soon_text' => 'nullable|string|max:500',
            'logo'                  => 'nullable|image|max:20480',
            'hero_image'            => 'nullable|image|max:20480',
            'mother_child_image'    => 'nullable|image|max:20480',
        ]);

        // Handle text settings
        $textSettings = [
            'phone_number', 'email', 'bank_name', 'account_name',
            'account_number', 'branch', 'bank_details', 'news_coming_soon_text',
        ];

        foreach ($textSettings as $key) {
            if ($request->has($key)) {
                SiteSetting::set($key, $request->input($key));
            }
        }

        // Cloudinary credentials
        $cloudName = 'dtayyciom';
        $apiKey = '616976622426686';
        $uploadPreset = 'chikondi_preset'; // CHANGE THIS to your new preset name

        $imageSettings = ['logo', 'hero_image', 'mother_child_image'];

        foreach ($imageSettings as $key) {
            if ($request->hasFile($key)) {
                $file = $request->file($key);
                
                // Upload to Cloudinary using cURL
                $url = "https://api.cloudinary.com/v1_1/{$cloudName}/upload";
                
                $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_URL => $url,
                    CURLOPT_POST => true,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POSTFIELDS => [
                        'file' => curl_file_create($file->getRealPath(), $file->getMimeType(), $file->getClientOriginalName()),
                        'upload_preset' => $uploadPreset,
                        'folder' => 'chikondi/' . $key
                    ],
                    CURLOPT_TIMEOUT => 120,
                ]);
                
                $response = curl_exec($curl);
                $error = curl_error($curl);
                curl_close($curl);
                
                if ($error) {
                    \Log::error("Cloudinary upload error for {$key}: " . $error);
                    continue;
                }
                
                $result = json_decode($response, true);
                if (isset($result['secure_url'])) {
                    SiteSetting::set($key, $result['secure_url']);
                }
            }
        }

        return redirect()->route('admin.settings')->with('success', 'Settings updated successfully.');
    }
}