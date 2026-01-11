<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProdukGambar extends Model
{
    use HasFactory;

    protected $table = 'produk_gambar';

    protected $fillable = [
        'produk_id',
        'path',
        'posisi',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
