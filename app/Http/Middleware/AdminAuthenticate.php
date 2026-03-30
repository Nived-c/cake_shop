<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     * Redirect to admin login if not authenticated.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login')
                ->with('error', 'Please log in to access the admin dashboard.');
        }

        return $next($request);
    }
}
