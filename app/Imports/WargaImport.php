<?php

namespace App\Imports;

use App\Models\Warga;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class WargaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Hapus format "Rp", ".", dan "spasi" dari kolom tarif
        // $tarif = str_replace(['Rp', '.', ' '], '', $row['tarif']);

        // Generate unique resrtribusi
        do {
            $uniqueResrtribusi = strtoupper(Str::random(6));
            $uniqueResrtribusi = preg_replace('/[^A-Z0-9]/', '', $uniqueResrtribusi); // Hanya alphanumeric
        } while (Warga::where('resrtribusi', $uniqueResrtribusi)->exists());

        return new Warga([
            'resrtribusi'  => $uniqueResrtribusi,
            'nama'         => $row['nama'],         // Header: nama
            'nprw'         => $row['nprw'],         // Header: nprw
            'alamat'       => $row['alamat'],       // Header: alamat
            'rt'           => $row['rt'],           // Header: rt
            'rw'           => $row['rw'],           // Header: rw
            'kelurahan'    => $row['kelurahan'],    // Header: kelurahan
            'jenis_sampah' => $row['jenis_sampah'], // Header: jenis_sampah
            'sub_kategori' => $row['sub_kategori'], // Header: sub_kategori
            'volume'       => $row['volume'],       // Header: volume
            'tarif'        => $row['tarif'],        // Header: tarif
            'foto'         => null,                 // Kolom foto di-set null
        ]);
    }
}
