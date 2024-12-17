<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\User;
use App\Models\Warga;
use Illuminate\Http\Request;

class SearchController extends BaseController
{
    public function search(Request $request)
    {
        $searchTerm = $request->input('warga'); // Input query pencarian

        // Query data berdasarkan kategori 'warga'
        $warga = Warga::where('nama', 'LIKE', "%{$searchTerm}%")
            ->orWhere('nprw', 'LIKE', "%{$searchTerm}%")
            ->get(['nama', 'nprw', 'foto', 'uuid'])
            ->map(function ($item) {
                return [
                    'type' => 'warga',
                    'nama' => $item->nama,
                    'detail' => $item->nprw,
                    'foto' => $item->foto,
                    'uuid' => $item->uuid
                ];
            });

        // Query data berdasarkan kategori 'user'
        $user = User::where('name', 'LIKE', "%{$searchTerm}%")
            ->orWhere('role', 'LIKE', "%{$searchTerm}%")
            ->get(['name', 'role', 'foto', 'uuid'])
            ->map(function ($item) {
                return [
                    'type' => 'user',
                    'nama' => $item->name,
                    'detail' => $item->role,
                    'foto' => $item->foto,
                    'uuid' => $item->uuid
                ];
            });

        // Query data berdasarkan kategori 'umkm'
        $umkm = Umkm::where('nama_umkm', 'LIKE', "%{$searchTerm}%")
            ->get(['nama_umkm', 'jenis_umkm', 'foto', 'uuid'])
            ->map(function ($item) {
                return [
                    'type' => 'umkm',
                    'nama' => $item->nama_umkm,
                    'detail' => $item->jenis_umkm,
                    'foto' => $item->foto,
                    'uuid' => $item->uuid
                ];
            });

        // Gabungkan semua hasil
        $results = $warga->concat($user)->concat($umkm);

        return response()->json($results); // Mengembalikan hasil pencarian dalam bentuk JSON
    }
}
