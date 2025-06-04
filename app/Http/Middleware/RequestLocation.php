<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequestLocation
{
    public function handle(Request $request, Closure $next)
    {
        $excludedRoutes = [
            'login', 'register', 'logout', 'search.cars'
        ];

        if (
            in_array($request->route()?->getName(), $excludedRoutes) ||
            $request->isMethod('post') ||
            $request->is('api/*')
        ) {
            return $next($request);
        }

        if ($request->is('/') && (!$request->hasSession() || !$request->session()->has('user_location'))) {
            return $next($request); 
        }

        return $next($request);
    }
}

