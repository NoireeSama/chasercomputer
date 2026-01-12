<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Produk extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $fillable = [
        'nama',
        'kategori_id',
        'kode_produk',
        'harga',
        'deskripsi',
        'gambar',
    ];
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function gambars()
    {
        return $this->hasMany(ProdukGambar::class, 'produk_id')->orderBy('posisi');
    }
    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class);
    }
    public function persediaan()
    {
        return $this->hasOne(Persediaan::class);
    }
    public function garansi()
    {
        return $this->hasMany(Garansi::class);
    }
}
