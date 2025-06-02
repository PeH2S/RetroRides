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

        dd($request->session()->all());
        $excludedRoutes = [
            'login',
            'register',
            'logout'
        ];

        //if (in_array($request->route()?->getName(), $excludedRoutes) || $request->isMethod('post')) {
            //return $next($request);
        //}

        $routeName = $request->route()?->getName();
        if (($routeName && in_array($routeName, $excludedRoutes)) || $request->isMethod('post')) {
            return $next($request);
        }

        if ($request->hasSession() && $request->session()->has('user_location') || $request->is('api/*')) {
            return $next($request);
        }

        return redirect('/');
    }

}
