<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWargaRequest;
use App\Http\Requests\UpdateWargaRequest;
use App\Imports\WargaImport;
use App\Models\Tagihan;
use App\Models\Transaksi;
use App\Models\Warga;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class WargaController extends BaseController
{
    public function index()
    {
        $module = 'Warga';
        $warga = Warga::all();
        return view('admin.warga.index', compact('module', 'warga'));
    }

    public function add(StoreWargaRequest $storeWargaRequest)
    {
        $data = array();
        $tarif = str_replace(['Rp', '.', ' '], '', $storeWargaRequest->tarif); // Hapus format titik

        $newFoto = '';
        if ($storeWargaRequest->file('foto')) {
            $extension = $storeWargaRequest->file('foto')->extension();
            $newFoto = $storeWargaRequest->nama . '-' . now()->timestamp . '.' . $extension;
            $storeWargaRequest->file('foto')->storeAs('warga', $newFoto);
        }

        try {
            // Generate unique resrtribusi
            do {
                $uniqueResrtribusi = strtoupper(Str::random(6));
                // Filter hanya untuk alphanumeric
                $uniqueResrtribusi = preg_replace('/[^A-Z0-9]/', '', $uniqueResrtribusi);
            } while (Warga::where('resrtribusi', $uniqueResrtribusi)->exists());

            $data = new Warga();
            $data->resrtribusi = $uniqueResrtribusi;
            $data->nama = $storeWargaRequest->nama;
            $data->nprw = $storeWargaRequest->nprw;
            $data->alamat = $storeWargaRequest->alamat;
            $data->rt = $storeWargaRequest->rt;
            $data->rw = $storeWargaRequest->rw;
            $data->kelurahan = $storeWargaRequest->kelurahan;
            $data->jenis_sampah = $storeWargaRequest->jenis_sampah;
            $data->sub_kategori = $storeWargaRequest->sub_kategori;
            $data->volume = $storeWargaRequest->volume;
            $data->tarif = $tarif;
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

        Excel::import(new WargaImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data berhasil diimpor!');
    }

    public function detail($params)
    {
        $module = 'Detail Warga';
        $warga = Warga::where('uuid', $params)->first();
        $tagihan = Tagihan::where('uuid_warga', $warga->uuid)->get();
        $tagihan->map(function ($item) use ($warga) {
            $item->nama = $warga->nama;
            $item->nprw = $warga->nprw;
            $item->volume = $warga->volume;
            $item->tarif = $warga->tarif;

            return $item;
        });

        // Ambil semua transaksi
        $transaksi = Transaksi::all();

        // Map setiap transaksi
        $transaksi->map(function ($item) {
            // Ambil data warga berdasarkan UUID
            $warga = Warga::where('uuid', $item->uuid_warga)->first();

            // Ambil data tagihan berdasarkan UUID tagihan (pastikan ini array atau koleksi)
            $uuidTagihan = is_array($item->uuid_tagihan) ? $item->uuid_tagihan : [$item->uuid_tagihan];
            $tagihan = Tagihan::whereIn('uuid', $uuidTagihan)->get();

            // Ambil bulan tagihan dari setiap tagihan
            $bulan_tagihan = $tagihan->pluck('tanggal_tagihan')->toArray();

            // Ambil salah satu status (misalnya status dari tagihan pertama)
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
        return view('admin.detailwarga.index', compact('warga', 'module', 'tagihan', 'transaksi'));
    }

    public function edit(StoreWargaRequest $storeWargaRequest, $params)
    {
        $data = Warga::where('uuid', $params)->first();
        $oldFilePath = public_path('warga/' . $data->foto);
        $tarif = str_replace(['Rp', '.', ' '], '', $storeWargaRequest->tarif); // Hapus format titik

        $newFoto = '';
        if ($storeWargaRequest->file('foto')) {
            $extension = $storeWargaRequest->file('foto')->extension();
            $newFoto = $storeWargaRequest->nama . '-' . now()->timestamp . '.' . $extension;
            $storeWargaRequest->file('foto')->storeAs('warga', $newFoto);

            // Hapus foto lama jika ada
            if (File::exists($oldFilePath)) {
                File::delete($oldFilePath);
            }
        }

        try {
            $data->resrtribusi = $data->resrtribusi;
            $data->nama = $storeWargaRequest->nama;
            $data->nprw = $storeWargaRequest->nprw;
            $data->alamat = $storeWargaRequest->alamat;
            $data->rt = $storeWargaRequest->rt;
            $data->rw = $storeWargaRequest->rw;
            $data->kelurahan = $storeWargaRequest->kelurahan;
            $data->jenis_sampah = $storeWargaRequest->jenis_sampah;
            $data->sub_kategori = $storeWargaRequest->sub_kategori;
            $data->volume = $storeWargaRequest->volume;
            $data->tarif = $tarif;
            $data->foto = $storeWargaRequest->file('foto') ? $newFoto : $data->foto;
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
            $data = Warga::where('uuid', $params)->first();
            $oldFilePath = public_path('warga/' . $data->foto);
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

    // kolektor
    public function warga_kolektor()
    {
        $module = 'Daftar Warga';

        // Ambil semua warga berdasarkan kelurahan yang ada di auth
        $warga = Warga::where('kelurahan', auth()->guard('user')->user()->kelurahan)->get();

        // Untuk setiap warga, ambil jumlah tagihan dengan status tertentu
        $wargaWithTagihanStatus = $warga->map(function ($w) {
            // Ambil tagihan berdasarkan uuid_warga
            $tagihan = Tagihan::where('uuid_warga', $w->uuid)->get();

            // Hitung status tagihan untuk warga ini
            $lunas = $tagihan->where('status', 'Lunas');
            $belumLunas = $tagihan->where('status', 'Belum Lunas');
            $proses = $tagihan->where('status', 'Proses');

            // Hitung total tarif dari warga untuk setiap status tagihan
            $totalLunas = $lunas->count() * $w->tarif; // Jumlah tarif untuk status 'Lunas'
            $totalBelumLunas = ($belumLunas->count() * $w->tarif) + ($proses->count() * $w->tarif); // Jumlah tarif untuk status 'Belum Lunas'

            // Menambahkan total tarif untuk masing-masing status tagihan
            $w->total_lunas = $totalLunas;
            $w->total_belum_lunas = $totalBelumLunas;

            return $w;
        });

        // Mengirim data ke view
        return view('kolektor.warga.index', compact('module', 'wargaWithTagihanStatus'));
    }

    public function pembayaran_warga_kolektor($params)
    {
        $warga = Warga::where('uuid', $params)->where('kelurahan', auth()->guard('user')->user()->kelurahan)->first();
        $wargaTagihan = Tagihan::where('uuid_warga', $warga->uuid)->where('status', 'Lunas')->get();
        $wargaTagihan->map(function ($item) use ($warga) {
            $item->total_pembayaran = $warga->tarif;
            return $item;
        });

        // Hitung total pembayaran untuk semua tagihan
        $totalPembayaran = $wargaTagihan->sum('total_pembayaran');
        $tagihan = Tagihan::where('uuid_warga', $warga->uuid)->where('status', 'Belum Lunas')->get()
            ->sortBy(function ($item) {
                // Mengubah tanggal ke objek Carbon untuk sorting
                return Carbon::createFromFormat('Y m d', $item->tanggal_tagihan);
            });

        // Cek jika $tagihan adalah koleksi dan kosong
        $module = $tagihan->isEmpty() ? 'Detail Tagihan' : 'Bayar Tagihan';

        return view('kolektor.pembayaran.index', compact('module', 'warga', 'tagihan', 'wargaTagihan', 'totalPembayaran'));
    }
}
