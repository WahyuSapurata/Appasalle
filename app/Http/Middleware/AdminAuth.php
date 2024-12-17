<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('user')->check()) {
            return $next($request);
        }

        return redirect()->route('login.login-admin');
    }
}
