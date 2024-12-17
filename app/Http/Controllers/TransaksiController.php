<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;
use App\Models\Tagihan;
use App\Models\Transaksi;
use App\Models\Warga;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class TransaksiController extends BaseController
{
    // admin
    public function index()
    {
        $module = 'Transaksi';

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

        return view('admin.transaksi.index', compact('module', 'transaksi'));
    }

    public function update_transaksi(Request $request, $params)
    {
        $data = Transaksi::where('uuid', $params)->first();

        // Pastikan uuid_tagihan berupa array
        $uuidTagihan = $data->uuid_tagihan;

        // Ambil data tagihan berdasarkan UUID
        $tagihan = Tagihan::whereIn('uuid', $uuidTagihan)->get();

        try {
            if ($request->status == 'Gagal') {
                $oldFilePath = public_path('bukti/' . $data->foto);
                // Hapus foto lama jika ada
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }
                $data->foto = null;
                $data->save();
            }

            // Update status tagihan
            $tagihan->each(function ($item) use ($request) {
                $item->status = $request->status;
                $item->save();
            });
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Update data success');
    }


    // warga
    public function proses_transaksi(Request $request)
    {
        $data = array();

        try {
            $data = new Transaksi();
            $data->uuid_warga = auth()->guard('warga')->user()->uuid;
            $data->uuid_tagihan = $request->input('uuid_tagihan');
            $data->terbayarkan = $request->terbayarkan;

            // Generate nomor transaksi unik
            do {
                $noTransaksi = now()->format('Ymd') . mt_rand(100000, 999999); // Format: YYYYMMDD + 6 angka random
            } while (Transaksi::where('no_transaksi', $noTransaksi)->exists());

            $data->no_transaksi = $noTransaksi;
            $data->save();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }

        return $this->sendResponse($data, 'Added data success');
    }

    public function qris_transaksi($params)
    {
        $module = 'Scan QRIS';
        $transaksi = Transaksi::where('uuid', $params)->first();
        return view('user.qris.index', compact('module', 'transaksi'));
    }

    public function bukti_transaksi($params)
    {
        $module = 'Bukti Transaksi';

        // Ambil transaksi berdasarkan UUID
        $transaksi = Transaksi::where('uuid', $params)->first();

        // Pastikan uuid_tagihan berupa array
        $uuidTagihan = $transaksi->uuid_tagihan;

        // Ambil data tagihan berdasarkan UUID
        $tagihan = Tagihan::whereIn('uuid', $uuidTagihan)->get();

        // Kirim data ke view
        return view('user.buktitransaksi.index', compact('module', 'transaksi', 'tagihan'));
    }

    public function upload_bukti(Request $request, $params)
    {
        $data = Transaksi::where('uuid', $params)->first();

        // Pastikan uuid_tagihan berupa array
        $uuidTagihan = $data->uuid_tagihan;

        // Ambil data tagihan berdasarkan UUID
        $tagihan = Tagihan::whereIn('uuid', $uuidTagihan)->get();

        $newFoto = '';
        if ($request->file('foto')) {
            $extension = $request->file('foto')->extension();
            $newFoto = auth()->guard('warga')->user()->nama . '-' . now()->timestamp . '.' . $extension;
            $request->file('foto')->storeAs('bukti', $newFoto);
        }

        try {
            $data->foto = $newFoto;
            $data->save();

            // Update status tagihan
            $tagihan->each(function ($item) {
                $item->status = 'Proses';
                $item->save();
            });
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Update data success');
    }

    public function proses($params)
    {
        $module = 'Proses Transaksi';
        // Ambil transaksi berdasarkan UUID
        $transaksi = Transaksi::where('uuid', $params)->first();

        // Pastikan data transaksi ditemukan
        if (!$transaksi) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }

        // Pastikan uuid_tagihan berupa array
        $uuidTagihan = $transaksi->uuid_tagihan;

        // Ambil data tagihan berdasarkan UUID
        $tagihan = Tagihan::whereIn('uuid', $uuidTagihan)->get();
        return view('user.prosestransaksi.index', compact('module', 'transaksi', 'tagihan'));
    }

    public function riwayat_transaksi()
    {
        $module = 'Riwayat Transaksi';
        $transaksi = Transaksi::where('uuid_warga', auth()->guard('warga')->user()->uuid)->get();
        $transaksi->map(function ($item) {
            $uuidTagihan = $item->uuid_tagihan;
            $tagihan = Tagihan::whereIn('uuid', $uuidTagihan)->first();

            $item->tanggal_tagihan = $tagihan->tanggal_tagihan;
            $item->status = $tagihan->status;

            return $item;
        });
        return view('user.riwayat.index', compact('module', 'transaksi'));
    }

    // kolektor
    public function transaksi_kolektor()
    {
        $module = 'Transaksi Pembayaran';

        // Ambil kelurahan dari user yang sedang login
        $kelurahan = auth()->guard('user')->user()->kelurahan;

        // Ambil semua tagihan dengan status "lunas" yang relevan dengan kelurahan tersebut
        $tagihanLunas = Tagihan::where('status', 'Lunas')
            ->whereIn('uuid_warga', function ($query) use ($kelurahan) {
                $query->select('uuid')
                    ->from('wargas')
                    ->where('kelurahan', $kelurahan);
            })->get();

        // Ambil semua transaksi berdasarkan tagihan yang sudah lunas
        $tagihanUuids = $tagihanLunas->pluck('uuid')->toArray();

        $transaksi = Transaksi::where(function ($query) use ($tagihanUuids) {
            foreach ($tagihanUuids as $uuid) {
                $query->orWhereJsonContains('uuid_tagihan', $uuid);
            }
        })->get();

        // Ambil semua data warga yang relevan
        $wargaUuids = $transaksi->pluck('uuid_warga')->unique();
        $wargas = Warga::whereIn('uuid', $wargaUuids)->get()->keyBy('uuid');

        // Group tagihan lunas berdasarkan `uuid_warga`
        $tagihans = $tagihanLunas->groupBy('uuid_warga');

        // Map setiap transaksi untuk menambahkan data tambahan
        $transaksi->map(function ($item) use ($wargas, $tagihans) {
            // Ambil warga dari data yang telah di-load sebelumnya
            $warga = $wargas[$item->uuid_warga] ?? null;

            // Ambil semua tagihan lunas terkait warga
            $tagihan = $tagihans[$item->uuid_warga] ?? collect();

            // Tambahkan properti dari warga dan tagihan ke item transaksi
            $item->nama = $warga->nama ?? null;
            $item->nprw = $warga->nprw ?? null;
            $item->jenis_sampah = $warga->jenis_sampah ?? null;
            $item->alamat = $warga->alamat ?? null;
            $item->rt = $warga->rt ?? null;
            $item->rw = $warga->rw ?? null;
            $item->kelurahan = $warga->kelurahan ?? null;
            $item->foto_warga = $warga->foto ?? null;
            $item->bulan_tagihan = $tagihan->count();

            // Set status menjadi "lunas" jika ada tagihan lunas, jika tidak "belum lunas"
            $item->status = $tagihan->contains('status', 'Lunas') ? 'Lunas' : 'Belum Lunas';

            return $item;
        });

        // Kirim data ke view
        return view('kolektor.transaksi.index', compact('module', 'transaksi'));
    }

    public function detail_transaksi_kolektor($params)
    {
        $module = 'Detail Transaksi';

        // Ambil transaksi berdasarkan UUID
        $transaksi = Transaksi::where('uuid', $params)->first();

        // Ambil data warga berdasarkan UUID warga dari transaksi
        $warga = Warga::where('uuid', $transaksi->uuid_warga)->first();

        // Ambil UUID tagihan dan pastikan dalam bentuk array
        $uuidTagihan = is_string($transaksi->uuid_tagihan)
            ? json_decode($transaksi->uuid_tagihan, true)
            : (array) $transaksi->uuid_tagihan;

        // Ambil semua tagihan berdasarkan UUID tagihan
        $tagihan = Tagihan::whereIn('uuid', $uuidTagihan)->get();

        // Ambil data bulan tagihan dan status dari tagihan
        $bulan_tagihan = $tagihan->pluck('tanggal_tagihan')->toArray();
        $status = $tagihan->first()?->status;

        // Tambahkan properti tambahan ke transaksi
        $transaksi->nama = $warga->nama ?? null;
        $transaksi->nprw = $warga->nprw ?? null;
        $transaksi->jenis_sampah = $warga->jenis_sampah ?? null;
        $transaksi->alamat = $warga->alamat ?? null;
        $transaksi->rt = $warga->rt ?? null;
        $transaksi->rw = $warga->rw ?? null;
        $transaksi->tarif = $warga->tarif ?? null;
        $transaksi->kelurahan = $warga->kelurahan ?? null;
        $transaksi->foto_warga = $warga->foto ?? null;
        $transaksi->bulan_tagihan = $bulan_tagihan;
        $transaksi->status = $status;

        // Return ke view dengan data transaksi
        return view('kolektor.detail_transaksi.index', compact('module', 'transaksi'));
    }

    public function proses_transaksi_kolektor(Request $request)
    {
        $data = array();

        try {
            $data = new Transaksi();
            $data->uuid_warga = $request->uuid_warga;
            $data->uuid_tagihan = $request->input('uuid_tagihan');
            $data->terbayarkan = $request->terbayarkan;

            // Generate nomor transaksi unik
            do {
                $noTransaksi = now()->format('Ymd') . mt_rand(100000, 999999); // Format: YYYYMMDD + 6 angka random
            } while (Transaksi::where('no_transaksi', $noTransaksi)->exists());

            $data->no_transaksi = $noTransaksi;
            $data->save();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }

        return $this->sendResponse($data, 'Added data success');
    }

    public function qris_transaksi_kolektor($params)
    {
        $module = 'Scan QRIS';
        $transaksi = Transaksi::where('uuid', $params)->first();
        return view('kolektor.qris.index', compact('module', 'transaksi'));
    }

    public function bukti_transaksi_kolekor($params)
    {
        $module = 'Bukti Transaksi';

        // Ambil transaksi berdasarkan UUID
        $transaksi = Transaksi::where('uuid', $params)->first();

        $warga = Warga::where('uuid', $transaksi->uuid_warga)->first();

        // Pastikan uuid_tagihan berupa array
        $uuidTagihan = $transaksi->uuid_tagihan;

        // Ambil data tagihan berdasarkan UUID
        $tagihan = Tagihan::whereIn('uuid', $uuidTagihan)->get();

        // Kirim data ke view
        return view('kolektor.buktitransaksi.index', compact('module', 'transaksi', 'tagihan', 'warga'));
    }

    public function upload_bukti_kolektor(Request $request, $params)
    {
        $data = Transaksi::where('uuid', $params)->first();
        $warga = Warga::where('uuid', $data->uuid_warga)->first();

        // Pastikan uuid_tagihan berupa array
        $uuidTagihan = $data->uuid_tagihan;

        // Ambil data tagihan berdasarkan UUID
        $tagihan = Tagihan::whereIn('uuid', $uuidTagihan)->get();

        $newFoto = '';
        if ($request->file('foto')) {
            $extension = $request->file('foto')->extension();
            $newFoto = $warga->nama . '-' . now()->timestamp . '.' . $extension;
            $request->file('foto')->storeAs('bukti', $newFoto);
        }

        try {
            $data->foto = $newFoto;
            $data->save();

            // Update status tagihan
            $tagihan->each(function ($item) {
                $item->status = 'Proses';
                $item->save();
            });
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Update data success');
    }

    public function proses_kolektor($params)
    {
        $module = 'Proses Transaksi';
        // Ambil transaksi berdasarkan UUID
        $transaksi = Transaksi::where('uuid', $params)->first();

        $warga = Warga::where('uuid', $transaksi->uuid_warga)->first();

        // Pastikan data transaksi ditemukan
        if (!$transaksi) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }

        // Pastikan uuid_tagihan berupa array
        $uuidTagihan = $transaksi->uuid_tagihan;

        // Ambil data tagihan berdasarkan UUID
        $tagihan = Tagihan::whereIn('uuid', $uuidTagihan)->get();
        return view('kolektor.prosestransaksi.index', compact('module', 'transaksi', 'tagihan', 'warga'));
    }
}
