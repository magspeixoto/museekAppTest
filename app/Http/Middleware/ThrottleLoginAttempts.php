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
        $maxAttempts = 5; // Número máximo de tentativas permitidas
        $decayMinutes = 1; // Tempo em minutos para desbloquear o IP após exceder as tentativas

        // Obter o IP do cliente
        $ip = $request->ip();

        // Verificar se o IP está bloqueado
        if ($this->limiter->tooManyAttempts($this->getLoginAttemptsKey($ip), $maxAttempts)) {
            return response()->json(['message' => 'Tentativas de login excedidas. Tente novamente mais tarde.'], 429);
        }

        // Se não estiver bloqueado, executar a próxima etapa do pipeline
        $response = $next($request);

        // Se o login falhar, registrar a tentativa
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
