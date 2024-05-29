<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cache\RateLimiter as CacheRateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class ThrottleLoginAttempts
{
    protected $limiter;

    public function __construct(CacheRateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }

    public function handle(Request $request, Closure $next)
    {
        $maxAttempts = 5; // Max attempts
        $decayMinutes = 1; // Time to unlock the ip address

        // Get client's Ip
        $ip = $request->ip();

        // Check if it's locked
        if ($this->limiter->tooManyAttempts($this->getLoginAttemptsKey($ip), $maxAttempts)) {
            return response()->json(['message' => 'Tentativas de login excedidas. Tente novamente mais tarde.'], 429);
        }

        // If not locked, next step
        $response = $next($request);

        // If it fails, keep the attempt registered
        if ($response->getStatusCode() !== 302) {
            $this->limiter->hit($this->getLoginAttemptsKey($ip), $decayMinutes);
        }

        return $response;
    }

    protected function getLoginAttemptsKey($ip)
    {
        return 'login_attempts:' . $ip;
    }
    
}
