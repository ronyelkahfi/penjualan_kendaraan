<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $collection ="penjualan";
    protected $fillable = [
        "no_nota",
        "customer",
        "items"
    ];
}
