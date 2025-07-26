<?php

use App\Livewire\Dashboard;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');



//Route::get('dashboard', [DashboardController::class, 'index'])
//    ->middleware(['auth', 'verified'])
//    ->name('dashboard');

Route::get('/dashboard', Dashboard::class)->name('dashboard');
Route::get('/patients', \App\Livewire\Patients\Patients::class);
Route::get('/visits', \App\Livewire\Visits\Add::class);

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Volt::route('iam/roles', 'iam.roles')->name('roles');
    Volt::route('iam/users', 'iam.users')->name('users');
});

require __DIR__.'/auth.php';
