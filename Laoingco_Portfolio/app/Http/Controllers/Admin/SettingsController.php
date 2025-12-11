<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function edit()
    {
        // Safe read even if table is empty
        $settings = Schema::hasTable('settings') ? (Setting::asArray() ?? []) : [];
        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name'          => ['nullable','string','max:100'],
            'headline'      => ['nullable','string','max:160'],
            'email'         => ['nullable','email','max:255'],
            'github_url'    => ['nullable','url','max:255'],
            'linkedin_url'  => ['nullable','url','max:255'],
            'profile_image' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:4096'],
        ]);

        // Save text fields
        foreach (['name','headline','email','github_url','linkedin_url'] as $key) {
            if ($request->filled($key)) {
                Setting::set($key, $data[$key]);
            } elseif ($request->has($key) && $data[$key] === null) {
                // allow clearing a field
                Setting::set($key, null);
            }
        }

        // Handle image upload
        if ($request->hasFile('profile_image')) {
            $old = Setting::get('profile_image');
            if ($old) {
                Storage::disk('public')->delete($old);
            }
            $path = $request->file('profile_image')->store('site', 'public'); // e.g. storage/app/public/site/...
            Setting::set('profile_image', $path);
        }

        return back()->with('success', 'Settings updated.');
    }
}
