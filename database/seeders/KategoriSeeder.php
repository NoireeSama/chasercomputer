<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;
class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $data = ['CPU', 'Motherboard', 'RAM', 'VGA', 'SSD', 'Laptop', 'Monitor'];
        foreach ($data as $nama) {
            Kategori::create(['nama' => $nama]);
        }
    }
}