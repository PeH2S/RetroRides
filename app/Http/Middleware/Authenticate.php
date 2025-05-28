<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Onde redirecionar usuários não autenticados.
     */
    protected function redirectTo(Request $request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
