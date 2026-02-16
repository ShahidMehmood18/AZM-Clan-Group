<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function general()
    {
        return view('backend.settings.general');
    }

    public function updateGeneral(Request $request)
    {
        $request->validate([
            'site_logo_light' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'site_logo_dark' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'site_favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120', // Increased max size for hero
            'site_title' => 'required|string|max:255',
            'site_description' => 'nullable|string',
            'site_email' => 'nullable|email',
            'site_phone' => 'nullable|string',
            'site_address' => 'nullable|string',
            'logo_type' => 'nullable|string|in:text,image',
            'logo_text' => 'nullable|string',
        ]);

        $settings = $request->except(['_token', 'site_logo_light', 'site_logo_dark', 'site_favicon', 'logo_image', 'hero_image']);

        // Handle file uploads
        if ($request->hasFile('logo_image')) {
            $path = $request->file('logo_image')->store('settings', 'public');
            \App\Models\Setting::set('logo_image', $path);
        }

        if ($request->hasFile('hero_image')) {
            $path = $request->file('hero_image')->store('settings', 'public');
            \App\Models\Setting::set('hero_image', $path);
        }

        // Handle file uploads
        if ($request->hasFile('site_logo_light')) {
            $path = $request->file('site_logo_light')->store('settings', 'public');
            \App\Models\Setting::set('site_logo_light', $path);
        }

        if ($request->hasFile('site_logo_dark')) {
            $path = $request->file('site_logo_dark')->store('settings', 'public');
            \App\Models\Setting::set('site_logo_dark', $path);
        }

        if ($request->hasFile('site_favicon')) {
            $path = $request->file('site_favicon')->store('settings', 'public');
            \App\Models\Setting::set('site_favicon', $path);
        }

        // Save other settings
        foreach ($settings as $key => $value) {
            \App\Models\Setting::set($key, $value);
        }

        return redirect()->back()->with('success', 'General settings updated successfully.');
    }

    public function seo()
    {
        return view('backend.settings.seo');
    }

    public function updateSeo(Request $request)
    {
        $request->validate([
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $settings = $request->except(['_token', 'og_image']);

        if ($request->hasFile('og_image')) {
            $path = $request->file('og_image')->store('settings', 'public');
            \App\Models\Setting::set('og_image', $path, 'seo');
        }

        foreach ($settings as $key => $value) {
            \App\Models\Setting::set($key, $value, 'seo');
        }

        return redirect()->back()->with('success', 'SEO settings updated successfully.');
    }
}
