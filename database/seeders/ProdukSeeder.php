<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Persediaan;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = Kategori::pluck('id', 'nama');

        $produk = [
            [
                'nama' => 'Intel Core i3 12100F',
                'kategori' => 'Komponen',
                'kode_produk' => 'CPU-001',
                'harga' => 400000,
                'deskripsi' => 'Ini adalah deskripsi CPU intel',
            ],
            [
                'nama' => 'Lenovo LOQ 15',
                'kategori' => 'Laptop',
                'kode_produk' => 'LAP-001',
                'harga' => 15000000,
                'deskripsi' => 'Ini adalah deskripsi Laptop Lenovo',
            ],
            [
                'nama' => 'Xiaomi G24i',
                'kategori' => 'Monitor',
                'kode_produk' => 'MON-001',
                'harga' => 1500000,
                'deskripsi' => 'Ini adalah deskripsi Monitor Xiaomi',
            ],
            [
                'nama' => 'Xiaomi G34WQi',
                'kategori' => 'Monitor',
                'kode_produk' => 'MON-002',
                'harga' => 3000000,
                'deskripsi' => 'Ini adalah deskripsi Monitor Xiaomi',
            ],
        ];

        foreach ($produk as $p) {
            $produkModel = Produk::create([
                'nama' => $p['nama'],
                'kategori_id' => $kategori[$p['kategori']],
                'kode_produk' => $p['kode_produk'],
                'harga' => $p['harga'],
                'deskripsi' => $p['deskripsi'],
            ]);

            Persediaan::create([
                'produk_id' => $produkModel->id,
                'stok' => 6,
            ]);
        }
    }
}
