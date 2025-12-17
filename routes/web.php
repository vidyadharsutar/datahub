<?php

use App\Http\Controllers\CompleteData\CompleteDataController;
use App\Http\Controllers\Logs\UserLogsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Settings\SettingsController;
use App\Http\Controllers\Users\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/dashboard/users', [UsersController::class,'index'])->name('users.index');
Route::post('/dashboard/users/store', [UsersController::class,'store'])->name('users.store');

Route::get('/dashboard/logs', [UserLogsController::class,'index'])->name('logs.index');
Route::get('/dashboard/settings', [SettingsController::class,'index'])->name('settings.index');

Route::post('/dashboard/profile/settings', [SettingsController::class,'profileSetting'])->name('profile.settings');
Route::post('/dashboard/profile/security', [SettingsController::class,'profileSecurity'])->name('profile.security');

Route::get('/dashboard/complete-data', [CompleteDataController::class,'index'])->name('complete.data.index');
Route::post('/dashboard/complete-data', [CompleteDataController::class,'store'])->name('complete.data.store');

