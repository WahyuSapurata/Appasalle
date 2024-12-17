<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMenuUmkmRequest;
use App\Http\Requests\UpdateMenuUmkmRequest;
use App\Models\MenuUmkm;
use Illuminate\Support\Facades\File;

class MenuUmkmController extends BaseController
{
    public function add(StoreMenuUmkmRequest $storeMenuUmkmRequest)
    {
        $harga = str_replace(['Rp', '.', ' '], '', $storeMenuUmkmRequest->harga); // Hapus format titik
        $data = array();

        $newFoto = '';
        if ($storeMenuUmkmRequest->file('foto')) {
            $extension = $storeMenuUmkmRequest->file('foto')->extension();
            $newFoto = $storeMenuUmkmRequest->menu . '-' . now()->timestamp . '.' . $extension;
            $storeMenuUmkmRequest->file('foto')->storeAs('menu', $newFoto);
        }

        try {
            $data = new MenuUmkm();
            $data->uuid_umkm = $storeMenuUmkmRequest->uuid_umkm;
            $data->menu = $storeMenuUmkmRequest->menu;
            $data->harga = $harga;
            $data->foto = $newFoto;
            $data->save();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Added data success');
    }

    public function get($params)
    {
        $data = MenuUmkm::where('uuid_umkm', $params)->get();
        return $this->sendResponse($data, 'Get data success');
    }

    public function delete($params)
    {
        $data = array();
        try {
            $data = MenuUmkm::where('uuid', $params)->first();
            $oldFilePath = public_path('menu/' . $data->foto);
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
