<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthUser;
use App\Http\Requests\RequestAuth;
use App\Http\Requests\Register;
use App\Models\User;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;

class Auth extends BaseController
{
    // admin

    public function show()
    {
        $module = 'Login Admin';
        return view('admin.login.index', compact('module'));
    }

    public function login_kolektor()
    {
        $module = 'Login Kolektor';
        return view('kolektor.login.index', compact('module'));
    }

    public function login_proses_admin(RequestAuth $requestAuth)
    {
        $credential = $requestAuth->getCredentials();
        $user = User::where('username', $requestAuth->username)->first();

        if (!$user || !FacadesAuth::guard('user')->attempt($credential)) {
            return redirect()->route('login.login-admin')
                ->with('failed', 'Username atau Password salah')
                ->withInput($requestAuth->only('username'));
        }

        return $this->authenticated();
    }

    public function login_proses_kolektor(RequestAuth $requestAuth)
    {
        $credential = $requestAuth->getCredentials();
        $user = User::where('username', $requestAuth->username)->first();

        if (!$user || !FacadesAuth::guard('user')->attempt($credential)) {
            return redirect()->route('login.login-kolektor')
                ->with('failed', 'Username atau Password salah')
                ->withInput($requestAuth->only('username'));
        }

        return $this->authenticated();
    }

    public function authenticated()
    {
        if (auth()->guard('user')->user()->role === 'admin') {
            return redirect()->route('admin.dashboard-admin');
        } elseif (auth()->guard('user')->user()->role === 'kolektor') {
            return redirect()->route('kolektor.dashboard-kolektor');
        }
    }

    public function logout()
    {
        auth()->guard('user')->logout();
        return redirect()->route('login.login-admin')->with('success', 'Berhasil Logout');
    }

    // warga

    public function user()
    {
        $module = 'Login User';
        return view('user.login.index', compact('module'));
    }

    public function login_proses_user(AuthUser $authUser)
    {
        // Ambil input restribusi
        $resrtribusi = $authUser->input('resrtribusi');

        // Cari warga berdasarkan resrtribusi
        $warga = Warga::where('resrtribusi', $resrtribusi)->first();

        // Validasi apakah warga ditemukan
        if (!$warga) {
            return redirect()->route('login.login-user')
                ->with('failed', 'No restribusi salah')
                ->withInput($authUser->only('resrtribusi'));
        }

        // Login manual
        auth()->guard('warga')->login($warga);

        // Redirect ke dashboard
        return redirect()->route('user.dashboard-user');
    }


    public function logout_user()
    {
        auth()->guard('warga')->logout();
        return redirect()->route('login.login-user')->with('success', 'Berhasil Logout');
    }

    public function logout_kolektor()
    {
        auth()->guard('user')->logout();
        return redirect()->route('login.login-kolektor')->with('success', 'Berhasil Logout');
    }
}
