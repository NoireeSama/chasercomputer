<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Garansi extends Model
{
    use HasFactory;

    protected $table = 'garansi';

    protected $fillable = [
        'produk_id',
        'nomor_seri',
        'tanggal_mulai',
        'durasi_bulan',
        'tanggal_berakhir',
        'status_garansi',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
