<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Ramsey\Uuid\Uuid;

class Warga extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'wargas';

    protected $fillable = [
        'uuid',
        'resrtribusi',
        'nama',
        'nprw',
        'alamat',
        'rt',
        'rw',
        'kelurahan',
        'jenis_sampah',
        'sub_kategori',
        'volume',
        'tarif',
        'foto',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->uuid) {
                $model->uuid = Uuid::uuid4()->toString();
            }
        });
    }
}
