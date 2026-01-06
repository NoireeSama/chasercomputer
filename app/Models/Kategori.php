<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $fillable = ['nama'];

    public function produk()
    {
        return $this->hasMany(Produk::class);
    }

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class);
    }
}
