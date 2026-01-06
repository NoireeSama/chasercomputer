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
                'kategori' => 'Monitor',
                'status' => 'perjalanan',
                'produk' => 'Xiaomi G24i',
            ],
            [
                'kode' => 'CC-000002',
                'tanggal' => Carbon::create(2026,1,3,10,33),
                'kategori' => 'Komponen',
                'status' => 'dikemas',
                'produk' => 'Intel Core i3 12100F',
            ],
            [
                'kode' => 'CC-000003',
                'tanggal' => Carbon::create(2026,1,4,13,27),
                'kategori' => 'Laptop',
                'status' => 'selesai',
                'produk' => 'Lenovo LOQ 15',
            ],
            [
                'kode' => 'CC-000004',
                'tanggal' => Carbon::create(2026,1,4,20,12),
                'kategori' => 'Rakit PC',
                'status' => 'aktif',
                'produk' => 'Intel Core i3 12100F',
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
