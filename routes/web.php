<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ProgressController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/news', [PageController::class, 'news'])->name('news');
Route::get('/donate', [PageController::class, 'donate'])->name('donate');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/our-team', [PageController::class, 'team'])->name('team');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact/send', [PageController::class, 'contactSend'])->name('contact.send');
Route::get('/progress', [PageController::class, 'progress'])->name('progress');

/*
|--------------------------------------------------------------------------
| Admin Auth Routes (no middleware)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| Admin Protected Routes (with middleware)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // News
    Route::resource('news', NewsController::class);

    // Progress (Admin CRUD)
    Route::resource('progress', ProgressController::class);

    // Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');

    // Team Members
    Route::resource('team', \App\Http\Controllers\Admin\TeamController::class);

    // About Us Page
Route::get('/about', [\App\Http\Controllers\Admin\AboutController::class, 'index'])->name('about.index');
Route::post('/about', [\App\Http\Controllers\Admin\AboutController::class, 'update'])->name('about.update');
Route::post('/about/videos', [\App\Http\Controllers\Admin\AboutController::class, 'storeVideo'])->name('about.videos.store');
Route::delete('/about/videos/{video}', [\App\Http\Controllers\Admin\AboutController::class, 'destroyVideo'])->name('about.videos.destroy');

    // Contact Messages
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');
    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');
    Route::post('/contacts/{contact}/read', [ContactController::class, 'markAsRead'])->name('contacts.read');
});