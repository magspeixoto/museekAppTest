<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$permissions)
    {        
        // Verifies if the user has logged in
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirects to login if not authenticated
        }

        // Checks if the user has permission
        foreach ($permissions as $permission) {
            if (!Auth::user()->hasPermissionTo($permission)) {
                abort(403); // Return forbidden if the user has no permission
            }
        }

        return $next($request);
    }
}
