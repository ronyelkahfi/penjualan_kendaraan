<?php 
namespace App\repositories;
use App\Models\Penjualan;
class PenjualanRepository{
    protected $penjualan;
    function __construct(Penjualan $penjualan){
        $this->penjualan = $penjualan;
    }
    function create($data){
        return $this->penjualan->create($data);
    }
}