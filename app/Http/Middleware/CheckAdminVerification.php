<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdminVerification
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user()) {
            return redirect()->route('login');
        }
        
        $user = $request->user();
        
        // Allow admin users to pass through
        if ($user->role_id === 'admin') {
            return $next($request);
        }

        // Allow access to dashboard even if not verified
        if ($request->routeIs('*.dashboard')) {
            return $next($request);
        }

        // Check if user is verified by admin
        if (!$user->admin_verified_at) {
            return redirect()->route($user->role_id . '.dashboard');
        }

        return $next($request);
    }
}
