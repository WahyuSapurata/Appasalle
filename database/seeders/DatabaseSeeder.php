<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Tagihan;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'admin',
                'uuid' => Uuid::uuid4()->toString(),
                'password' => Hash::make('<>password'),
                'role' => 'admin',
            ]
        );

        Tagihan::create(
            [
                'uuid_warga' => '863c5e4d-d449-4455-a3b9-9293d55dc676',
                'no_tagihan' => '202412',
                'tanggal_tagihan' => '2024 12 1',
                'status' => 'Belum Lunas',
            ]
        );

        // Tagihan::where('uuid', '1f0f63cc-c075-483f-b752-972fba737a34')->delete();

        // Transaksi::truncate();

        // Tagihan::created(
        //     ['uuid_warga' => 'e8eeb051-c022-480c-80ea-0600fbb610dc'],
        //     [
        //         'tanggal_tagihan' => '2025 01 1',
        //         'total_tagihan' => '48000',
        //         'status' => 'Belum Lunas',
        //     ]
        // );
    }
}
