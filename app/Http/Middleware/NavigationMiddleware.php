<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class NavigationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $cacheKey = 'categories.all';
        $cacheDuration = 60; // Cache for 60 minutes

        $categories = Cache::remember($cacheKey, $cacheDuration, function () {
            return Category::all();
        });

        // Share the categories with all Inertia responses
        Inertia::share('cachedCategories', $categories);

        return $next($request);
    }
}
