<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class WargaAuth
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('warga')->check()) {
            return $next($request);
        }

        return redirect()->route('login.login-user');
    }
}
