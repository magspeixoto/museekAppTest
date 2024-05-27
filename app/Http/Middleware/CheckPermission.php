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
        // Verifica se o usuário está autenticado
        if (!Auth::check()) {
            return redirect()->route('login'); // Redireciona para a página de login se não estiver autenticado
        }

        // Verifica se o usuário possui a permissão necessária
        foreach ($permissions as $permission) {
            if (!Auth::user()->hasPermissionTo($permission)) {
                abort(403); // Retorna um erro 403 (Proibido) se o usuário não tiver permissão
            }
        }

        return $next($request);
    }
}
