<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class KolektorAuth
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('user')->check() && Auth::guard('user')->user()->role == 'kolektor') {
            return $next($request);
        }

        // Redirect jika tidak memenuhi syarat
        return redirect()->route('login.login-kolektor');
    }
}
