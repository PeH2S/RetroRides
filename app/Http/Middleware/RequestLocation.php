<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequestLocation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $excludedRoutes = [
            'login',
            'register',
            'logout',
        ];

        if (
            in_array($request->route()?->getName(), $excludedRoutes) ||
            $request->isMethod('post') ||
            $request->is('api/*')
        ) {
            return $next($request);
        }

        if ($request->is('/') && (!$request->hasSession() || !$request->session()->has('user_location'))) {
            return redirect('/'); 
        }

        return $next($request);
    }


}
