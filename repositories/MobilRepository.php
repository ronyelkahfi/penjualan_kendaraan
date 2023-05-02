<?php
namespace App\Repositories;
use App\Repositories\KendaraanRepository;
class MobilRepository extends KendaraanRepository{
    protected string $mesin;
    protected int $kapasitasPenumpang;
    protected string $tipe;
    function __construct(int $tahunKeluaran, string $warna, float $harga, string $mesin, int $kapasitasPenumpang, string $tipe){
        parent::__construct($tahunKeluaran, $warna, $harga);
        $this->mesin = $mesin;
        $this->kapasitasPenumpang = $kapasitasPenumpang;
        $this->tipe = $tipe;
    }
    
}