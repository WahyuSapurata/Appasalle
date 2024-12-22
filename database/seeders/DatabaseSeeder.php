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

        // Tagihan::create(
        //     [
        //         'uuid_warga' => '2747509f-504e-45eb-bbad-2011c99d824a',
        //         'no_tagihan' => '202412',
        //         'tanggal_tagihan' => '2024 12 1',
        //         'status' => 'Belum Lunas',
        //     ]
        // );

        // Tagihan::create(
        //     [
        //         'uuid_warga' => '99f2950e-52b0-49ee-8698-949e27af2557',
        //         'no_tagihan' => '202412',
        //         'tanggal_tagihan' => '2024 12 1',
        //         'status' => 'Belum Lunas',
        //     ]
        // );

        // Tagihan::create(
        //     [
        //         'uuid_warga' => '431d03c3-15fa-4d79-89ce-3e5a69ccceab',
        //         'no_tagihan' => '202412',
        //         'tanggal_tagihan' => '2024 12 1',
        //         'status' => 'Belum Lunas',
        //     ]
        // );

        // Tagihan::create(
        //     [
        //         'uuid_warga' => 'ba2b3322-17c4-43dc-961b-52204fd4268e',
        //         'no_tagihan' => '202412',
        //         'tanggal_tagihan' => '2024 12 1',
        //         'status' => 'Belum Lunas',
        //     ]
        // );

        // Tagihan::create(
        //     [
        //         'uuid_warga' => 'b5b720d2-323a-4e28-8349-3305fff7badd',
        //         'no_tagihan' => '202412',
        //         'tanggal_tagihan' => '2024 12 1',
        //         'status' => 'Belum Lunas',
        //     ]
        // );

        // Tagihan::create(
        //     [
        //         'uuid_warga' => 'cc7cca3e-4855-47d1-b514-45cfec32ac3d',
        //         'no_tagihan' => '202412',
        //         'tanggal_tagihan' => '2024 12 1',
        //         'status' => 'Belum Lunas',
        //     ]
        // );

        // Tagihan::create(
        //     [
        //         'uuid_warga' => '65f55a90-790c-4a27-b0d6-f35396198da2',
        //         'no_tagihan' => '202412',
        //         'tanggal_tagihan' => '2024 12 1',
        //         'status' => 'Belum Lunas',
        //     ]
        // );

        // Tagihan::create(
        //     [
        //         'uuid_warga' => '4fa421c1-10e8-48db-9b2f-9642e17065a7',
        //         'no_tagihan' => '202412',
        //         'tanggal_tagihan' => '2024 12 1',
        //         'status' => 'Belum Lunas',
        //     ]
        // );

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
