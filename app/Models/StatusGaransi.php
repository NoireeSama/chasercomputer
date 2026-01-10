<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class StatusGaransi extends Model
{
    use HasFactory;
    protected $table = 'status_garansi';
    protected $fillable = ['nama', 'warna'];
    public function garansi()
    {
        return $this->hasMany(Garansi::class, 'status_id');
    }
}