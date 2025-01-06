<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUmkmRequest;
use App\Http\Requests\UpdateUmkmRequest;
use App\Imports\UmkmImport;
use App\Models\MenuUmkm;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class UmkmController extends BaseController
{
    // admin
    public function index()
    {
        $module = 'UMKM';
        $umkm = Umkm::all();
        return view('admin.umkm.index', compact('module', 'umkm'));
    }

    public function add(StoreUmkmRequest $StoreUmkmRequest)
    {
        $data = array();

        $newFoto = '';
        if ($StoreUmkmRequest->file('foto')) {
            $extension = $StoreUmkmRequest->file('foto')->extension();
            $newFoto = $StoreUmkmRequest->nama_umkm . '-' . now()->timestamp . '.' . $extension;
            $StoreUmkmRequest->file('foto')->storeAs('umkm', $newFoto);
        }

        try {
            $data = new Umkm();
            $data->nama_umkm = $StoreUmkmRequest->nama_umkm;
            $data->alamat = $StoreUmkmRequest->alamat;
            $data->rt = $StoreUmkmRequest->rt;
            $data->rw = $StoreUmkmRequest->rw;
            $data->kelurahan = $StoreUmkmRequest->kelurahan;
            $data->jenis_umkm = $StoreUmkmRequest->jenis_umkm;
            $data->telepon = $StoreUmkmRequest->telepon;
            $data->sosial_media = $StoreUmkmRequest->sosial_media;
            $data->foto = $newFoto;
            $data->save();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Added data success');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new UmkmImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data berhasil diimpor!');
    }

    public function detail($params)
    {
        $data = Umkm::where('uuid', $params)->first();
        return $this->sendResponse($data, 'Get data success');
    }

    public function edit(StoreUmkmRequest $StoreUmkmRequest, $params)
    {
        $data = Umkm::where('uuid', $params)->first();
        $oldFilePath = public_path('umkm/' . $data->foto);

        $newFoto = '';
        if ($StoreUmkmRequest->file('foto')) {
            $extension = $StoreUmkmRequest->file('foto')->extension();
            $newFoto = $StoreUmkmRequest->nama_umkm . '-' . now()->timestamp . '.' . $extension;
            $StoreUmkmRequest->file('foto')->storeAs('umkm', $newFoto);

            // Hapus foto lama jika ada
            if (File::exists($oldFilePath)) {
                File::delete($oldFilePath);
            }
        }

        try {
            $data->nama_umkm = $StoreUmkmRequest->nama_umkm;
            $data->alamat = $StoreUmkmRequest->alamat;
            $data->rt = $StoreUmkmRequest->rt;
            $data->rw = $StoreUmkmRequest->rw;
            $data->kelurahan = $StoreUmkmRequest->kelurahan;
            $data->jenis_umkm = $StoreUmkmRequest->jenis_umkm;
            $data->telepon = $StoreUmkmRequest->telepon;
            $data->sosial_media = $StoreUmkmRequest->sosial_media;
            $data->foto = $StoreUmkmRequest->file('foto') ? $newFoto : $data->foto;
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
            $data = Umkm::where('uuid', $params)->first();
            $oldFilePath = public_path('umkm/' . $data->foto);
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

    // warga
    public function umkm_warga()
    {
        $module = 'UMKM';
        $umkm = Umkm::all();
        return view('user.umkm.index', compact('module', 'umkm'));
    }

    public function detail_umkm_user($params)
    {
        $umkm = Umkm::where('uuid', $params)->first();
        $module = 'Detail Umkm' . $umkm->nama_umkm;
        $product = MenuUmkm::where('uuid_umkm', $umkm->uuid)->get();
        return view('user.detailumkm.index', compact('module', 'umkm', 'product'));
    }
}
