<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all()->pluck('value', 'key');
        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'phone_number'          => 'nullable|string|max:20',
            'email'                 => 'nullable|email|max:100',
            'bank_name'             => 'nullable|string|max:100',
            'account_name'          => 'nullable|string|max:100',
            'account_number'        => 'nullable|string|max:50',
            'branch'                => 'nullable|string|max:100',
            'bank_details'          => 'nullable|string|max:255',
            'news_coming_soon_text' => 'nullable|string|max:500',
            'logo'                  => 'nullable|image|max:2048',
            'hero_image'            => 'nullable|image|max:20480',
            'mother_child_image'    => 'nullable|image|max:20480',
        ]);

        // Handle text settings
        $textSettings = [
            'phone_number',
            'email',
            'bank_name',
            'account_name',
            'account_number',
            'branch',
            'bank_details',
            'news_coming_soon_text',
        ];

        foreach ($textSettings as $key) {
            if ($request->has($key)) {
                SiteSetting::set($key, $request->input($key));
            }
        }

        // Handle image uploads
        $imageSettings = ['logo', 'hero_image', 'mother_child_image'];

        foreach ($imageSettings as $key) {
            if ($request->hasFile($key)) {
                $existing = SiteSetting::get($key);
                if ($existing) {
                    Storage::disk('public')->delete($existing);
                }
                $path = $request->file($key)->store($key, 'public');
                SiteSetting::set($key, $path);
            }
        }

        return redirect()->route('admin.settings')->with('success', 'Settings updated successfully.');
    }
}