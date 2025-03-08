<?php

declare(strict_types=1);

use App\Http\Controllers\ManageUsersController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password')->middleware('password.confirm');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::middleware(['password.confirm', 'can:admin'])->group(function () {
    Route::get('/mange-users', [ManageUsersController::class, 'index'])->name('manage-users');
});

require __DIR__.'/auth.php';
