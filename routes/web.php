<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Matches\Show as MatchShow;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Users as UsersManagement;
use App\Livewire\Admin\Venues\Venues as Venues;
use App\Livewire\Admin\Venues\Show as VenueShow;
use App\Livewire\Admin\Tournaments\Index as TournamentIndex;
use App\Livewire\Admin\Tournaments\Show as TournamentShow;
use App\Livewire\Admin\Tournaments\Matches as TournamentMatches;
use App\Livewire\Umpire\Dashboard as UmpireDashboard;
use App\Livewire\Umpire\Matches\Matches as UmpireMatches;
use App\Livewire\Umpire\Matches\Show as UmpireMatchShow;
use App\Livewire\Player\Dashboard as PlayerDashboard;
use App\Livewire\Player\Matches as PlayerMatches;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\CheckAdminVerification;
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
    Route::get('/users', UsersManagement::class)->name('users');
    Route::get('/venues', Venues::class)->name('venues');
    Route::get('/venues/{venue}', VenueShow::class)->name('venues.show');
    Route::get('/tournaments', TournamentIndex::class)->name('tournaments');
    Route::get('/tournaments/{tournament}', TournamentShow::class)->name('tournaments.show');
});

// Umpire Routes
Route::middleware(['auth', CheckRole::class.':umpire'])->prefix('umpire')->name('umpire.')->group(function () {
    // Dashboard accessible without verification
    Route::get('/dashboard', UmpireDashboard::class)->name('dashboard');
    
    // Other routes require verification
    Route::middleware([CheckAdminVerification::class])->group(function () {
        Route::get('/matches', UmpireMatches::class)->name('matches');
        Route::get('/matches/{match}', UmpireMatchShow::class)->name('matches.show');
    });
});

// Player Routes
Route::middleware(['auth', CheckRole::class.':player'])->prefix('player')->name('player.')->group(function () {
    // Dashboard accessible without verification
    Route::get('/dashboard', PlayerDashboard::class)->name('dashboard');
    
    // Other routes require verification
    Route::middleware([CheckAdminVerification::class])->group(function () {
        Route::get('/matches', PlayerMatches::class)->name('matches');
        Route::get('/matches/{match}', MatchShow::class)->name('matches.show');
    });
});

// Settings routes (require verification except for admin)
Route::middleware(['auth'])->prefix('settings')->name('settings.')->group(function () {
    Route::get('/profile', Profile::class)->name('profile')->middleware([CheckAdminVerification::class]);
    Route::get('/password', Password::class)->name('password')->middleware([CheckAdminVerification::class]);
    Route::get('/appearance', Appearance::class)->name('appearance')->middleware([CheckAdminVerification::class]);
});

Route::get('/dashboard', function () {
    $user = Auth::user();
    
    return match ($user->role_id) {
        'admin' => redirect()->route('admin.dashboard'),
        'umpire' => redirect()->route('umpire.dashboard'),
        'player' => redirect()->route('player.dashboard'),
        default => redirect()->route('player.dashboard'),
    };
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
