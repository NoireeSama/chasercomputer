<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produk;
use App\Models\Kategori;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = Kategori::pluck('id', 'nama');

        $produk = [
            ['nama' => 'Intel Core i3 12100F', 'kategori' => 'Komponen'],
            ['nama' => 'Lenovo LOQ 15', 'kategori' => 'Laptop'],
            ['nama' => 'Xiaomi G24i', 'kategori' => 'Monitor'],
            ['nama' => 'Xiaomi G34WQi', 'kategori' => 'Monitor'],
        ];

        foreach ($produk as $p) {
            Produk::create([
                'nama' => $p['nama'],
                'kategori_id' => $kategori[$p['kategori']],
            ]);
        }
    }
}
