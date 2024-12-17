<?php

namespace App\Http\Controllers;

use App\Http\Requests\User as RequestsUser;
use App\Models\Tagihan;
use App\Models\Transaksi;
use App\Models\User as ModelsUser;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class User extends BaseController
{
    public function index()
    {
        $module = 'User';
        $user = ModelsUser::all();
        return view('admin.user.index', compact('module', 'user'));
    }

    public function add(RequestsUser $user)
    {
        $data = array();

        $newFoto = '';
        if ($user->file('foto')) {
            $extension = $user->file('foto')->extension();
            $newFoto = $user->name . '-' . now()->timestamp . '.' . $extension;
            $user->file('foto')->storeAs('user', $newFoto);
        }

        try {
            $data = new ModelsUser();
            $data->name = $user->name;
            $data->username = $user->username;
            $data->password = Hash::make($user->password);
            $data->role = $user->role;
            $data->kelurahan = $user->kelurahan;
            $data->rw = $user->rw;
            $data->rt = $user->rt;
            $data->foto = $newFoto;
            $data->save();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Added data success');
    }

    public function profil($params)
    {
        $module = 'Profil User';
        $user = ModelsUser::where('uuid', $params)->first();

        $transaksi = Transaksi::all()->filter(function ($item) use ($user) {
            // Ambil data warga berdasarkan UUID
            $warga = Warga::where('uuid', $item->uuid_warga)->first();

            // Filter transaksi berdasarkan kelurahan yang sesuai
            return $warga && $warga->kelurahan === $user->kelurahan;
        });

        // Map setiap transaksi yang telah difilter
        $transaksi = $transaksi->map(function ($item) {
            // Ambil data warga berdasarkan UUID
            $warga = Warga::where('uuid', $item->uuid_warga)->first();

            // Ambil data tagihan berdasarkan UUID tagihan
            $uuidTagihan = is_array($item->uuid_tagihan) ? $item->uuid_tagihan : [$item->uuid_tagihan];
            $tagihan = Tagihan::whereIn('uuid', $uuidTagihan)->get();

            // Ambil bulan tagihan dari data tagihan
            $bulan_tagihan = $tagihan->pluck('tanggal_tagihan')->toArray();

            // Ambil status dari tagihan pertama
            $status = $tagihan->first()?->status;

            // Tambahkan properti dari warga dan tagihan ke item transaksi
            $item->nama = $warga->nama ?? null;
            $item->nprw = $warga->nprw ?? null;
            $item->jenis_sampah = $warga->jenis_sampah ?? null;
            $item->alamat = $warga->alamat ?? null;
            $item->rt = $warga->rt ?? null;
            $item->rw = $warga->rw ?? null;
            $item->tarif = $warga->tarif ?? null;
            $item->kelurahan = $warga->kelurahan ?? null;
            $item->foto_warga = $warga->foto ?? null;
            $item->bulan_tagihan = $bulan_tagihan;
            $item->status = $status;

            return $item;
        });

        return view('admin.profiladmin.index', compact('module', 'user', 'transaksi'));
    }

    public function edit(Request $request, $params)
    {
        $data = ModelsUser::where('uuid', $params)->first();
        $oldFilePath = public_path('user/' . $data->foto);

        $newFoto = '';
        if ($request->file('foto')) {
            $extension = $request->file('foto')->extension();
            $newFoto = $request->name . '-' . now()->timestamp . '.' . $extension;
            $request->file('foto')->storeAs('user', $newFoto);

            // Hapus foto lama jika ada
            if (File::exists($oldFilePath)) {
                File::delete($oldFilePath);
            }
        }

        if ($request->password_lama && Hash::check($request->password_lama, $data->password) == false) {
            return $this->sendError('Invalid input', 'Password lama tidak sesuai', 200);
        }

        try {
            $data->name = $request->name;
            $data->username = $request->username;
            $data->password = $request->password ?  Hash::make($request->password) : $data->password;
            $data->role = $request->role;
            $data->kelurahan = $request->kelurahan;
            $data->rw = $request->rw;
            $data->rt = $request->rt;
            $data->foto = $request->file('foto') ? $newFoto : $data->foto;
            $data->save();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Update data success');
    }

    public function delete($params)
    {
        $data = array();
        try {
            $data = ModelsUser::where('uuid', $params)->first();
            $oldFilePath = public_path('user/' . $data->foto);
            // Hapus foto lama jika ada
            if (File::exists($oldFilePath)) {
                File::delete($oldFilePath);
            }
            $data->delete();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Delete data success');
    }
}
