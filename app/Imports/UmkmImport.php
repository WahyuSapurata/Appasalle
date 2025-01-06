<?php

namespace App\Imports;

use App\Models\Umkm;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UmkmImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Umkm([
            'nama_umkm'     => $row['nama_umkm'] ?? null,
            'alamat'        => $row['alamat'] ?? null,
            'rt'            => $row['rt'] ?? null,
            'rw'            => $row['rw'] ?? null,
            'kelurahan'     => $row['kelurahan'] ?? null,
            'jenis_umkm'    => $row['jenis_umkm'] ?? null,
            'telepon'       => $row['telepon'] ?? null,
            'sosial_media'  => $row['sosial_media'] ?? null,
            'foto'          => $row['foto'] ?? null,
        ]);
    }
}
