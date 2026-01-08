<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produk;
use App\Models\Garansi;
use Carbon\Carbon;
use App\Models\StatusGaransi;

class GaransiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status = StatusGaransi::pluck('id', 'nama');
        $produkList = Produk::all();

        foreach ($produkList as $produk){
            for ($i=1; $i<=2; $i++){
                $nomorSeri = $produk->kode_produk . '-' . str_pad($i, 3, '0', STR_PAD_LEFT);

                Garansi::create([
                    'produk_id' => $produk->id,
                    'nomor_seri' => $nomorSeri,
                    'tanggal_mulai' => Carbon::now()->subDays(rand(0, 30)),
                    'durasi_bulan' => 12,
                    'tanggal_berakhir' => Carbon::now()->addMonths(12),
                    'status_id' => $status['Active'],
                ]);
            }
        }
    }
}
