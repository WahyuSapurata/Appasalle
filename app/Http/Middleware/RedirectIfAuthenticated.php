<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? ['warga', 'user'] : $guards; // Tentukan default guards yang sesuai

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if ($guard === 'user') {
                    if (Auth::guard('user')->user()->role == 'admin') {
                        return redirect()->route('admin.dashboard-admin');
                    } elseif (Auth::guard('user')->user()->role == 'kolektor') {
                        return redirect()->route('kolektor.dashboard-kolektor');
                    } elseif (Auth::guard('user')->user()->role == 'monitoring') {
                        return redirect()->route('monitoring.dashboard-monitoring');
                    }
                } elseif ($guard === 'warga') {
                    return redirect()->route('user.dashboard-user');
                }
            }
        }

        return $next($request);
    }
}
