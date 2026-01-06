<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['Rakit PC', 'Laptop', 'Komponen', 'Monitor'];

        foreach ($data as $nama) {
            Kategori::create(['nama' => $nama]);
        }
    }
}
