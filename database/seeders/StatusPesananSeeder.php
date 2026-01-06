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
            ['nama' => 'aktif', 'warna' => 'green'],
            ['nama' => 'dikemas', 'warna' => 'orange'],
            ['nama' => 'perjalanan', 'warna' => 'blue'],
            ['nama' => 'selesai', 'warna' => 'white'],
        ];

        foreach ($data as $status) {
            StatusPesanan::create($status);
        }
    }
}
