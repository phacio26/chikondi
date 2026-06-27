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
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact/send', [PageController::class, 'contactSend'])->name('contact.send');
Route::get('/progress', [PageController::class, 'progress'])->name('progress');

/*
|--------------------------------------------------------------------------
| TEMP: Database check route - REMOVE AFTER USE
|--------------------------------------------------------------------------
*/
Route::get('/check-db-temp-xyz123', function () {
    return response()->json([
        'connection' => config('database.default'),
        'host' => config('database.connections.pgsql.host'),
        'database' => config('database.connections.pgsql.database'),
        'tables' => \Illuminate\Support\Facades\Schema::getTableListing(),
    ]);
});

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

    // Contact Messages
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');
    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');
});