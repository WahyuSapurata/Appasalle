<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Umkm extends Model
{
    use HasFactory;

    protected $table = 'umkms';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uuid',
        'nama_umkm',
        'alamat',
        'rt',
        'rw',
        'kelurahan',
        'jenis_umkm',
        'telepon',
        'sosial_media',
        'foto',
    ];

    protected static function boot()
    {
        parent::boot();

        // Event listener untuk membuat UUID sebelum menyimpan
        static::creating(function ($model) {
            $model->uuid = Uuid::uuid4()->toString();
        });
    }
}
