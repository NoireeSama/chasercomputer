<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Garansi extends Model
{nsi';

    protected $fillable = [
        'produk_id',
        'nomor_seri',
        'tanggal_mulai',
        'durasi_bulan',
    use HasFactory;

    protected $table = 'gara
        'tanggal_berakhir',
        'status_id',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function statusGaransi()
    {
        return $this->belongsTo(StatusGaransi::class, 'status_id');
    }
}
