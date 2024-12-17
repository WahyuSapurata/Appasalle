<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilUser extends BaseController
{
    public function index()
    {
        $module = 'Profil Warga';
        return view('user.profil.index', compact('module'));
    }

    public function ptofil_kolektor()
    {
        $module = 'Profil Kolektor';
        return view('kolektor.profil.index', compact('module'));
    }
}
