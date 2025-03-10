<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Umpire\Dashboard as UmpireDashboard;
use App\Livewire\Player\Dashboard as PlayerDashboard;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    $user = Auth::user();
    
    return match ($user->role_id) {
        'admin' => redirect()->route('admin.dashboard'),
        'umvire' => redirect()->route('umpire.dashboard'),
        'player' => redirect()->route('player.dashboard'),
        default => redirect()->route('player.dashboard'),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

// Admin Routes
Route::middleware(['auth', CheckRole::class.':admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
});

// Umpire Routes
Route::middleware(['auth', CheckRole::class.':umpire'])->prefix('umpire')->name('umpire.')->group(function () {
    Route::get('/dashboard', UmpireDashboard::class)->name('dashboard');
});

// Player Routes
Route::middleware(['auth', CheckRole::class.':player'])->prefix('player')->name('player.')->group(function () {
    Route::get('/dashboard', PlayerDashboard::class)->name('dashboard');
});


require __DIR__.'/auth.php';
