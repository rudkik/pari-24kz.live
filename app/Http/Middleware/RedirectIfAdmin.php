<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAdmin
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role_id == 1) { // Предполагается, что роль администратора имеет id 1
            return redirect('/private');
        }

        return $next($request);
    }
}
