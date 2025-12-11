<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Setting;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        // Safe settings read
        $settings = Schema::hasTable('settings') ? (Setting::asArray() ?? []) : [];

        // Stats
        $total     = Project::count();
        $published = Project::where('is_published', true)->count();
        $drafts    = $total - $published;

        // Projects (same as your current dashboard)
        $projects = Project::latest()->paginate(10);

        return view('admin.dashboard', compact('settings', 'total', 'published', 'drafts', 'projects'));
    }
}
