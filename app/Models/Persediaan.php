<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Persediaan extends Model
{
    use HasFactory;

    protected $table = 'persediaan';

    protected $fillable = [
        'produk_id',
        'stok',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
