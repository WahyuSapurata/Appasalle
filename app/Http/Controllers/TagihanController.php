<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagihanRequest;
use App\Http\Requests\UpdateTagihanRequest;
use App\Models\Tagihan;
use App\Models\Transaksi;
use App\Models\Warga;
use Carbon\Carbon;

class TagihanController extends BaseController
{
    // admin
    public function index()
    {
        $module = 'Tagihan';

        $tagihan = Tagihan::all();

        $tagihan->map(function ($item) {
            $warga = Warga::where('uuid', $item->uuid_warga)->first();

            $item->nama = $warga->nama;
            $item->nprw = $warga->nprw;
            $item->foto = $warga->foto;
            $item->kelurahan = $warga->kelurahan;
            $item->jenis_sampah = $warga->jenis_sampah;

            $tagihanWarga = $item->where('uuid_warga', $item->uuid_warga); // Koleksi tagihan untuk warga tersebut
            $item->tagihan_bulan = $tagihanWarga->whereIn('status', ['Belum Lunas', 'Proses'])->count();

            $item->total_belum_lunas = $item->whereIn('status', ['Belum Lunas', 'Proses'])->count() * $warga->tarif;
            $item->total_lunas = $item->whereIn('status', ['Lunas'])->count() * $warga->tarif;

            return $item;
        });

        dd($tagihan);

        return view('admin.tunggakan.index', compact('module', 'tagihan'));
    }

    // warga
    public function tagihan_warga()
    {
        $module = 'Tagihan Anda';

        // Mengatur locale ke bahasa Indonesia
        Carbon::setLocale('id');

        // Mengambil data tagihan berdasarkan UUID warga yang sedang login
        $tagihan = Tagihan::where('uuid_warga', auth()->guard('warga')->user()->uuid)
            ->get()
            ->sortBy(function ($item) {
                // Mengubah tanggal ke objek Carbon untuk sorting
                return Carbon::createFromFormat('Y m d', $item->tanggal_tagihan);
            })
            ->groupBy(function ($item) {
                // Mengelompokkan berdasarkan tahun
                return Carbon::createFromFormat('Y m d', $item->tanggal_tagihan)->format('Y');
            });

        return view('user.tagihan.index', compact('module', 'tagihan'));
    }

    public function detail_tagihan($params)
    {
        // Ambil tagihan berdasarkan UUID
        $tagihan = Tagihan::where('uuid', $params)->first();

        // Ambil transaksi berdasarkan UUID warga
        $transaksi = Transaksi::where('uuid_warga', auth()->guard('warga')->user()->uuid)->get();

        // Pastikan transaksi ditemukan
        // Mencocokkan UUID params dengan uuid_tagihan yang ada di transaksi
        $matchingTransaksi = $transaksi->filter(function ($item) use ($params) {

            // Pastikan hasil decode adalah array
            if (is_array($item->uuid_tagihan)) {
                // Cek jika UUID params ada dalam array uuid_tagihan
                return in_array($params, $item->uuid_tagihan);
            }
            return false;
        });

        // Ambil transaksi yang cocok (jika ada)
        $matchingTransaksi = $matchingTransaksi->first(); // Ambil transaksi pertama yang cocok

        // Mengatur locale ke bahasa Indonesia
        Carbon::setLocale('id');

        // Format nama bulan
        $module = Carbon::createFromFormat('Y m d', $tagihan->tanggal_tagihan)->formatLocalized('%B %Y');

        return view('user.detailtagihan.index', compact('tagihan', 'module', 'matchingTransaksi'));
    }


    public function bayar_tagihan()
    {
        $module = 'Bayar Tagihan';
        $tagihan = Tagihan::where('uuid_warga', auth()->guard('warga')->user()->uuid)->where('status', 'Belum Lunas')->get()
            ->sortBy(function ($item) {
                // Mengubah tanggal ke objek Carbon untuk sorting
                return Carbon::createFromFormat('Y m d', $item->tanggal_tagihan);
            });
        return view('user.pembayaran.index', compact('module', 'tagihan'));
    }

    // kolektor
    // public function detail_detail_pembayaran_kolektor($params)
    // {
    //     $module = 'Detail Tagihan';

    // }
}
