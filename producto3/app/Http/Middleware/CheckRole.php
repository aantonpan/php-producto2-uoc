<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = session('usuario');

        if (!$user || !in_array($user['tipo'], $roles)) {
            return redirect()->route('home')->with('error', 'No tienes permiso para acceder.');
        }

        return $next($request);
    }
}

