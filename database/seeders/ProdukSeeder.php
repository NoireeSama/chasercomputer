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
                'kategori' => 'CPU',
                'kode_produk' => 'INT-001',
                'harga' => 1500000,
                'deskripsi' => 'Ini adalah deskripsi CPU intel',
            ],
            [
                'nama' => 'ASUS Prime B760M-K',
                'kategori' => 'Motherboard',
                'kode_produk' => 'AUS-001',
                'harga' => 2200000,
                'deskripsi' => 'Ini adalah deskripsi Mobo Asus',
            ],
            [
                'nama' => 'Samsung 32GB DDR4',
                'kategori' => 'RAM',
                'kode_produk' => 'SAM-001',
                'harga' => 15000000,
                'deskripsi' => 'Ini adalah deskripsi RAM Samsung',
            ],
            [
                'nama' => 'NVIDIA GeForce RTX4060',
                'kategori' => 'VGA',
                'kode_produk' => 'NVI-001',
                'harga' => 6000000,
                'deskripsi' => 'Ini adalah deskripsi VGA RTX4060',
            ],
            [
                'nama' => 'SSD V-Gen 1TB',
                'kategori' => 'SSD',
                'kode_produk' => 'VGN-001',
                'harga' => 3600000,
                'deskripsi' => 'Ini adalah deskripsi SSD V-Gen',
            ],
            [
                'nama' => 'ASUS TUF A15',
                'kategori' => 'Laptop',
                'kode_produk' => 'AUS-002',
                'harga' => 15000000,
                'deskripsi' => 'Ini adalah deskripsi Laptop Asus',
            ],
            [
                'nama' => 'Xiaomi G34WQi',
                'kategori' => 'Monitor',
                'kode_produk' => 'XIA-001',
                'harga' => 3600000,
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
