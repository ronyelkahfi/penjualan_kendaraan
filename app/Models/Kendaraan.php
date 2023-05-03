<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;
    protected $collection ="kendaraan";
    protected $fillable = [
        "tahun_keluaran",
        "warna",
        "harga",
        "mesin",
        "tipe_suspensi",
        "tipe_transmisi",
        "kapasitas_penumpang",
        "tipe",
        "stok"
    ];
}
