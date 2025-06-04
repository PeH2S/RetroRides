<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Aqui consideramos “admin” quem tiver ID == 1
        if (! $user || $user->id !== 1) {
            abort(403, 'Acesso negado.');
        }

        return $next($request);
    }
}
