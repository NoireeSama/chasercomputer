<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\StatusPesanan;
use Carbon\Carbon;

class PesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = Kategori::pluck('id', 'nama');
        $status = StatusPesanan::pluck('id', 'nama');
        $produk = Produk::pluck('id', 'nama');

        $pesananData = [
            [
                'kode' => 'CC-000001',
                'tanggal' => Carbon::create(2026,1,3,7,16),
                'kategori' => 'CPU',
                'status' => 'Perjalanan',
                'produk' => 'Intel Core i3 12100F',
            ],
            [
                'kode' => 'CC-000002',
                'tanggal' => Carbon::create(2026,1,3,10,33),
                'kategori' => 'Motherboard',
                'status' => 'Dikemas',
                'produk' => 'ASUS Prime B760M-K',
            ],
            [
                'kode' => 'CC-000003',
                'tanggal' => Carbon::create(2026,1,4,13,27),
                'kategori' => 'RAM',
                'status' => 'Selesai',
                'produk' => 'Samsung 32GB DDR4',
            ],
            [
                'kode' => 'CC-000004',
                'tanggal' => Carbon::create(2026,1,4,20,12),
                'kategori' => 'VGA',
                'status' => 'Aktif',
                'produk' => 'NVIDIA GeForce RTX4060',
            ],
            [
                'kode' => 'CC-000005',
                'tanggal' => Carbon::create(2026,1,4,20,12),
                'kategori' => 'SSD',
                'status' => 'Dikemas',
                'produk' => 'SSD V-Gen 1TB',
            ],
            [
                'kode' => 'CC-000006',
                'tanggal' => Carbon::create(2026,1,4,20,12),
                'kategori' => 'Laptop',
                'status' => 'Aktif',
                'produk' => 'ASUS TUF A15',
            ],
            [
                'kode' => 'CC-000007',
                'tanggal' => Carbon::create(2026,1,4,20,12),
                'kategori' => 'Monitor',
                'status' => 'Perjalanan',
                'produk' => 'Xiaomi G34WQi',
            ],
        ];

        foreach ($pesananData as $p) {
            $pesanan = Pesanan::create([
                'kode_pesanan' => $p['kode'],
                'tanggal_jam' => $p['tanggal'],
                'kategori_id' => $kategori[$p['kategori']],
                'status_id' => $status[$p['status']],
            ]);

            DetailPesanan::create([
                'pesanan_id' => $pesanan->id,
                'produk_id' => $produk[$p['produk']],
                'jumlah' => 1,
                'catatan' => null,
            ]);
        }
    }
}
