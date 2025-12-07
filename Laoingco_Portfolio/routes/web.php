<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\Project;
use App\Models\Setting;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\SettingsController;


/*
|--------------------------------------------------------------------------
| Landing Page
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    // Published projects for homepage
    $projects = Project::where('is_published', true)
        ->latest('published_at')
        ->get();

    // Site settings (safe even if table empty)
    $settings = class_exists(Setting::class)
        ? (Setting::asArray() ?? [])
        : [];

    return view('landing', compact('projects', 'settings'));
});


/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/

Route::get('register', [AuthController::class, 'showRegister'])->name('register.form');
Route::post('register', [AuthController::class, 'register'])->name('register');

Route::get('login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('login', [AuthController::class, 'login'])->name('login');


/*
|--------------------------------------------------------------------------
| User Dashboard (non-admin)
|--------------------------------------------------------------------------
*/

Route::get('dashboard', function () {
    $projects = Project::latest()->paginate(10);
    return view('dashboard', compact('projects'));
})->middleware('auth')->name('dashboard');



/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Unified Admin Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Projects CRUD
    Route::resource('projects', AdminProjectController::class);

    // Settings Page
    Route::get('settings', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::post('settings', [SettingsController::class, 'update'])->name('settings.update');
});
