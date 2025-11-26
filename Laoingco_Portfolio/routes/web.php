<?php

use App\Http\Controllers\AuthController;
use App\Models\Project;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
// use Illuminate\Support\Collection;

//defaultttttt
// Route::get('/', function () {
//     return view('landing');
// });

// Route::get('/', function () {
//     // For now, just send an empty collection so the view has $projects
//     $projects = collect(); // same as new Collection([])

//     return view('landing', compact('projects'));
// });
Route::get('/', function () {
    // Get all published projects from the database
    $projects = Project::where('is_published', true)
        ->latest('published_at')
        ->get();

    // Pass them to the landing page view
    return view('landing', compact('projects'));
});

Route::get('register', [AuthController::class, 'showRegister'])->name('register.form');
Route::post('register', [AuthController::class, 'register'])->name('register');

Route::get('login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('login', [AuthController::class, 'login'])->name('login');

//ALDWIN MA PREND
// Route::get('dashboard',function() {
//     return view('dashboard');
// })->middleware('auth')->name('dashboard');
Route::get('dashboard', function () {
    $projects = Project::latest()->paginate(10);

    return view('dashboard', compact('projects'));
})->middleware('auth')->name('dashboard');


//updateeeeee---
//ADMIN GROUP
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // When you go to /admin, send to projects list (or your dashboard if you prefer)
    Route::get('/', function () {
        return redirect()->route('admin.projects.index');
    })->name('dashboard');

    // All CRUD routes for projects
    Route::resource('projects', AdminProjectController::class);
});

