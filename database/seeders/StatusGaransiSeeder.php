<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StatusGaransi;

class StatusGaransiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama' => 'Active', 'warna' => 'green'],
            ['nama' => 'Expired', 'warna' => 'orange'],
            ['nama' => 'Claimed', 'warna' => 'blue'],
        ];

        foreach ($data as $status) {
            StatusGaransi::create($status);
        }
    }
}
