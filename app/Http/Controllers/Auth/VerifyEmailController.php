<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $this->redirectToDashboard($request->user(), '?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return $this->redirectToDashboard($request->user(), '?verified=1');
    }

    // Redirect to dashboard
    private function redirectToDashboard($user, $query = ''): RedirectResponse
    {
        $dashboardRoute = match ($user->role) {
            'admin' => 'admin.dashboard',
            'umpire' => 'umpire.dashboard',
            'player' => 'player.dashboard',
            default => 'player.dashboard',
        };

        return redirect()->intended(route($dashboardRoute, absolute: false) . $query);
    }
}
