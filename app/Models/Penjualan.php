<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\Kendaraan;
class Penjualan extends Model
{
    use HasFactory;
    protected $collection ="penjualan";
    protected $fillable = [
        "no_nota",
        "customer",
        "items"
    ];
    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, '_id');
    }
}
