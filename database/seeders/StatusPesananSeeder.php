<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StatusPesanan;

class StatusPesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama' => 'Aktif', 'warna' => 'green'],
            ['nama' => 'Dikemas', 'warna' => 'orange'],
            ['nama' => 'Perjalanan', 'warna' => 'blue'],
            ['nama' => 'Selesai', 'warna' => 'white'],
        ];

        foreach ($data as $status) {
            StatusPesanan::create($status);
        }
    }
}
