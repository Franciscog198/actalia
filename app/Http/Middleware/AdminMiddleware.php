<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Por ahora, permitir acceso sin autenticación para pruebas
        // Luego puedes agregar: if (!auth()->check() || !auth()->user()->is_admin)
        
        return $next($request);
    }
}