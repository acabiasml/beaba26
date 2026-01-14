<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Se não estiver autenticado, deixa o auth middleware cuidar
        if (! auth()->check()) {
            return $next($request);
        }

        // Se estiver autenticado, mas arquivado
        if (auth()->user()->archived) {
            abort(403, 'Usuário desativado.');
        }

        return $next($request);
    }

}
