<?php

namespace App\Http\Controllers;

use App\Models\MenuUmkm;
use App\Models\Tagihan;
use App\Models\Transaksi;
use App\Models\Umkm;
use App\Models\Warga;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Dashboard extends BaseController
{
    public function index()
    {
        if (auth()->check()) {
            return redirect()->back();
        }
        return redirect()->route('login.login-user');
    }

    public function dashboard_admin()
    {
        $module = 'Dashboard Admin';
        // Ambil semua transaksi

        $transaksi = Transaksi::all()->filter(function ($item) {
            // Ambil data tagihan berdasarkan UUID tagihan
            $uuidTagihan = is_array($item->uuid_tagihan) ? $item->uuid_tagihan : [$item->uuid_tagihan];
            $tagihan = Tagihan::whereIn('uuid', $uuidTagihan)->get();

            // Cek apakah ada tagihan yang berstatus 'Proses'
            return $tagihan->contains('status', 'Proses');
        });

        // Map setiap transaksi yang telah difilter
        $transaksi->map(function ($item) {
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

        $tagihan = Tagihan::where('status', 'Lunas')->get();

        $totalTarifTahunIni = 0;
        $totalTarifBulanIni = 0;
        $totalTarifHariIni = 0;
        $totalTarifKeseluruhan = 0;

        $tagihan->map(function ($item) use (&$totalTarifTahunIni, &$totalTarifBulanIni, &$totalTarifHariIni, &$totalTarifKeseluruhan) {
            // Ambil data warga terkait
            $warga = Warga::where('uuid', $item->uuid_warga)->first();

            // Ambil transaksi yang memiliki uuid_tagihan yang cocok dengan uuid di tagihan
            $transaksi = Transaksi::all()->first(function ($trx) use ($item) {
                // Decode uuid_tagihan jika dalam format JSON
                $uuidTagihanTransaksi = is_array($trx->uuid_tagihan)
                    ? $trx->uuid_tagihan
                    : json_decode($trx->uuid_tagihan, true);

                // Pastikan ini adalah array dan cocokkan UUID
                return is_array($uuidTagihanTransaksi) && in_array($item->uuid, $uuidTagihanTransaksi);
            });

            if ($warga) {
                $tanggalTagihan = Carbon::createFromFormat('Y m d', $item->tanggal_tagihan); // Pastikan 'tanggal_tagihan' adalah format tanggal yang valid
                $tanggalTransaksi = Carbon::parse($transaksi->created_at); // Otomatis parsing timestamp

                $totalTarifKeseluruhan += $warga->tarif;

                // Hitung total berdasarkan tahun ini
                if ($tanggalTagihan->isCurrentYear()) {
                    $totalTarifTahunIni += $warga->tarif;
                }

                // Hitung total berdasarkan bulan ini
                if ($tanggalTagihan->isCurrentMonth()) {
                    $totalTarifBulanIni += $warga->tarif;
                }

                // Hitung total berdasarkan hari ini
                if ($tanggalTransaksi->isToday()) {
                    $totalTarifHariIni = $transaksi->terbayarkan;
                }
            }
        });

        $persentaseTahunan = 0;
        if ($totalTarifKeseluruhan > 0) {
            $persentaseTahunan = ($totalTarifTahunIni / $totalTarifKeseluruhan) * 100;
        }

        // Ambil total tarif per kelurahan berdasarkan UUID warga
        $kelurahanStats = Warga::join('tagihans', 'wargas.uuid', '=', 'tagihans.uuid_warga')
            ->select(
                'wargas.kelurahan',
                DB::raw('SUM(wargas.tarif) as total_tarif')
            )
            ->where('tagihans.status', 'Lunas')
            ->groupBy('wargas.kelurahan')
            ->orderBy('total_tarif', 'desc')
            ->get();

        // Hitung total keseluruhan tarif untuk progress bar
        $totalKeseluruhan = $kelurahanStats->sum('total_tarif');

        // Tambahkan persentase untuk setiap kelurahan
        $kelurahanStats = $kelurahanStats->map(function ($item) use ($totalKeseluruhan) {
            $item->persentase = $totalKeseluruhan > 0
                ? ($item->total_tarif / $totalKeseluruhan) * 100
                : 0;

            return $item;
        });

        return view('admin.dashboard.index', compact('module', 'transaksi', 'totalTarifTahunIni', 'totalTarifBulanIni', 'totalTarifHariIni', 'persentaseTahunan', 'kelurahanStats'));
    }

    public function dashboard_user()
    {
        $module = 'Dashboard User';

        // Mengambil semua produk UMKM
        $product = MenuUmkm::all();

        // Mengambil data tagihan dengan status 'Belum Lunas' berdasarkan UUID warga yang sedang login
        $tagihan = Tagihan::whereIn('status', ['Belum Lunas', 'Proses', 'Gagal'])
            ->where('uuid_warga', auth()->guard('warga')->user()->uuid)
            ->get()
            ->sortBy(function ($item) {
                // Mengubah tanggal ke objek Carbon untuk sorting
                return Carbon::createFromFormat('Y m d', $item->tanggal_tagihan);
            });

        // Menghitung total tagihan yang belum lunas
        $total_tagihan_belum_lunas = $tagihan->sum(function ($item) {
            $warga = Warga::where('uuid', $item->uuid_warga)->first();
            return $warga->tarif ?? 0; // Gunakan nilai 0 jika tarif tidak ditemukan
        });

        $tagihan_proses = Tagihan::pluck('status')->first();
        $transaksi = Transaksi::where('uuid_warga', auth()->guard('warga')->user()->uuid)->where('foto', null)->first();

        return view('user.dashboard.index', compact('module', 'product', 'tagihan', 'total_tagihan_belum_lunas', 'transaksi', 'tagihan_proses'));
    }

    public function dashboard_kolektor()
    {
        $module = 'Dashboard Kolektor';

        // Ambil semua data warga di kelurahan sesuai user login
        $warga = Warga::where('kelurahan', auth()->guard('user')->user()->kelurahan)->get();

        // Inisialisasi variabel total
        $totalWarga = $warga->count();
        $totalWargaLunas = 0;
        $totalWargaMenunggak = 0;
        $totalTarif = 0;
        $totalTarifLunas = 0;

        // Ambil semua UUID warga untuk pencarian tagihan
        $uuidsWarga = $warga->pluck('uuid')->toArray();

        // Ambil semua tagihan yang berhubungan dengan warga
        $tagihan = Tagihan::whereIn('uuid_warga', $uuidsWarga)->get();

        // Iterasi setiap warga untuk menghitung tarif berdasarkan jumlah tagihan
        foreach ($warga as $item) {
            // Ambil tagihan warga ini
            $tagihanWarga = $tagihan->where('uuid_warga', $item->uuid);
            $jumlahTagihan = $tagihanWarga->count();

            // Hitung total tarif berdasarkan jumlah tagihan
            $totalTarif += $item->tarif * $jumlahTagihan;

            // Hitung total tarif lunas berdasarkan jumlah tagihan dengan status "Lunas"
            $jumlahTagihanLunas = $tagihanWarga->where('status', 'Lunas')->count();
            $totalTarifLunas += $item->tarif * $jumlahTagihanLunas;

            // Hitung total warga lunas dan menunggak
            if ($jumlahTagihanLunas > 0) {
                $totalWargaLunas++;
            }
            if ($jumlahTagihan > $jumlahTagihanLunas) {
                $totalWargaMenunggak++;
            }
        }

        $transaksi = Transaksi::whereIn('uuid_warga', $uuidsWarga)->get();

        $transaksiLunas = $transaksi->filter(function ($item) {
            // Ambil tagihan dengan UUID yang sesuai dan status 'Lunas'
            $uuidTagihan = $item->uuid_tagihan;

            // Pastikan uuid_tagihan adalah array atau iterable
            $tagihan = Tagihan::whereIn('uuid', (array) $uuidTagihan)
                ->where('status', 'Lunas')
                ->get();

            // Filter hanya transaksi yang memiliki tagihan "Lunas"
            return $tagihan->count() > 0;
        })->map(function ($item) {
            $warga = Warga::where('uuid', $item->uuid_warga)->first();

            // Ambil tagihan dengan UUID yang sesuai dan status 'Lunas'
            $uuidTagihan = $item->uuid_tagihan;
            $tagihan = Tagihan::whereIn('uuid', (array) $uuidTagihan)
                ->where('status', 'Lunas')
                ->get();

            // Menambahkan properti baru untuk ditampilkan
            $item->nama = $warga->nama ?? 'Tidak Diketahui';
            $item->nprw = $warga->nprw ?? '-';
            $item->foto = $warga->foto ?? null;

            // Hitung jumlah tagihan lunas
            $item->bulan = $tagihan->count();

            return $item;
        });

        $warga = Warga::join('tagihans', 'wargas.uuid', '=', 'tagihans.uuid_warga')
            ->whereIn('tagihans.status', ['Belum Lunas', 'Proses'])
            ->select(
                'wargas.uuid',
                'wargas.nama',
                'wargas.nprw',
                'wargas.foto',
                'wargas.kelurahan',
                DB::raw('COUNT(tagihans.uuid) as bulan'), // Hitung jumlah tagihan
                DB::raw('SUM(wargas.tarif) as total_tarif') // Total tarif dihitung dari tarif warga * jumlah tagihan
            )
            ->groupBy('wargas.uuid', 'wargas.nama', 'wargas.nprw', 'wargas.foto', 'wargas.kelurahan')
            ->get();

        return view('kolektor.dashboard.index', compact('module', 'totalWarga', 'totalWargaLunas', 'totalWargaMenunggak', 'totalTarif', 'totalTarifLunas', 'transaksiLunas', 'warga'));
    }

    public function dashboard_monitoring()
    {
        $module = 'Dashboard Monitoring';

        // Ambil semua transaksi
        $transaksi = Transaksi::all()->filter(function ($item) {
            // Ambil data tagihan berdasarkan UUID tagihan
            $uuidTagihan = is_array($item->uuid_tagihan) ? $item->uuid_tagihan : [$item->uuid_tagihan];
            $tagihan = Tagihan::whereIn('uuid', $uuidTagihan)->get();

            // Cek apakah ada tagihan yang berstatus 'Proses'
            return $tagihan->contains('status', 'Proses');
        });

        // Map setiap transaksi yang telah difilter
        $transaksi->map(function ($item) {
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

        $tagihan = Tagihan::where('status', 'Lunas')->get();

        $totalTarifTahunIni = 0;
        $totalTarifBulanIni = 0;
        $totalTarifHariIni = 0;
        $totalTarifKeseluruhan = 0;

        $tagihan->map(function ($item) use (&$totalTarifTahunIni, &$totalTarifBulanIni, &$totalTarifHariIni, &$totalTarifKeseluruhan) {
            // Ambil data warga terkait
            $warga = Warga::where('uuid', $item->uuid_warga)->first();

            // Ambil transaksi yang memiliki uuid_tagihan yang cocok dengan uuid di tagihan
            $transaksi = Transaksi::all()->first(function ($trx) use ($item) {
                // Decode uuid_tagihan jika dalam format JSON
                $uuidTagihanTransaksi = is_array($trx->uuid_tagihan)
                    ? $trx->uuid_tagihan
                    : json_decode($trx->uuid_tagihan, true);

                // Pastikan ini adalah array dan cocokkan UUID
                return is_array($uuidTagihanTransaksi) && in_array($item->uuid, $uuidTagihanTransaksi);
            });

            if ($warga) {
                $tanggalTagihan = Carbon::createFromFormat('Y m d', $item->tanggal_tagihan); // Pastikan 'tanggal_tagihan' adalah format tanggal yang valid
                $tanggalTransaksi = Carbon::parse($transaksi->created_at); // Otomatis parsing timestamp

                $totalTarifKeseluruhan += $warga->tarif;

                // Hitung total berdasarkan tahun ini
                if ($tanggalTagihan->isCurrentYear()) {
                    $totalTarifTahunIni += $warga->tarif;
                }

                // Hitung total berdasarkan bulan ini
                if ($tanggalTagihan->isCurrentMonth()) {
                    $totalTarifBulanIni += $warga->tarif;
                }

                // Hitung total berdasarkan hari ini
                if ($tanggalTransaksi->isToday()) {
                    $totalTarifHariIni = $transaksi->terbayarkan;
                }
            }
        });

        $persentaseTahunan = 0;
        if ($totalTarifKeseluruhan > 0) {
            $persentaseTahunan = ($totalTarifTahunIni / $totalTarifKeseluruhan) * 100;
        }

        // Ambil total tarif per kelurahan berdasarkan UUID warga
        $kelurahanStats = Warga::join('tagihans', 'wargas.uuid', '=', 'tagihans.uuid_warga')
            ->select(
                'wargas.kelurahan',
                DB::raw('SUM(wargas.tarif) as total_tarif')
            )
            ->where('tagihans.status', 'Lunas')
            ->groupBy('wargas.kelurahan')
            ->orderBy('total_tarif', 'desc')
            ->get();

        // Hitung total keseluruhan tarif untuk progress bar
        $totalKeseluruhan = $kelurahanStats->sum('total_tarif');

        // Tambahkan persentase untuk setiap kelurahan
        $kelurahanStats = $kelurahanStats->map(function ($item) use ($totalKeseluruhan) {
            $item->persentase = $totalKeseluruhan > 0
                ? ($item->total_tarif / $totalKeseluruhan) * 100
                : 0;

            return $item;
        });

        return view('monitoring.dashboard.index', compact('module', 'transaksi', 'totalTarifTahunIni', 'totalTarifBulanIni', 'totalTarifHariIni', 'persentaseTahunan', 'kelurahanStats'));
    }

    public function chart(Request $request)
    {
        // Validasi input tahun dari request
        $request->validate([
            'selectedYear' => 'required|integer',
        ]);

        $selectedYear = (int) $request->input('selectedYear');

        // Nama bulan dalam bahasa Indonesia
        $bulanIndonesia = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        $summary = DB::table('tagihans')
            ->join('wargas', 'tagihans.uuid_warga', '=', 'wargas.uuid')
            ->select(
                'tagihans.status',
                DB::raw('COUNT(tagihans.uuid) as total_tagihan'),
                DB::raw('SUM(CAST(CAST(wargas.tarif AS DECIMAL(10, 2)) AS UNSIGNED)) AS total_tarif'), // Mengonversi tarif ke DECIMAL
                DB::raw('MONTH(STR_TO_DATE(tagihans.tanggal_tagihan, "%Y %m %d")) as bulan_num') // Ambil bulan numerik
            )
            ->whereYear(DB::raw('STR_TO_DATE(tagihans.tanggal_tagihan, "%Y %m %d")'), '=', $selectedYear) // Filter tahun
            ->groupBy('tagihans.status', DB::raw('MONTH(STR_TO_DATE(tagihans.tanggal_tagihan, "%Y %m %d"))')) // Group berdasarkan status dan bulan
            ->orderBy(DB::raw('MONTH(STR_TO_DATE(tagihans.tanggal_tagihan, "%Y %m %d"))')) // Urut berdasarkan bulan
            ->get();

        // Format data untuk chart
        $labels = $summary->pluck('bulan_num')->map(function ($bulan_num) use ($bulanIndonesia) {
            return $bulanIndonesia[$bulan_num] ?? 'Tidak diketahui';
        })->unique()->values()->toArray();

        $totalTarif = DB::table('wargas')
            ->selectRaw('SUM(CAST(CAST(tarif AS DECIMAL(10, 2)) AS UNSIGNED)) AS total_tarif')
            ->first()
            ->total_tarif;

        $data = [
            'labels' => $labels, // Bulan
            'datasets' => [
                [
                    'label' => 'Total Target',
                    'data' => [floatval($totalTarif ?? 0)],
                    'backgroundColor' => 'rgb(0, 123, 200)',
                ],
                [
                    'label' => 'Lunas',
                    'data' => [],
                    'backgroundColor' => 'rgb(0, 123, 255)',
                ],
                [
                    'label' => 'Belum Lunas',
                    'data' => [],
                    'backgroundColor' => 'rgb(255, 0, 0)',
                ],
                [
                    'label' => 'Proses',
                    'data' => [],
                    'backgroundColor' => 'rgb(40, 167, 69)',
                ],
            ],
        ];

        // Mengisi data untuk masing-masing status
        foreach ($data['labels'] as $bulan) {
            foreach ($summary as $item) {
                if ($bulan == $bulanIndonesia[$item->bulan_num]) {
                    if ($item->status == 'Lunas') {
                        $data['datasets'][1]['data'][] = floatval($item->total_tarif ?? 0);
                    }
                    if ($item->status == 'Belum Lunas') {
                        $data['datasets'][2]['data'][] = floatval($item->total_tarif ?? 0);
                    }
                    if ($item->status == 'Proses') {
                        $data['datasets'][3]['data'][] = floatval($item->total_tarif ?? 0);
                    }
                }
            }
        }

        // Pastikan data dikirim dalam format JSON yang benar
        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }
}
