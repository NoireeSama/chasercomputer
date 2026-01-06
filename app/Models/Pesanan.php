<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';

    protected $fillable = [
        'kode_pesanan',
        'tanggal_jam',
        'kategori_id',
        'status_id',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class)->withDefault();
    }

    public function status()
    {
        return $this->belongsTo(StatusPesanan::class, 'status_id')->withDefault([
            'nama' => ''
        ]);
    }

    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class);
    }
}
